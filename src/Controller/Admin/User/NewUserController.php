<?php

namespace App\Controller\Admin\User;

use App\Entity\User;
use App\Form\Admin\UserType;
use App\Security\Enum\PermissionEnum;
use App\Service\Security\LoginLinkService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Http\LoginLink\LoginLinkHandlerInterface;

final class NewUserController extends AbstractController
{
    #[IsGranted(PermissionEnum::USER_CREATE->value)]
    #[Route('/user/new', name: 'app_new_user_post', methods: ['POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        LoginLinkService $loginLinkService,
        UserPasswordHasherInterface $passwordHasher
    ): Response {

        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        try {
            if ($form->isSubmitted() && $form->isValid()) {

                $user = $form->getData();
                $hashedPassword = $passwordHasher->hashPassword(
                    $user,
                    uniqid()
                );

                $user->setPassword($hashedPassword);

                $loginLink = $loginLinkService->generateLoginLink($user);

                $user->setLoginLink($loginLink);

                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('success', 'Utilisateur créé avec succès !');
            }
        } catch (\Throwable $th) {
            $this->addFlash('error', 'Une erreur est survenue.');
        }


        return $this->redirectToRoute('admin_app_form_edit_user', ['user' => $user->getId()]);
    }
}
