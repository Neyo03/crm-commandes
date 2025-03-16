<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class AddButton
{
    public function __construct(
        public ?string $icon_class = null,
        public ?string $route_name = null,
        public ?string $text = null,
        public ?string $permission = null)
    {
    }
}
