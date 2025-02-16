<?php

namespace App\Controller\Admin\Region;

use App\Entity\Region;
use App\Form\Admin\RegionType;
use App\Security\Enum\PermissionEnum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class FormRegionController extends AbstractController
{
    #[IsGranted(PermissionEnum::REGION_VIEW->value)]
    #[Route('/form/region/new', name: 'app_form_new_region', methods: ['GET'])]
    #[Route('/form/region/{region}/edit', name: 'app_form_edit_region', methods: ['GET'])]
    public function formView(?Region $region = null, Request $request): Response
    {
        $routeName = $request->get('_route');
        if (!$region && $routeName !== 'admin_app_form_new_region') {
            return $this->redirectToRoute('admin_app_form_new_region');
        }

        $action = $region ? $this->generateUrl('admin_app_edit_region_post', ['region' => $region->getId()]) : $this->generateUrl('admin_app_new_region_post');
        $form = $this->createForm(RegionType::class, $region, ['action' => $action]);

        return $this->render('admin/region/form.html.twig', [
            'form' => $form->createView(),
            'regionId' => $region ? $region->getId() : null
        ]);
    }
}
