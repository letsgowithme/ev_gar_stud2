<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ScheduleRepository;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/connexion', name: 'app_login')]
        public function login(AuthenticationUtils $authenticationUtils,
        ScheduleRepository $scheduleRepository
        ): Response
    {   /**
        * This controller allows us to login
        *
        * @param AuthenticationUtils $authenticationUtils
        * @return Response
        */
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername, 
            'error' => $error,
            'schedules' => $scheduleRepository->findAll()
        ]);
    }

    #[Route(path: '/deconnexion', name: 'app_logout')]
    public function logout(): Response {
        return $this->render('index.html.twig');
    }

}
