<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\ScheduleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/connexion', name: 'security.login', methods: ['GET', 'POST'])]
    public function login(
        AuthenticationUtils $authenticationUtils, 
        ScheduleRepository $scheduleRepository
        ): Response
    { 
        /**
        * This controller allows us to login
        *
        * @param AuthenticationUtils $authenticationUtils
        * @return Response
        */
   

        return $this->render('pages/security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'schedules' => $scheduleRepository->findAll()
        ]);
    }

     /**
     * This controller allows us to logout
     *
     * @return void
     */

    #[Route('/deconnexion', name: 'security.logout')]
    public function logout() {
        // Nothing to do here
    }

    /**
     * This controller allows us to register 
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */

     #[Route('/inscription', 'security.registration', methods: ['GET', 'POST'])]
    public function registration(Request $request, EntityManagerInterface $manager, ScheduleRepository $scheduleRepository): Response
    {
        $user = new User();
        $user->setRoles(['ROLE_USER']);

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $this->addFlash(
                'success',
                'Votre compte a bien été créé.'
            );

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('security.login');
        }

        return $this->render('pages/security/registration.html.twig', [
            'form' => $form->createView(), 
            'schedules' => $scheduleRepository->findAll()
        ]);
    }
 }