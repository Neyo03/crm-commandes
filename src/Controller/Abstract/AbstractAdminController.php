<?php

namespace App\Controller\Abstract;

use App\Config\AdminCollectionConfig;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use InvalidArgumentException;
use Symfony\Component\Routing\Attribute\Route;

abstract class AbstractAdminController extends AbstractController
{
    /**
     * @param AdminCollectionConfig $adminCollectionConfig
     * @param string $template
     * @param array $extraParams
     * @return Response
     */
    protected function renderAdminEntity(AdminCollectionConfig $adminCollectionConfig, string $template, array $extraParams = []): Response
    {
        if (!$adminCollectionConfig->getAddRoute() || !$adminCollectionConfig->getListRoute()) {
            throw new InvalidArgumentException('Les routes add_route et list_route sont obligatoires.');
        }

        return $this->render($template, array_merge([
            'entity_name' => $adminCollectionConfig->getEntityName(),
            'add_route' => $adminCollectionConfig->getAddRoute(),
            'add_icon' => $adminCollectionConfig->getAddIcon(),
            'add_text' => $adminCollectionConfig->getAddText(),
            'list_route' => $adminCollectionConfig->getListRoute(),
        ], $extraParams));
    }

    /**
     * Récupérer le nom de la route pour une méthode de contrôleur donnée.
     *
     * @param string $controllerClass Le nom complet de la classe du contrôleur (ex: 'App\\Controller\\BController')
     * @param string $methodName Le nom de la méthode du contrôleur (ex: 'index')
     * @return string|null Le nom de la route si trouvé, sinon null
     * @throws \ReflectionException
     */
    protected function getRouteNameFromControllerMethod(string $controllerClass, string $methodName): ?string
    {
        $reflectionMethod = new \ReflectionMethod($controllerClass, $methodName);
        $attributes = $reflectionMethod->getAttributes(Route::class);

        if (!empty($attributes)) {
            return 'admin_' . $attributes[0]->getArguments()['name'] ?? null;
        }

        return null;
    }

    /**
     * @return string|null
     * @throws \ReflectionException
     */
    protected function getCurrentRouteName(): ?string
    {

        $backtrace = debug_backtrace();
        $caller = $backtrace[1];
        $function ??= $caller['function'];

        if ($function) {
            return self::getRouteNameFromControllerMethod($this::class, $function);
        }

        return null;
    }

}
