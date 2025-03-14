<?php

namespace App\Twig\Component;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('admin_back_button')]
class AdminBackButtonComponent
{
    public ?string $listRoute = null;

    public static function create(?string $listRoute): self
    {
        $instance = new self();
        $instance->listRoute = $listRoute;
        return $instance;
    }
}

