<?php

namespace App\Controller\Admin\User;

use App\Entity\User;
use App\Security\Enum\PermissionEnum;
use App\Service\Security\LoginLinkService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class LinkUserController extends AbstractController
{
    #[IsGranted(PermissionEnum::USER_DELETE->value)]
    #[Route('/user/{user}/link', name: 'app_link_user', methods: ['POST'])]
    public function linkRegenerate(
        User $user,
        EntityManagerInterface $entityManager,
        LoginLinkService $loginLinkService
    ): Response {

        try {
            $loginLink = $loginLinkService->generateLoginLink($user);

            $user
                ->setLoginLink($loginLink)
                ->setIsFirstLogin(true)
            ;

            $entityManager->persist($user);
            $entityManager->flush();
        } catch (\Throwable $th) {
            $this->addFlash('error', 'Une erreur est survenue.');
        }


        return $this->json(['loginLink' => $loginLink], 200);;
    }
}
