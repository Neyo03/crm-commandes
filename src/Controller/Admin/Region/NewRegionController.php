<?php

namespace App\Controller\Admin\Region;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class NewRegionController extends AbstractController
{
    #[Route('/new/region', name: 'app_new_region')]
    public function index(): Response
    {
        return $this->render('new_region/index.html.twig', [
            'controller_name' => 'NewRegionController',
        ]);
    }
}
