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
use Symfony\Component\Security\Http\Attribute\IsGranted;

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
    // #[Route('/commentsAll', name: 'comment.index', methods: ['GET'])]
    // public function indexAll(
    //     CommentRepository $commentRepository,
    //     ScheduleRepository $scheduleRepository
    //     ): Response
    // {
    //     return $this->render('comment/index.html.twig', [
    //         'comments' => $commentRepository->findAll(),
    //         'schedules' => $scheduleRepository->findAll()
    //     ]);
    // }

    #[Route('/new', name: 'partials._comment', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,
    ScheduleRepository $scheduleRepository
    ): Response
    {
        $comment = new Comment();
        $commentForm = $this->createForm(CommentType::class, $comment);
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('partials/_comment.html.twig', [
            'comment' => $comment,
            'commentForm' => $commentForm,
            'schedules' => $scheduleRepository->findAll()
        ]);
    }

    #[Route('/{id}/show', name: 'comment.show', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function show(Comment $comment): Response
    {
        return $this->render('comment/show.html.twig', [
            'comment' => $comment,
        ]);
    }


    #[Route('/{id}/edit', name: 'comment.edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function edit(Request $request, Comment $comment, EntityManagerInterface $entityManager): Response
    {
        $commentForm = $this->createForm(CommentType::class, $comment);
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('car.user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('comment/edit.html.twig', [
            'comment' => $comment,
            'commentForm' => $commentForm,
        ]);
    }

    #[Route('/{id}', name: 'comment.delete', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function delete(Request $request, Comment $comment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->request->get('_token'))) {
            $entityManager->remove($comment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('car.user_index', [], Response::HTTP_SEE_OTHER);
    }
}
