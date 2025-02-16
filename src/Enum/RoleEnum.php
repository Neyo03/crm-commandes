<?php

namespace App\Security\Enum;

enum RoleEnum: string
{
    case ROLE_ADMIN = 'ROLE_ADMIN';
    case ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';
    case ROLE_CORRESPONDANT = 'ROLE_CORRESPONDANT';
    case ROLE_SIGNATAIRE = 'ROLE_SIGNATAIRE';
    case ROLE_PRS = 'ROLE_PRS';

    public static function getChoices(): array
    {
        return [
            'Super Admin' => self::ROLE_SUPER_ADMIN->value,
            'Admin' => self::ROLE_ADMIN->value,
            'Correspondant' => self::ROLE_CORRESPONDANT->value,
            'Signataire' => self::ROLE_SIGNATAIRE->value,
            'PRS' => self::ROLE_PRS->value,
        ];
    }
}
