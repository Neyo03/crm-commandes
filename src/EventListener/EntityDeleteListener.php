<?php

namespace App\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[AsEventListener(event: 'kernel.request', method: 'onKernelRequest')]
class EntityDeleteListener
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly RouterInterface $router,
    ) {}

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        dd($request);
        if ($request->getMethod() !== Request::METHOD_DELETE) {
            return;
        }

        $routeParams = $request->attributes->get('_route_params');
        $entityClass = $this->getEntityClassFromRoute($request->attributes->get('_route'));

        if (!$entityClass || !isset($routeParams['id'])) {
            return;
        }

        // Récupération de l'entité concernée
        $entity = $this->entityManager->getRepository($entityClass)->find($routeParams['id']);
        if (!$entity) {
            return;
        }

        try {
            $this->entityManager->remove($entity);
            $this->entityManager->flush();
//            $this->flashBag->add('success', 'Suppression réussie.');
        } catch (\Throwable $e) {
//            $this->flashBag->add('error', 'Erreur lors de la suppression.');
        }

        // Redirection après suppression
        $event->setResponse(new RedirectResponse($this->router->generate('admin_app_collection_users')));
    }
}
