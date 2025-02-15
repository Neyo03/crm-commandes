<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FirstLoginController extends AbstractController
{
    #[Route('/first/login', name: 'app_first_login')]
    public function index(): Response
    {
        return $this->render('first_login/index.html.twig', [
            'controller_name' => 'FirstLoginController',
        ]);
    }
}
