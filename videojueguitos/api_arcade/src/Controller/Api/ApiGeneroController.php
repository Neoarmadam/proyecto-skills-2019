<?php

namespace App\Controller\Api;

use App\Entity\Genero;
use App\Form\GeneroType;
use App\Repository\GeneroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/genero')]
class ApiGeneroController extends AbstractController
{
}
