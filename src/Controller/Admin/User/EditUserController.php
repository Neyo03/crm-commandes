<?php

namespace App\Controller\Admin\User;

use App\Entity\User;
use App\Form\Admin\UserType;
use App\Security\Enum\PermissionEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class EditUserController extends AbstractController
{
    #[IsGranted(PermissionEnum::USER_EDIT->value)]
    #[Route('/user/{user}/edit', name: 'app_edit_user_post', methods: ['POST'])]
    public function edit(User $user, Request $request, EntityManagerInterface $entityManager): Response
    {


        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $entityManager->persist($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_app_form_edit_user', ['user' => $user->getId()]);
    }
}
