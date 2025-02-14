<?php

namespace App\Controller\Admin\Region;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CollectionRegionsController extends AbstractController
{
    #[Route('/collection/regions', name: 'app_collection_regions')]
    public function index(): Response
    {
        return $this->render('collection_regions/index.html.twig', [
            'controller_name' => 'CollectionRegionsController',
        ]);
    }
}
