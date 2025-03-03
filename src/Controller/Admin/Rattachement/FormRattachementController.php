<?php

namespace App\Controller\Admin\Rattachement;

use App\Entity\Rattachement;
use App\Form\Admin\RattachementType;
use App\Security\Enum\PermissionEnum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class FormRattachementController extends AbstractController
{
    #[IsGranted(PermissionEnum::RATTACHEMENT_VIEW->value)]
    #[Route('/form/rattachement/new', name: 'app_form_new_rattachement', methods: ['GET'])]
    #[Route('/form/rattachement/{rattachement}/edit', name: 'app_form_edit_rattachement', methods: ['GET'])]
    public function formView(?Rattachement $rattachement = null, Request $request): Response
    {
        $routeName = $request->get('_route');
        if (!$rattachement && $routeName !== 'admin_app_form_new_rattachement') {
            return $this->redirectToRoute('admin_app_form_new_rattachement');
        }

        $action = $rattachement ? $this->generateUrl('admin_app_edit_rattachement_post', ['rattachement' => $rattachement->getId()]) : $this->generateUrl('admin_app_new_rattachement_post');
        $form = $this->createForm(RattachementType::class, $rattachement, ['action' => $action]);

        return $this->render('admin/rattachement/form.html.twig', [
            'form' => $form->createView(),
            'rattachementId' => $rattachement?->getId()
        ]);
    }
}
