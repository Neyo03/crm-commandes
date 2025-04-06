<?php

namespace App\Twig\Components\Link;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;

#[AsTwigComponent(template: 'components/_nav_link.html.twig')]
final class NavLink
{


    private ?string $class;

    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
        private ?string               $href = null,
        ?string                       $class = null,
        public ?string                $route_name = null,
        public ?string                $icon_class = null,
        public ?string                $text = null,
        public ?string                $classOverride = null,
        public bool                   $isActiveLink = false,
    )
    {
        $this->class = $class;
    }

    #[PostMount]
    public function postMount(): void
    {
        $this->href = $this->route_name ? $this->urlGenerator->generate($this->route_name) : null;
    }

    public function getHref(): ?string
    {
        return $this->href;
    }
}
