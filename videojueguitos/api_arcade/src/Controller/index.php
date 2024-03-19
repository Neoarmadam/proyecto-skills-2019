<?php
 
namespace App\Controller;
 
 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
 
#[Route('/')]
class index extends AbstractController
{
    #[Route('/', name: 'app_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('crud/index.html.twig', [
        ]);
    }
    #[Route('/registro', name: 'app_registro', methods: ['GET'])]
    public function registro(): Response
    {
        return $this->render('crud/registro.html.twig', [
        ]);
    }
}