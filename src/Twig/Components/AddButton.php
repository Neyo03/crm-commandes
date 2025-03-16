<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class AddButton
{
    public string $text;
    public string $icon_class;
    public string $route_name;
}
