<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\ScheduleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/comments', name: 'partials._commentsAll', methods: ['GET'])]
    public function index(
        CommentRepository $commentRepository,
        ScheduleRepository $scheduleRepository
        ): Response
    {
        return $this->render('partials/_commentsAll.html.twig', [
            'comments' => $commentRepository->findAll(),
            'schedules' => $scheduleRepository->findAll()
        ]);
    }

    // #[Route('/new', name: 'partials._comment', methods: ['GET', 'POST'])]
    // public function new(Request $request, EntityManagerInterface $entityManager,
    // ScheduleRepository $scheduleRepository
    // ): Response
    // {
    //     $comment = new Comment();
    //     $commentForm = $this->createForm(CommentType::class, $comment);
    //     $commentForm->handleRequest($request);

    //     if ($commentForm->isSubmitted() && $commentForm->isValid()) {
    //         $entityManager->persist($comment);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('comment.index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('partials/_comment.html.twig', [
    //         'comment' => $comment,
    //         'commentForm' => $commentForm,
    //         'schedules' => $scheduleRepository->findAll()
    //     ]);
    // }
}