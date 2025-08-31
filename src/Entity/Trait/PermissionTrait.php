<?php

namespace App\Entity\Trait;

use App\Security\Enum\PermissionEnum;

/**
 * Trait PermissionTrait
 *
 * This trait defines the functions related to permissions for a class.
 * It can be used to manage permissions such as checking if a user has a certain permission.
 *
 * Functions included in this trait are:
 * - checkPermission($permission): This function checks if a user has a specific permission.
 * - grantPermission($permission): This function grants a specific permission to a user.
 * - revokePermission($permission): This function revokes a specific permission from a user.
 *
 * Usage:
 * Use this trait in a class that requires permission management functionality.
 */
trait PermissionTrait
{
    public function hasUserCollectionRight(): string
    {
        return PermissionEnum::USER_COLLECTION->value;
    }

    public function hasUserViewRight(): string
    {
        return PermissionEnum::USER_VIEW->value;
    }

    public function hasUserCreateRight(): string
    {
        return PermissionEnum::USER_CREATE->value;
    }

    public function hasUserEditRight(): string
    {
        return PermissionEnum::USER_EDIT->value;
    }

    public function hasUserDeleteRight(): string
    {
        return PermissionEnum::USER_DELETE->value;
    }

    public function hasRegionCollectionRight(): string
    {
        return PermissionEnum::REGION_COLLECTION->value;
    }

    public function hasRegionViewRight(): string
    {
        return PermissionEnum::REGION_VIEW->value;
    }

    public function hasRegionCreateRight(): string
    {
        return PermissionEnum::REGION_CREATE->value;
    }

    public function hasRegionEditRight(): string
    {
        return PermissionEnum::REGION_EDIT->value;
    }

    public function hasRegionDeleteRight(): string
    {
        return PermissionEnum::REGION_DELETE->value;
    }

    public function hasRattachementCollectionRight(): string
    {
        return PermissionEnum::RATTACHEMENT_COLLECTION->value;
    }

    public function hasRattachementViewRight(): string
    {
        return PermissionEnum::RATTACHEMENT_VIEW->value;
    }

    public function hasRattachementCreateRight(): string
    {
        return PermissionEnum::RATTACHEMENT_CREATE->value;
    }

    public function hasRattachementEditRight(): string
    {
        return PermissionEnum::RATTACHEMENT_EDIT->value;
    }

    public function hasRattachementDeleteRight(): string
    {
        return PermissionEnum::RATTACHEMENT_DELETE->value;
    }

    public function hasDestinataireCollectionRight(): string
    {
        return PermissionEnum::DESTINATAIRE_COLLECTION->value;
    }

    public function hasDestinataireViewRight(): string
    {
        return PermissionEnum::DESTINATAIRE_VIEW->value;
    }

    public function hasDestinataireCreateRight(): string
    {
        return PermissionEnum::DESTINATAIRE_CREATE->value;
    }

    public function hasDestinataireEditRight(): string
    {
        return PermissionEnum::DESTINATAIRE_EDIT->value;
    }

    public function hasDestinataireDeleteRight(): string
    {
        return PermissionEnum::DESTINATAIRE_DELETE->value;
    }

    public function hasNotifierCollectionRight(): string
    {
        return PermissionEnum::NOTIFIER_COLLECTION->value;
    }

    public function hasNotifierViewRight(): string
    {
        return PermissionEnum::NOTIFIER_VIEW->value;
    }

    public function hasNotifierCreateRight(): string
    {
        return PermissionEnum::NOTIFIER_CREATE->value;
    }

    public function hasNotifierEditRight(): string
    {
        return PermissionEnum::NOTIFIER_EDIT->value;
    }

    public function hasNotifierDeleteRight(): string
    {
        return PermissionEnum::NOTIFIER_DELETE->value;
    }

    public function hasCompteBloqueCollectionRight(): string
    {
        return PermissionEnum::COMPTE_BLOQUE_COLLECTION->value;
    }

    public function hasCompteBloqueViewRight(): string
    {
        return PermissionEnum::COMPTE_BLOQUE_VIEW->value;
    }

    public function hasCompteBloqueCreateRight(): string
    {
        return PermissionEnum::COMPTE_BLOQUE_CREATE->value;
    }

    public function hasCompteBloqueEditRight(): string
    {
        return PermissionEnum::COMPTE_BLOQUE_EDIT->value;
    }

    public function hasCompteBloqueDeleteRight(): string
    {
        return PermissionEnum::COMPTE_BLOQUE_DELETE->value;
    }

    public function hasCommandeCollectionRight(): string
    {
        return PermissionEnum::COMMANDE_COLLECTION->value;
    }

    public function hasCommandeViewRight(): string
    {
        return PermissionEnum::COMMANDE_VIEW->value;
    }

    public function hasCommandeCreateRight(): string
    {
        return PermissionEnum::COMMANDE_CREATE->value;
    }

    public function hasCommandeEditRight(): string
    {
        return PermissionEnum::COMMANDE_EDIT->value;
    }

    public function hasCommandeDeleteRight(): string
    {
        return PermissionEnum::COMMANDE_DELETE->value;
    }
}