<?php

namespace App\Config;

use App\Config\Interface\AdminCollectionConfigInterface;

readonly class AdminCollectionConfig implements AdminCollectionConfigInterface
{
    public function __construct(
        private string $entityName,
        private string $addRoute,
        private string $addIcon,
        private string $addText,
        private string $listRoute
    ) {}

    public function getEntityName(): string { return $this->entityName; }
    public function getAddRoute(): string { return $this->addRoute; }
    public function getAddIcon(): string { return $this->addIcon; }
    public function getAddText(): string { return $this->addText; }
    public function getListRoute(): string { return $this->listRoute; }
}
