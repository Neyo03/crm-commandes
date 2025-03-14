<?php

namespace App\Twig\Component;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('admin_add_button', template: 'components/admin/admin_add_button.html.twig' )]
class AdminAddButtonComponent
{
    public string $entity;
    public string $href;
    public string $icon;
    public string $text;

    public static function create(string $entity, string $href, string $icon, string $text): self
    {
        $instance = new self();
        $instance->entity = $entity;
        $instance->href = $href;
        $instance->icon = $icon;
        $instance->text = $text;
        return $instance;
    }
}

