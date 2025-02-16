<?php

namespace App\Twig;

use App\Security\Enum\PermissionEnum;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use ReflectionClass;

class PermissionEnumExtention extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('permission_enum', [$this, 'getPermissionEnum']),
        ];
    }

    public function getPermissionEnum(string $const): PermissionEnum
    {
        return (new ReflectionClass(PermissionEnum::class))->getConstants()[$const];
    }
}
