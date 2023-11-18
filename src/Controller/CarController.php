<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Comment;
use App\Entity\Contact;
use App\Entity\Images;
use App\Form\CarType;
use App\Form\CommentType;
use App\Form\ContactType;
use App\Repository\CarRepository;
use App\Repository\ScheduleRepository;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use App\Service\PictureService;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/car')]
class CarController extends AbstractController
{
    #[Route('/', name: 'car.index', methods: ['GET'])]
    public function index(CarRepository $carRepository,
    ScheduleRepository $scheduleRepository, 
    PaginatorInterface $paginator,
    Request $request
    ): Response
    { 
        
        $pagination = $paginator->paginate(
            $carRepository->paginationQuery('page', 1, 
           
        ),
            $request->query->get('page', 1),
            5
        );
        
      
     
        $cars = $carRepository->findAll();
        return $this->render('car/index.html.twig', [
            'cars' => $cars,
            'schedules' => $scheduleRepository->findAll(),
            'pagination' => $pagination,
        
        ]);
    }

    #[Route('/userCars', name: 'car.user_index', methods: ['GET'])]
    public function user_index(CarRepository $carRepository,
    ScheduleRepository $scheduleRepository, 
    PaginatorInterface $paginator,
    Request $request,
    EntityManagerInterface $manager,
    ): Response
    { 
        $comment = new Comment();
        if($this->getUser()) {
            $comment->setAuthor($this->getUser());
        }
        $commentForm = $this->createForm(CommentType::class, $comment);
        $commentForm->handleRequest($request);
       
        /* form comments */

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
         $comment = $commentForm->getData();
            $manager->persist($comment);
            $manager->flush();
            $this->addFlash(
                'success',
                'Votre commentaire a bien été prise en compte'
            );
        }
        $pagination = $paginator->paginate(
            $carRepository->paginationQuery('page', 1, 
           
        ),
            $request->query->get('page', 1),
            5
        );
        
      
     
        $cars = $carRepository->findAll();
        return $this->render('car/user_index.html.twig', [
            'cars' => $cars,
            'schedules' => $scheduleRepository->findAll(),
            'pagination' => $pagination,
            'commentForm' => $commentForm,
        
        ]);
    }

    #[Route('/new', name: 'car.new', methods: ['GET', 'POST'])]
    public function new(Request $request, 
    EntityManagerInterface $entityManager, 
    ScheduleRepository $scheduleRepository,
    PictureService $pictureService,
    // $id
    ): Response
    {
        $car = new Car();
        if ($this->getUser()) {
            $car->setAuthor($this->getUser());
        }
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
            // on recup les images
            $images = $form->get('images')->getData();
            foreach($images as $image){
                // on deifnit le dossier de destination
                $folder = "carPosts";
                // on appele le service d'ajout
              $fichier = $pictureService->add($image, $folder, 640, 440);
              $img = new Images();
              $img->setName($fichier);
              $car->addImage($img);
         

            }
            //  dd($images);
            $entityManager->persist($car);
            $entityManager->flush();

            return $this->redirectToRoute('car.index', [], Response::HTTP_SEE_OTHER);

            // $this->addFlash('success', 'Annonce ajoutée avec succès');
        }

        return $this->render('car/new.html.twig', [
            'car' => $car,
            'form' => $form,
            'schedules' => $scheduleRepository->findAll()
        ]);
    }

    #[Route('/{id}', name: 'car.show', methods: ['GET', 'POST'])]
    public function show(
        // #[MapEntity(mapping: ['id' => 'id'])] Contact $contact,
    Car $car, 
    ScheduleRepository $scheduleRepository,
    Request $request,
    EntityManagerInterface $manager, 
    MailerInterface $mailer,
    ): Response
    {
        $images = $car->getImages();
        $contact = new Contact();
        $contactForm = $this->createForm(ContactType::class, $contact);
        $contactForm->handleRequest($request);
    if ($contactForm->isSubmitted() && $contactForm->isValid()) {
         $contact = $contactForm->getData();
            $manager->persist($contact);
            $manager->flush();
            $this->addFlash(
                'success',
                'Votre message a bien été envoyée'
            );
    
        $sellerEmail = $car->getAuthor()->getEmail();
        $subject = $contact->getSubject();
        $message = $contact->getMessage();
        $email = (new Email())
        ->from('admin@exemple.com')
        ->to($sellerEmail)
        ->subject($subject)
        ->text($message);

        $mailer->send($email);
      
    }
   

    
    
            //    dd($images);
        return $this->render('car/show.html.twig', [
            'car' => $car,
            'schedules' => $scheduleRepository->findAll(),
             'contactForm' => $contactForm->createView()
        ]);
    
    }
    #[Route('/{id}/edit', name: 'car.edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Car $car, 
    EntityManagerInterface $entityManager,
    ScheduleRepository $scheduleRepository,
    PictureService $pictureService,
    
    ): Response
    {
        // $this->denyAccessUnlessGranted('ROLE_ADMIN', $car);
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

       

        if ($form->isSubmitted() && $form->isValid()) {
            $images = $form->get('images')->getData();
            // $author = $form->getAuthor();
            foreach($images as $image){
                // On définit le dossier de destination
                $folder = 'carPosts';

                // On appelle le service d'ajout
                $fichier = $pictureService->add($image, $folder, 640, 440);

                $img = new Images();
                $img->setName($fichier);
                $car->addImage($img);
            }

            $entityManager->persist($car);
            $entityManager->flush();
            // dd($images);
            return $this->redirectToRoute('car.index', [], Response::HTTP_SEE_OTHER);
        }
      
        return $this->render('car/edit.html.twig', [
            'car' => $car,
            'form' => $form,
           
            'schedules' => $scheduleRepository->findAll()
            
        ]);
    }

    #[Route('/{id}', name: 'car.delete', methods: ['POST'])]
    public function delete(Request $request, Car $car, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$car->getId(), $request->request->get('_token'))) {
            $entityManager->remove($car);
            $entityManager->flush();
        }

        return $this->redirectToRoute('car.index', [], Response::HTTP_SEE_OTHER);
    }
}
