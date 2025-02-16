<?php

namespace App\Controller\Admin\Region;

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
    public function collection(Request $request, RegionRepository $regionRepository): Response
    {
        $pagination = $regionRepository->regionPagination($request);

        return $this->render('admin/region/collection.html.twig', [
            'pagination' => $pagination
        ]);
    }
}
