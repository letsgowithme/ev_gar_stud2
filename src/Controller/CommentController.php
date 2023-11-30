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

}
