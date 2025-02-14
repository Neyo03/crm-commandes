<?php

namespace App\Controller\Admin\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CollectionUsersController extends AbstractController
{
    #[Route('/collection/users', name: 'app_collection_users')]
    public function index(): Response
    {
        return $this->render('collection_users/index.html.twig', [
            'controller_name' => 'CollectionUsersController',
        ]);
    }
}
