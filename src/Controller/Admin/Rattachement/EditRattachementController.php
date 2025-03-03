<?php

namespace App\Controller\Admin\Rattachement;

use App\Entity\Rattachement;
use App\Entity\Region;
use App\FORM\Admin\RattachementType;
use App\Form\Admin\RegionType;
use App\Security\Enum\PermissionEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class EditRattachementController extends AbstractController
{
    #[IsGranted(PermissionEnum::RATTACHEMENT_EDIT->value)]
    #[Route('/rattachement/{rattachement}/edit', name: 'app_edit_rattachement_post', methods: ['POST'])]
    public function edit(Rattachement $rattachement, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RattachementType::class, $rattachement);
        $form->handleRequest($request);

        try {
            if ($form->isSubmitted() && $form->isValid()) {
                $rattachement = $form->getData();

                $entityManager->persist($rattachement);
                $entityManager->flush();

                $this->addFlash('success', 'Rattachement mise à jour !');
            }
        } catch (\Throwable $th) {
            $this->addFlash('error', 'Une erreur est survenue.');
        }

        return $this->redirectToRoute('admin_app_form_edit_rattachement', ['rattachement' => $rattachement->getId()]);
    }
}
