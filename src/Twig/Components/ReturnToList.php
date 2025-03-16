<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class ReturnToList
{
    public function __construct(
        public ?string $list_route_name = null,
        public ?string $css = null
    )
    {
    }
}
