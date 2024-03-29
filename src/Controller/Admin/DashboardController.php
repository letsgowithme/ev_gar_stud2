<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use App\Entity\Comment;
use App\Entity\Contact;
use App\Entity\Equipment;
use App\Entity\CarOption;
use App\Entity\Schedule;
use App\Entity\Service;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[IsGranted('ROLE_ADMIN', statusCode: 403, exceptionCode: 10010)]
class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
   
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'L \'utilisateur a tenté d\'accéder à une page sans avoir le ROLE_ADMIN');
        return $this->render('admin/dashboard.html.twig');
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
        yield MenuItem::linkToCrud('Témoignage', 'fas fa-comment', Comment::class);
        yield MenuItem::linkToCrud('Annonces', 'fas fa-car', Car::class);
        yield MenuItem::linkToCrud('Équipement', 'fas fa-hand-dots', Equipment::class);
        yield MenuItem::linkToCrud('Option', 'fas fa-bowl-food', CarOption::class);
        yield MenuItem::linkToCrud('Service', 'fas fa-hand-dots', Service::class);
        yield MenuItem::linkToCrud('Horaires', 'fas fa-hand-dots', Schedule::class);
    }
   
}

