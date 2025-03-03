<?php

namespace App\Controller\Admin\Rattachement;

use App\Entity\Rattachement;
use App\Security\Enum\PermissionEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class DeleteRattachementController extends AbstractController
{
    #[IsGranted(PermissionEnum::RATTACHEMENT_DELETE->value)]
    #[Route('/rattachement/{rattachement}/delete', name: 'app_delete_rattachement', methods: ['DELETE'])]
    public function delete(
        Rattachement $rattachement,
        EntityManagerInterface $entityManager,
    ): Response {

        try {
            $entityManager->remove($rattachement);
            $entityManager->flush();
        } catch (\Throwable $th) {
            $this->addFlash('error', 'Une erreur est survenue.');
        }

        return $this->redirectToRoute('admin_app_collection_rattachements');
    }
}
