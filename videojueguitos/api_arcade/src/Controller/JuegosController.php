<?php

namespace App\Controller;

use App\Entity\Juegos;
use App\Entity\JuegosGenero;
use App\Form\JuegosType;
use App\Repository\JuegosRepository;
use App\Repository\JuegosGeneroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\DBAL\Types\Types;


#[Route('main/juegos')]
class JuegosController extends AbstractController
{
    
    #[Route('/todos', name: 'app_juegos_todos', methods: ['GET'])]
    public function todosj(JuegosRepository $juegosRepository, Request $request): Response
    {
        $juegos=$juegosRepository->findAll();
        $juegosArray=[];
        foreach($juegos as $juego){
            $generosArray = [];
            foreach ($juego->getGeneros() as $genero) {
                $generosArray[] = [
                    'nombre' => $genero->getNombre(), 
                ];
            }
            if($juego->getImagen()!==null){
                $juegosArray[]=[
                    'nombre' => $juego->getNombre(),
                    'descripcion' => $juego->getDescripcion(),
                    'positivos' => $juego->getVotosPositivos(),
                    'negativos' => $juego->getVotosNegativos(),
                    'imagen' => base64_encode(stream_get_contents($juego->getImagen())),
                    'generos' => $generosArray
                ];
            }
            else{
                $juegosArray[]=[
                    'nombre' => $juego->getNombre(),
                    'descripcion' => $juego->getDescripcion(),
                    'positivos' => $juego->getVotosPositivos(),
                    'negativos' => $juego->getVotosNegativos(),
                    'imagen' => "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",
                    'generos' => $generosArray
                ];
            }
        }
            $response = new JsonResponse();
            $response->setData(
                $juegosArray
            );
            return $response;
    
}
#[Route('/mejores', name: 'app_juegos_mejores', methods: ['GET'])]
public function mejoresj(JuegosRepository $juegosRepository, Request $request): Response
{
    $juegos = $juegosRepository->findAll();
    usort($juegos, function($juego1, $juego2) {
        $dif_juego1 = $juego1->getVotosPositivos() - $juego1->getVotosNegativos();
        $dif_juego2 = $juego2->getVotosPositivos() - $juego2->getVotosNegativos();
        if ($dif_juego1 == $dif_juego2) {
            return 0;
        }
        return ($dif_juego1 > $dif_juego2) ? -1 : 1;
    });

    $juegosArray = [];
    foreach ($juegos as $juego) {
        $generosArray = [];
        foreach ($juego->getGeneros() as $genero) {
            $generosArray[] = [
                'nombre' => $genero->getNombre(),
            ];
        }
        if ($juego->getImagen() !== null) {
            $juegosArray[] = [
                'nombre' => $juego->getNombre(),
                'descripcion' => $juego->getDescripcion(),
                'positivos' => $juego->getVotosPositivos(),
                'negativos' => $juego->getVotosNegativos(),
                'imagen' => base64_encode(stream_get_contents($juego->getImagen())),
                'generos' => $generosArray
            ];
        }
        else{
            $juegosArray[]=[
                'nombre' => $juego->getNombre(),
                'descripcion' => $juego->getDescripcion(),
                'positivos' => $juego->getVotosPositivos(),
                'negativos' => $juego->getVotosNegativos(),
                'imagen' => "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",
                'generos' => $generosArray
            ];
        }
    }
        $response = new JsonResponse();
        $response->setData(
            $juegosArray
        );
        return $response;

}
    #[Route('/genero{genero}', name: 'app_juegos_genero', methods: ['GET'])]
    public function jugosg(JuegosRepository $juegosRepository,
     Request $request,
     JuegosGeneroRepository $juegosGeneroRepository,
      int $genero): Response
    {
        $id_juegos = $juegosGeneroRepository->findByGeneroid($genero);
        $juegosArray=[];
        foreach($id_juegos as $juegos){
            $juego=$juegosRepository->findByid($juegos->getIdJuego());
            foreach ($juego as $game){
                $generosArray = [];
                foreach ($game->getGeneros() as $genero) {
                    $generosArray[] = [
                        'nombre' => $genero->getNombre(), 
                    ];
                }
                if($game->getImagen()!==null){
                    $juegosArray[]=[
                        'nombre' => $game->getNombre(),
                        'descripcion' => $game->getDescripcion(),
                        'positivos' => $game->getVotosPositivos(),
                        'negativos' => $game->getVotosNegativos(),
                        'imagen' => base64_encode(stream_get_contents($game->getImagen())),
                        'generos' => $generosArray
                    ];
                }
                else{
                    $juegosArray[]=[
                        'nombre' => $game->getNombre(),
                        'descripcion' => $game->getDescripcion(),
                        'positivos' => $game->getVotosPositivos(),
                        'negativos' => $game->getVotosNegativos(),
                        'imagen' => "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",
                        'generos' => $generosArray
                    ];
                }
            }
        }
        $response = new JsonResponse();
        $response->setData(
            $juegosArray
        );
        return $response;
    }
    
    #[Route('/', name: 'app_juegos_index', methods: ['GET'])]
    public function index(JuegosRepository $juegosRepository): Response
    {
        return $this->render('juegos/index.html.twig', [
            'juegos' => $juegosRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_juegos_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $juego = new Juegos();
        $form = $this->createForm(JuegosType::class, $juego);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imagenFile = $form->get('imagen')->getData();
            if ($imagenFile) {
                $imagenData = file_get_contents($imagenFile->getPathname());
                $juego->setImagen($imagenData);
            }
            $entityManager->persist($juego);
            $entityManager->flush();

            return $this->redirectToRoute('app_juegos_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('juegos/new.html.twig', [
            'juego' => $juego,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_juegos_show', methods: ['GET'])]
    public function show(Juegos $juego): Response
    {
        return $this->render('juegos/show.html.twig', [
            'juego' => $juego,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_juegos_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Juegos $juego, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(JuegosType::class, $juego);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Acceder al archivo de imagen
            $imagenFile = $form->get('imagen')->getData();

            // Verificar si se ha subido una nueva imagen
            if ($imagenFile) {
                // Leer el contenido del archivo de imagen
                $imagenData = file_get_contents($imagenFile->getPathname());

                // Guardar el contenido del archivo de imagen en la entidad Juego
                $juego->setImagen($imagenData);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_juegos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('juegos/edit.html.twig', [
            'juego' => $juego,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_juegos_delete', methods: ['POST'])]
    public function delete(Request $request, Juegos $juego, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$juego->getId(), $request->request->get('_token'))) {
            $entityManager->remove($juego);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_juegos_index', [], Response::HTTP_SEE_OTHER);
    }
}
