<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class PerfilController extends AbstractController
{
    #[Route('/api/perfil', name: 'app_perfil')]
    public function index(): Response
    {
      $user=$this->getUser();
      return new JsonResponse([
        'usuarios' => $user->getUserIdentifier()
      ]);
    }
}