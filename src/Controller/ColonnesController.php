<?php

namespace App\Controller;

use App\Entity\Colonnes;
use App\Form\ColonnesType;
use App\Repository\ColonnesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/colonnes')]
final class ColonnesController extends AbstractController
{
    #[Route(name: 'app_colonnes_index', methods: ['GET'])]
    public function index(ColonnesRepository $colonnesRepository): Response
    {
        return $this->render('colonnes/index.html.twig', [
            'colonnes' => $colonnesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_colonnes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $colonne = new Colonnes();
        $formColonne = $this->createForm(ColonnesType::class, $colonne);
        $formColonne->handleRequest($request);

        if ($formColonne->isSubmitted() && $formColonne->isValid()) {
            $entityManager->persist($colonne);
            $entityManager->flush();

            return $this->redirectToRoute('app_colonnes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('colonnes/new.html.twig', [
            'colonne' => $colonne,
            'formColonne' => $formColonne,
        ]);
    }

    #[Route('/{id}', name: 'app_colonnes_show', methods: ['GET'])]
    public function show(Colonnes $colonne): Response
    {
        return $this->render('colonnes/show.html.twig', [
            'colonne' => $colonne,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_colonnes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Colonnes $colonne, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ColonnesType::class, $colonne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_colonnes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('colonnes/edit.html.twig', [
            'colonne' => $colonne,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_colonnes_delete', methods: ['POST'])]
    public function delete(Request $request, Colonnes $colonne, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$colonne->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($colonne);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_colonnes_index', [], Response::HTTP_SEE_OTHER);
    }
}
