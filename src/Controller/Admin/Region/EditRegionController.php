<?php

namespace App\Controller\Admin\Region;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EditRegionController extends AbstractController
{
    #[Route('/edit/region', name: 'app_edit_region')]
    public function index(): Response
    {
        return $this->render('edit_region/index.html.twig', [
            'controller_name' => 'EditRegionController',
        ]);
    }
}
