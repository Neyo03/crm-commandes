<?php

namespace App\Controller\Abstract;

use App\Config\AdminCollectionConfig;
use App\Controller\Admin\User\CollectionUsersController;
use App\Controller\Admin\User\FormUserController;
use App\Security\Enum\PermissionEnum;
use App\Twig\Components\AddButton;
use App\Twig\Components\ReturnToList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use InvalidArgumentException;
use Symfony\Component\Routing\Attribute\Route;

abstract class AbstractAdminController extends AbstractController
{
    public function __construct(private readonly RequestStack $requestStack)
    {
    }

    /**
     * Renders the user template with the provided parameters.
     *
     * @param string $template The path to the template file to render
     * @param array $parameters An array of additional parameters to pass to the template (default: [])
     * @return Response The rendered user template response
     * @throws \ReflectionException
     */
    protected function renderUserTemplate(string $template, array $parameters = []): Response
    {
        $collectionRoute = self::getRouteNameFromControllerMethod(
            CollectionUsersController::class,
            'collection'
        );

        $isCollectionCurrentRoute = $this->requestStack->getMainRequest()->attributes->get('_route') == $collectionRoute;

        $returnButton = new ReturnToList(
            list_route_name: !$isCollectionCurrentRoute ? $collectionRoute : '',
            css: !$isCollectionCurrentRoute ? 'link-secondary link-underline-opacity-0' : 'btn opacity-0 disabled'
        );

        $addButton = new AddButton(
            icon_class: 'bi bi-person-add',
            route_name: self::getRouteNameFromControllerMethod(
                FormUserController::class,
                'formView'
            ),
            text: 'Ajouter un utilisateur',
            permission: PermissionEnum::USER_CREATE->value
        );

        return $this->render($template, array_merge($parameters, [
            'returnButton' => $returnButton,
            'addButton' => $addButton,
            'title' => 'Utilisateur'
        ]));
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
