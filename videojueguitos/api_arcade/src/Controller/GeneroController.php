<?php

namespace App\Controller;

use App\Entity\Genero;
use App\Form\GeneroType;
use App\Repository\GeneroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('main/genero')]
class GeneroController extends AbstractController
{

    #[Route('/todos', name: 'app_genero_todos', methods: ['GET'])]
    public function todosj(GeneroRepository $generoRepository, Request $request): Response
    {
        $generos=$generoRepository->findAll();
        $generosArray=[];
        foreach($generos as $genero){
            $generosArray[]=[
                'nombre' => $genero->getNombre(),
                'id' => $genero->getId(),
            ];
        }
        $response = new JsonResponse();
        $response->setData(
            $generosArray
        );
        return $response;
    }
    #[Route('/', name: 'app_genero_index', methods: ['GET'])]
    public function index(GeneroRepository $generoRepository): Response
    {
        return $this->render('genero/index.html.twig', [
            'generos' => $generoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_genero_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $genero = new Genero();
        $form = $this->createForm(GeneroType::class, $genero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($genero);
            $entityManager->flush();

            return $this->redirectToRoute('app_genero_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('genero/new.html.twig', [
            'genero' => $genero,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_genero_show', methods: ['GET'])]
    public function show(Genero $genero): Response
    {
        return $this->render('genero/show.html.twig', [
            'genero' => $genero,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_genero_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Genero $genero, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GeneroType::class, $genero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_genero_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('genero/edit.html.twig', [
            'genero' => $genero,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_genero_delete', methods: ['POST'])]
    public function delete(Request $request, Genero $genero, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$genero->getId(), $request->request->get('_token'))) {
            $entityManager->remove($genero);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_genero_index', [], Response::HTTP_SEE_OTHER);
    }
}
