<?php

namespace App\Security\Voter;

use App\Entity\User;
use App\Security\Enum\PermissionEnum;
use App\Security\Enum\RoleEnum;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class AdminVoter extends Voter
{

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, array_column(PermissionEnum::cases(), 'value'));
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        if ($user->isSuperAdmin()) {
            return true;
        }

        if (!in_array(RoleEnum::ROLE_ADMIN->value, $user->getRoles())) {
            return false;
        }

        $permissions = $user->getPermissions();
        [$section, $action] = explode(':', $attribute);

        return isset($permissions[$section]) && in_array($action, $permissions[$section]);
    }
}
