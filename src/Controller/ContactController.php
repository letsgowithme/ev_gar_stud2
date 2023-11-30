<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ScheduleRepository;
use App\Service\MailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact.index')]
    public function index(
        Request $request,
        EntityManagerInterface $manager,
        MailService $mailService,
        ScheduleRepository $scheduleRepository,
        ): Response
    {
        $contact = new Contact();

        
        $formContact=$this->createForm(ContactType::class, $contact);

        $formContact->handleRequest($request);
        if ($formContact->isSubmitted() && $formContact->isValid()) {

             $contact = $formContact->getData();
             $manager->persist($contact);
             $manager->flush();

             //Email
             $mailService->sendEmail(
                $contact->getEmail(),
                $contact->getSubject(),
                'emails/contact.html.twig',
                ['contact' => $contact]
            );

            
             $this->addFlash(
                'success',
                'Votre message a été envoyé avec succès !'
            );
    
            return $this->redirectToRoute('home');
        
        }

       
        return $this->render('contact/index.html.twig', [
            'formContact' => $formContact->createView(),
            'schedules' => $scheduleRepository->findAll()

        ]);
    
    
    
    }
}
