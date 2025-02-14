<?php

namespace App\Controller\Admin\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class NewUserController extends AbstractController
{
    #[Route('/new/user', name: 'app_new_user')]
    public function index(): Response
    {
        return $this->render('new_user/index.html.twig', [
            'controller_name' => 'NewUserController',
        ]);
    }
}
