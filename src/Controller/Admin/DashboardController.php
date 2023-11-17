<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use App\Entity\Comment;
use App\Entity\Contact;
use App\Entity\Equipment;
use App\Entity\Option;
use App\Entity\Schedule;
use App\Entity\Service;
use App\Entity\User;
use App\Repository\CarRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }
//     #[IsGranted('ROLE_ADMIN')]
//  #[Route('/car', name: 'car.index', methods: ['GET'])]
//  public function allRecipes(CarRepository $carRepository): Response
//  {
//     return $this->render('car/index.html.twig');
    
//  }
 #[IsGranted('ROLE_ADMIN')] 
 #[Route('/user', name: 'user.new', methods: ['GET'])]
 public function createUser(UserRepository $userRepository): Response
 {
    return $this->render('user/index.html.twig');
    
 }
     #[IsGranted('ROLE_ADMIN')]
 #[Route('/users', name: 'user.index', methods: ['GET'])]
 public function allRecipes(UserRepository $userRepository): Response
 {
    return $this->render('user/index.html.twig');
    
 }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::linkToRoute('Voir le site', 'fas fa-eye', 'car.index');
        
        yield MenuItem::linkToCrud('Employés', 'fas fa-user', User::class);

        
        yield MenuItem::linkToCrud('Demandes de contact', 'fas fa-envelope', Contact::class);
        yield MenuItem::linkToCrud('Comments', 'fas fa-comment', Comment::class);
        yield MenuItem::linkToCrud('Annonces', 'fas fa-car', Car::class);
        yield MenuItem::linkToCrud('Équipement', 'fas fa-hand-dots', Equipment::class);
        yield MenuItem::linkToCrud('Option', 'fas fa-bowl-food', Option::class);
        yield MenuItem::linkToCrud('Service', 'fas fa-hand-dots', Service::class);
        yield MenuItem::linkToCrud('Horaires', 'fas fa-hand-dots', Schedule::class);
    }
   
}

