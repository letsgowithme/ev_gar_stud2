<?php

namespace App\Controller;

use App\Entity\CarOption;
use App\Form\CarOptionType;
use App\Repository\CarOptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/carOption')]

class CarOptionController extends AbstractController
{
    #[Route('/', name: 'app_carOption_index', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function index(CarOptionRepository $carOptionRepository): Response
    {
        return $this->render('carOption/index.html.twig', [
            'carOptions' => $carOptionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_carOption_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $carOption = new CarOption();
        $form = $this->createForm(CarOptionType::class, $carOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($carOption);
            $entityManager->flush();

            return $this->redirectToRoute('app_carOption_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('carOption/new.html.twig', [
            'carOption' => $carOption,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_carOption_show', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function show(CarOption $carOption): Response
    {
        return $this->render('carOption/show.html.twig', [
            'carOption' => $carOption,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_carOption_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function edit(Request $request, CarOption $carOption, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CarOptionType::class, $carOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_carOption_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('carOption/edit.html.twig', [
            'carOption' => $carOption,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_carOption_delete', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function delete(Request $request, CarOption $carOption, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carOption->getId(), $request->request->get('_token'))) {
            $entityManager->remove($carOption);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_carOption_index', [], Response::HTTP_SEE_OTHER);
    }
}
