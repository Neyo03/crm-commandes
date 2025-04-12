<?php

namespace App\Controller\Admin\Region;

use App\Config\AdminCollectionConfig;
use App\Controller\Abstract\AbstractAdminController;
use App\Repository\RegionRepository;
use App\Security\Enum\PermissionEnum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class CollectionRegionsController extends AbstractController
{
    #[IsGranted(PermissionEnum::REGION_COLLECTION->value)]
    #[Route('/regions', name: 'app_collection_regions')]
    public function collection(Request $request, RegionRepository $repository): Response
    {
        return $this->render('admin/region/collection.html.twig', [
            'pagination' => $repository->paginate($request->query->getInt('page', 1))
        ]);
    }
}
