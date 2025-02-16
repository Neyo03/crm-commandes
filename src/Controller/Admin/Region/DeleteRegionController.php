<?php

namespace App\Controller\Admin\Region;

use App\Entity\Region;
use App\Security\Enum\PermissionEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class DeleteRegionController extends AbstractController
{
    #[IsGranted(PermissionEnum::REGION_DELETE->value)]
    #[Route('/region/{region}/delete', name: 'app_delete_region', methods: ['DELETE'])]
    public function delete(
        Region $region,
        EntityManagerInterface $entityManager,
    ): Response {

        try {
            $entityManager->remove($region);
            $entityManager->flush();
        } catch (\Throwable $th) {
            $this->addFlash('error', 'Une erreur est survenue.');
        }

        return $this->redirectToRoute('admin_app_collection_regions');
    }
}
