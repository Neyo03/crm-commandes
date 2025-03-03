<?php

namespace App\Controller\Admin\Rattachement;

use App\Config\AdminCollectionConfig;
use App\Controller\Abstract\AbstractAdminController;
use App\Repository\RattachementRepository;
use App\Security\Enum\PermissionEnum;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class CollectionRattachementController extends AbstractAdminController
{
    #[IsGranted(PermissionEnum::RATTACHEMENT_COLLECTION->value)]
    #[Route('/rattachements', name: 'app_collection_rattachements')]
    public function collection(Request $request, RattachementRepository $repository): Response
    {
        $config = new AdminCollectionConfig(
            'RATTACHEMENT',
            $this->getRouteNameFromControllerMethod(FormRattachementController::class, 'formView'),
            '<i class="bi bi-person-add"></i>',
            'Créer un rattachement',
            $this->getCurrentRouteName()
        );

        return $this->renderAdminEntity($config, 'admin/rattachement/collection.html.twig', [
            'pagination' => $repository->paginate($request->query->getInt('page', 1))
        ]);
    }
}
