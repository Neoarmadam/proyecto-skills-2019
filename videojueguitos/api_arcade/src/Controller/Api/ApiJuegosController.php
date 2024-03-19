<?php

namespace App\Controller\Api;

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


#[Route('api/juegos')]
class ApiJuegosController extends AbstractController
{
        
    #[Route('/todos', name: 'api_juegos_todos', methods: ['GET'])]
    public function todosj(JuegosRepository $juegosRepository, Request $request): Response
    {
        $juegos=$juegosRepository->findAll(1);
        $juegosArray=[];
        foreach($juegos as $juego){
            $generosArray = [];
        foreach ($juego->getGeneros() as $genero) {
            $generosArray[] = [
                'nombre' => $genero->getNombre(), 
            ];
        }
            $juegosArray[]=[
                'nombre' => $juego->getNombre(),
                'descripcion' => $juego->getDescripcion(),
                'positivos' => $juego->getVotosPositivos(),
                'negativos' => $juego->getVotosNegativos(),
                'imagen' => base64_encode(stream_get_contents($juego->getImagen())),
                'generos' => $generosArray
            ];
        }
        $response = new JsonResponse();
        $response->setData(
            $juegosArray
        );
        return $response;
    }
    
    #[Route('/genero{genero}', name: 'api_juegos_genero', methods: ['GET'])]
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
                $juegosArray[]=[
                    'nombre' => $game->getNombre(),
                    'descripcion' => $game->getDescripcion(),
                    'positivos' => $game->getVotosPositivos(),
                    'negativos' => $game->getVotosNegativos(),
                    'imagen' => base64_encode(stream_get_contents($game->getImagen())),
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
}
