<?php

namespace App\Controller\Admin\Region;

use App\Entity\Region;
use App\Form\Admin\RegionType;
use App\Security\Enum\PermissionEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class NewRegionController extends AbstractController
{
    #[IsGranted(PermissionEnum::REGION_CREATE->value)]
    #[Route('/region/new', name: 'app_new_region_post', methods: ['POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response {

        $region = new Region();

        $form = $this->createForm(RegionType::class, $region);
        $form->handleRequest($request);

        try {
            if ($form->isSubmitted() && $form->isValid()) {

                $region = $form->getData();

                $entityManager->persist($region);
                $entityManager->flush();

                $this->addFlash('success', 'Région créée avec succès !');
            }
        } catch (\Throwable $th) {
            $this->addFlash('error', 'Une erreur est survenue.');
        }



        return $this->redirectToRoute('admin_app_form_edit_region', ['region' => $region->getId()]);
    }
}
