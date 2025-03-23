<?php

namespace App\Controller\Admin\User;

use App\Entity\User;
use App\Form\Admin\UserType;
use App\Security\Enum\PermissionEnum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class FormUserController extends AbstractController
{
    #[IsGranted(PermissionEnum::USER_VIEW->value)]
    #[Route('/form/user/new', name: 'app_form_new_user', methods: ['GET'])]
    #[Route('/form/user/{user}', name: 'app_form_edit_user', methods: ['GET'])]
    public function formView(?User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);

        return $this->render('admin/user/form.html.twig', [
            'form' => $form->createView(),
            'loginLink' => $user?->getLoginLink(),
            'userId' => $user?->getId()
        ]);
    }
}
