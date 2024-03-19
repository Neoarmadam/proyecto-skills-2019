<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LogoutController extends AbstractController
{
    #[Route('/logout', name: 'app_logout', methods:['GET'])]
    public function logout()
    {
       throw new \Exception('Don\'t forget to activate');
    }
}
