<?php

namespace App\Controller\Admin\User;

use App\Config\AdminCollectionConfig;
use App\Controller\Abstract\AbstractAdminController;
use App\Repository\UserRepository;
use App\Security\Enum\PermissionEnum;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class CollectionUsersController extends AbstractAdminController
{
    #[IsGranted(PermissionEnum::USER_COLLECTION->value)]
    #[Route('/users', name: 'app_collection_users')]
    public function collection(Request $request, UserRepository $repository): Response
    {
        $config = new AdminCollectionConfig(
            'UTILISATEUR',
            $this->getRouteNameFromControllerMethod(FormUserController::class, 'formView'),
            '<i class="bi bi-person-add"></i>',
            'Créer un utilisateur',
            $this->getCurrentRouteName()
        );

        return $this->renderAdminEntity($config, 'admin/user/collection.html.twig', [
            'pagination' => $repository->paginate($request->query->getInt('page', 1))
        ]);
    }
}
