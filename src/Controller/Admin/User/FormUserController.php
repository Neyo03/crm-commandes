<?php

namespace App\Controller\Admin\User;

use App\Controller\Abstract\AbstractAdminController;
use App\Entity\User;
use App\Form\Admin\UserType;
use App\Security\Enum\PermissionEnum;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class FormUserController extends AbstractAdminController
{
    #[IsGranted(PermissionEnum::USER_VIEW->value)]
    #[Route('/form/user/new', name: 'app_form_new_user', methods: ['GET'])]
    #[Route('/form/user/{user}/edit', name: 'app_form_edit_user', methods: ['GET'])]
    public function formView(?User $user = null, Request $request): Response
    {
        $routeName = $request->get('_route');
        if (!$user && $routeName !== 'admin_app_form_new_user') {
            return $this->redirectToRoute('admin_app_form_new_user');
        }

        $action = $user ? $this->generateUrl('admin_app_edit_user_post', ['user' => $user->getId()]) : $this->generateUrl('admin_app_new_user_post');
        $form = $this->createForm(UserType::class, $user, ['action' => $action]);

        return $this->renderUserTemplate('admin/user/form.html.twig', [
            'form' => $form->createView(),
            'loginLink' => $user ? $user->getLoginLink() : null,
            'userId' => $user ? $user->getId() : null
        ]);
    }
}
