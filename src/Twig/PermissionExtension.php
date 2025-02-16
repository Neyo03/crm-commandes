<?php

namespace App\Twig;

use App\Entity\User;
use App\Security\Enum\PermissionEnum;
use Symfony\Bundle\SecurityBundle\Security;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class PermissionExtension extends AbstractExtension
{
    public function __construct(private Security $security) {}

    public function getFunctions(): array
    {
        return [
            new TwigFunction('has_permission', [$this, 'hasPermission']),
        ];
    }

    public function hasPermission(PermissionEnum $permission): bool
    {
        $user = $this->security->getUser();

        if (!$user instanceof User) {
            return false;
        }

        if ($user->isSuperAdmin()) {
            return true;
        }

        return $user && method_exists($user, 'hasPermission') && $user->hasPermission($permission);
    }
}
