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
use App\Repository\CommentRepository;
use App\Repository\ScheduleRepository;
use App\Service\PictureService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

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
        $carRepository->paginationQuery(),
            $request->query->get('page', 1),
            6
        );
        $cars = $carRepository->findAll();
        return $this->render('car/index.html.twig', [
            'cars' => $cars,
            'schedules' => $scheduleRepository->findAll(),
            'pagination' => $pagination,
        ]);
    }

    #[Route('/userSpace', name: 'car.user_index', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function user_index(CarRepository $carRepository,
    ScheduleRepository $scheduleRepository, 
    PaginatorInterface $paginator,
    Request $request,
    EntityManagerInterface $manager,
    CommentRepository $commentRepository
    ): Response
    { 
        $comment = new Comment();
        $comments = $commentRepository->findAll();
        if($this->getUser()) {
            $comment->setCommentator($this->getUser());
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
                'Votre témoignage a bien été prise en compte'
            );
        }
        
     
        $cars = $carRepository->findAll();
        return $this->render('car/user_index.html.twig', [
            'cars' => $cars,
            'schedules' => $scheduleRepository->findAll(),
            // 'pagination' => $pagination,
            'commentForm' => $commentForm,
            'comments' => $comments
        
        ]);
    }

    #[Route('/new', name: 'car.new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, 
    EntityManagerInterface $entityManager, 
    ScheduleRepository $scheduleRepository,
    PictureService $pictureService,
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
    
            $entityManager->persist($car);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Votre annonce a été créée avec succès !'
            );

            return $this->redirectToRoute('car.user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('car/new.html.twig', [
            'car' => $car,
            'form' => $form,
            'schedules' => $scheduleRepository->findAll()
        ]);
    }

    #[Route('/{id}', name: 'car.show', methods: ['GET', 'POST'])]
    public function show(
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
         $contact->setSubject($car->getTitle());
         $contact->setCar($car);
            $manager->persist($contact);
            $manager->flush();
            $this->addFlash(
                'success',
                'Votre message a bien été envoyée'
            );
    
        $sellerEmail = $car->getAuthor()->getEmail();
        $subject = $car->getTitle();
        $message = $contact->getMessage();
        $guest = $contact->getfullName();
        $email = (new Email())
        ->from('admin@exemple.com')
        ->to($sellerEmail)
        ->subject($subject)
        ->text("De: ". $guest, "Message: ". $message);

        $mailer->send($email);
      
        return $this->redirectToRoute('car.show', [
            'id' => $car->getId()
        ]);
    }
        return $this->render('car/show.html.twig', [
            'car' => $car,
            'schedules' => $scheduleRepository->findAll(),
             'contactForm' => $contactForm->createView()
        ]);
    }

    #[Route('/{id}/edit', name: 'car.edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function edit(Request $request, Car $car, 
    EntityManagerInterface $entityManager,
    ScheduleRepository $scheduleRepository,
    PictureService $pictureService,
    
    ): Response
    {
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $images = $form->get('images')->getData();
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
            $this->addFlash(
                'success',
                'Votre annonce a été modifiée avec succès !'
            );
            return $this->redirectToRoute('car.show', [
                'id' => $car->getId()
            ]);
        }
      
        return $this->render('car/edit.html.twig', [
            'car' => $car,
            'form' => $form,
            'schedules' => $scheduleRepository->findAll()
            
        ]);
    }

    #[Route('/delete/{id}', name: 'car.delete', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function delete(Request $request, Car $car, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$car->getId(), $request->request->get('_token'))) {
            $entityManager->remove($car);
            $entityManager->flush();
        }
        return $this->redirectToRoute('car.index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/delete/image/{id}', name: 'delete_image', methods: ['DELETE'])]
    public function deleteImage(Images $image, Request $request, EntityManagerInterface $entityManager, PictureService $pictureService): JsonResponse
    {
        // On récupère le contenu de la requête
        $data = json_decode($request->getContent(), true);

        if($this->isCsrfTokenValid('delete' . $image->getId(), $data['_token'])){
            // Le token csrf est valide
            // On récupère le nom de l'image
            $nom = $image->getName();

            if($pictureService->delete($nom, 'carPosts', 640, 440)){
                // On supprime l'image de la base de données
                $entityManager->remove($image);
                $entityManager->flush();

                return new JsonResponse(['success' => true], 200);
            }
            // La suppression a échoué
            return new JsonResponse(['error' => 'Erreur de suppression'], 400);
        }

        return new JsonResponse(['error' => 'Token invalide'], 400);
    }
    #[Route('/delete/contact/{id}', name: 'delete_contact', methods: ['DELETE'])]
    public function deleteContact(Contact $contact, 
    Request $request, 
    EntityManagerInterface $entityManager, 
    ): JsonResponse
    {
        // On récupère le contenu de la requête
        $data = json_decode($request->getContent(), true);

        if($this->isCsrfTokenValid('delete' . $contact->getId(), $data['_token'])){
            // Le token csrf est valide
            // On récupère le nom de l'image
            $contactId = $contact->getId();

            if($contactId){
                // On supprime contact de la base de données
                $entityManager->remove($contact);
                $entityManager->flush();

                return new JsonResponse(['success' => true], 200);
            }
            // La suppression a échoué
            return new JsonResponse(['error' => 'Erreur de suppression'], 400);
        }

        return new JsonResponse(['error' => 'Token invalide'], 400);
    }
}