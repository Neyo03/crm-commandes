<?php

namespace App\Twig\Components;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;

#[AsTwigComponent]
final class ReturnToList
{
    public function __construct(
        private RequestStack $requestStack,
        public ?string $list_route_name = null,
        public ?string $class = null
    )
    {
    }

    #[PostMount]
    public function postMount(): void
    {
        $currentRoute = $this->requestStack->getCurrentRequest()->attributes->get("_route");
        $this->list_route_name = $this->list_route_name !== $currentRoute ?? null;
        $this->class = !$this->list_route_name ? 'btn disabled opacity-0' : "link-secondary link-underline-opacity-0";
        
    }
}
