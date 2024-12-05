<?php

namespace App\Controller;

use App\Entity\Cartes;
use App\Form\CartesType;
use App\Repository\CartesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cartes')]
final class CartesController extends AbstractController
{
    #[Route(name: 'app_cartes_index', methods: ['GET'])]
    public function index(CartesRepository $cartesRepository): Response
    {
        return $this->render('cartes/index.html.twig', [
            'cartes' => $cartesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cartes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $carte = new Cartes();
        $formCarte = $this->createForm(CartesType::class, $carte);
        $formCarte->handleRequest($request);

        if ($formCarte->isSubmitted() && $formCarte->isValid()) {
            $entityManager->persist($carte);
            $entityManager->flush();

            return $this->redirectToRoute('app_cartes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cartes/new.html.twig', [
            'carte' => $carte,
            'formCarte' => $formCarte,
        ]);
    }

    #[Route('/{id}', name: 'app_cartes_show', methods: ['GET'])]
    public function show(Cartes $carte): Response
    {
        return $this->render('cartes/show.html.twig', [
            'carte' => $carte,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cartes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cartes $carte, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CartesType::class, $carte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cartes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cartes/edit.html.twig', [
            'carte' => $carte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cartes_delete', methods: ['POST'])]
    public function delete(Request $request, Cartes $carte, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carte->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($carte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cartes_index', [], Response::HTTP_SEE_OTHER);
    }
}
