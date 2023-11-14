<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Equipment;
use App\Entity\Images;
use App\Form\CarType;
use App\Form\EquipmentType;
use App\Repository\CarRepository;
use App\Repository\ScheduleRepository;
use App\Service\PictureService;
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
        // $filters = $request->get("cars");
        //dd($filters);
        $pagination = $paginator->paginate(
            $carRepository->paginationQuery('page', 1, 
            // $filters
        ),
            $request->query->get('page', 1),
            5
        );
        
        //dd($pagination);

    //  on recup les filtres
        

        // $carsByYear = $carRepository->findByYear($request->query->get('year'));
        // $carsByPrice = $carRepository->findByPrice($request->query->get('price'));
        // $carsByKm = $carRepository->findByKm($request->query->get('km'));

        // $cars_filtres = $carRepository->findAllCars($filters);
        // // on verifie si on a une equete ajax
        // if($request->get('ajax')){
        //     return new JsonResponse([
        //         'content' => $this->renderView('car/index.html.twig', compact('cars','schedules','pagination','carsByYear','carsByPrice','carsByKm'))
        //     ]);
        // }

       
        // dd($cars_filtres);
        $cars = $carRepository->findAll();
        return $this->render('car/index.html.twig', [
            'cars' => $cars,
            'schedules' => $scheduleRepository->findAll(),
            'pagination' => $pagination,
            // 'carsByYear' => $carsByYear,
            // 'carsByPrice' => $carsByPrice,
            // 'carsByKm' => $carsByKm
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
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
            // on recup les images
            $images = $form->get('images')->getData();
            foreach($images as $image){
                // on deifnit le dossier de destination
                $folder = "carPosts";
                // on appele le service d'ajout
              $fichier = $pictureService->add($image, $folder, 600, 440);
              $img = new Images();
              $img->setName($fichier);
              $car->addImage($img);
         

            }
            // dd($images);
            $entityManager->persist($car);
            $entityManager->flush();

            return $this->redirectToRoute('car.index', [], Response::HTTP_SEE_OTHER);

            // $this->addFlash('success', 'Annonce ajoutée avec succès');
        }

        return $this->render('car/new.html.twig', [
            'car' => $car,
            'form' => $form,
            'eq_form' => $eq_form,
            'schedules' => $scheduleRepository->findAll()
        ]);
    }

    #[Route('/{id}', name: 'car.show', methods: ['GET'])]
    public function show(Car $car, ScheduleRepository $scheduleRepository): Response
    {
        $images = $car->getImages();
            //    dd($images);
        return $this->render('car/show.html.twig', [
            'car' => $car,
            'schedules' => $scheduleRepository->findAll()
        ]);
    }

    #[Route('/{id}/edit', name: 'car.edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Car $car, 
    EntityManagerInterface $entityManager,
    ScheduleRepository $scheduleRepository,
    PictureService $pictureService
    ): Response
    {
        // $this->denyAccessUnlessGranted('ROLE_ADMIN', $car);
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $images = $form->get('images')->getData();

            foreach($images as $image){
                // On définit le dossier de destination
                $folder = 'carPosts';

                // On appelle le service d'ajout
                $fichier = $pictureService->add($image, $folder, 600, 440);

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
