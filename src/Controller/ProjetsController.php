<?php

namespace App\Controller;

use App\Entity\Projets;
use App\Entity\Colonnes;
use App\Entity\Cartes;
use App\Form\ProjetsType;
use App\Form\ColonnesType;
use App\Form\CartesType;
use App\Repository\ProjetsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/projets')]
final class ProjetsController extends AbstractController
{
    #[Route(name: 'app_projets_index', methods: ['GET', 'POST'])]
    public function index(ProjetsRepository $projetsRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $projet = new Projets();
        $form = $this->createForm(ProjetsType::class, $projet);
        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                // $projet->addUser($this->user);
                $entityManager->persist($projet);
                $entityManager->flush();
                

                return $this->redirectToRoute('app_projets_index', [], Response::HTTP_SEE_OTHER);
            }

        return $this->render('projets/index.html.twig', [
            'projet' => $projet,
            'form' => $form->createView(),
            'projets' => $projetsRepository->findAll(),
        ]);
    }


    #[Route('/new', name: 'app_projets_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $projet = new Projets();
        $form = $this->createForm(ProjetsType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $projet->setDateCreation(new \DateTime());
            $entityManager->persist($projet);
            $entityManager->flush();
            

            return $this->redirectToRoute('app_projets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('projets/new.html.twig', [
            'projet' => $projet,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_projets_show', methods: ['POST', 'GET'])]
    public function show(Projets $projet, Request $request, EntityManagerInterface $entityManager, ProjetsRepository $projetsRepository): Response
    {
        $colonne = new Colonnes();
        $colonne->setProjets($projet);

        $carte = new Cartes();
        $formCarte = $this->createForm(CartesType::class, $carte);
        $formCarte->handleRequest($request);

        $formColonne = $this->createForm(ColonnesType::class, $colonne);
        $formColonne->handleRequest($request);

        if ($formColonne->isSubmitted() && $formColonne->isValid()) {
            $entityManager->persist($colonne);
            $entityManager->flush();
            

            return $this->redirectToRoute('app_projets_show', ['id' => $projet->getId()], Response::HTTP_SEE_OTHER);
        }

        if ($formCarte->isSubmitted() && $formCarte->isValid()) {
            $entityManager->persist($carte);
            $entityManager->flush();
            

            return $this->redirectToRoute('app_projets_show', ['id' => $projet->getId()], Response::HTTP_SEE_OTHER);
        }

        // foreach ($projet->getColonnes() as $uneColonne )
        // {
        //     foreach ($uneColonne->getCartes() as $uneCarte)
        //     {
        //         dd($uneCarte);
        //     }
        // }

        

        return $this->render('projets/show.html.twig', [
            'projet' => $projet,
            'formColonne' => $formColonne->createView(),
            'formCarte' => $formCarte->createView(),
            'colonnes' => $projet->getColonnes(),
            // 'cartes' => $projet->getColonnes()->getCartes(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_projets_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Projets $projet, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProjetsType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_projets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('projets/edit.html.twig', [
            'projet' => $projet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_projets_delete', methods: ['POST'])]
    public function delete(Request $request, Projets $projet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$projet->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($projet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_projets_index', [], Response::HTTP_SEE_OTHER);
    }
}
