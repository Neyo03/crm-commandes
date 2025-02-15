<?php

namespace App\Controller\Admin\User;

use App\Security\Enum\PermissionEnum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class CollectionUsersController extends AbstractController
{
    #[IsGranted(PermissionEnum::USER_COLLECTION->value)]
    #[Route('/users', name: 'app_collection_users')]
    public function collection(Request $request): Response
    {

        return $this->render('admin/user/collection.html.twig', [
            'controller_name' => 'CollectionUsersController',
        ]);
    }
}
