<?php

namespace App\Config\Interface;

interface AdminCollectionConfigInterface
{
    public function getEntityName(): string;
    public function getAddRoute(): string;
    public function getAddIcon(): string;
    public function getAddText(): string;
    public function getListRoute(): string;
}
