<?php

namespace App\Controller\Admin\Rattachement;

use App\Entity\Rattachement;
use App\Form\Admin\RattachementType;
use App\Security\Enum\PermissionEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class NewRattachementController extends AbstractController
{
    #[IsGranted(PermissionEnum::RATTACHEMENT_CREATE->value)]
    #[Route('/rattachement/new', name: 'app_new_rattachement_post', methods: ['POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response {

        $rattachement = new Rattachement();

        $form = $this->createForm(RattachementType::class, $rattachement);
        $form->handleRequest($request);

        try {
            if ($form->isSubmitted() && $form->isValid()) {

                $rattachement = $form->getData();

                $entityManager->persist($rattachement);
                $entityManager->flush();

                $this->addFlash('success', 'Rattachement créée avec succès !');

                return $this->redirectToRoute('admin_app_form_edit_rattachement', ['rattachement' => $rattachement->getId()]);
            }
        } catch (\Throwable $th) {
            $this->addFlash('error', 'Une erreur est survenue.');
        }

        return $this->redirectToRoute('admin_app_form_new_rattachement', ['rattachement' => $rattachement->getId()]);
    }
}
