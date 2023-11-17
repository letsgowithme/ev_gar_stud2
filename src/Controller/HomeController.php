<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\ScheduleRepository;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET', 'POST'])]
    public function index(ScheduleRepository $scheduleRepository,
    CommentRepository $commentRepository,
    Request $request,
    EntityManagerInterface $manager,
    ServiceRepository $serviceRepository
    ): Response
    {
        $schedules = $scheduleRepository->findAll(); 
        $comments = $commentRepository->findAll(); 
       

        $comment = new Comment();
        
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
            return $this->redirectToRoute('home.index', ['id' => $comment->getId()]);
        }

        return $this->render('home/index.html.twig', [
            'schedules' => $schedules,
            'comments' => $comments,
            'commentForm' => $commentForm,
            'bestComments' => $commentRepository->findBestComments(3),
            'services' => $serviceRepository->findAll()
            
        ]);
    }
    #[Route('/legal_notice', name: 'footer.legal_notice', methods: ['GET'])]
    public function legalNotice(
       
    ): Response
    {
        return $this->render('pages/footer/legal_notice.html.twig');
    }
    #[Route('/privacy', name: 'footer.privacy_policy', methods: ['GET'])]
    public function privacy(
    
    ): Response
    {
        return $this->render('pages/footer/privacy_policy.html.twig');
    }
}
