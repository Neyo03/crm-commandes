<?php

namespace App\Controller\Admin\User;

use App\Entity\User;
use App\Security\Enum\PermissionEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class DeleteUserController extends AbstractController
{
    #[IsGranted(PermissionEnum::USER_DELETE->value)]
    #[Route('/user/{user}/delete', name: 'app_delete_user', methods: ['DELETE'])]
    public function delete(
        User $user,
        EntityManagerInterface $entityManager,
    ): Response {

        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('admin_app_collection_users');
    }
}
