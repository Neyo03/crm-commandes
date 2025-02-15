<?php

namespace App\Security\Enum;

enum PermissionEnum: string
{
        // Permissions pour User
    case USER_COLLECTION = 'user_management:COLLECTION';
    case USER_VIEW = 'user_management:VIEW';
    case USER_CREATE = 'user_management:CREATE';
    case USER_EDIT = 'user_management:EDIT';
    case USER_DELETE = 'user_management:DELETE';

        // Permissions pour Region
    case REGION_COLLECTION = 'region_management:COLLECTION';
    case REGION_VIEW = 'region_management:VIEW';
    case REGION_CREATE = 'region_management:CREATE';
    case REGION_EDIT = 'region_management:EDIT';
    case REGION_DELETE = 'region_management:DELETE';

        // Permissions pour Rattachement
    case RATTACHEMENT_COLLECTION = 'rattachement_management:COLLECTION';
    case RATTACHEMENT_VIEW = 'rattachement_management:VIEW';
    case RATTACHEMENT_CREATE = 'rattachement_management:CREATE';
    case RATTACHEMENT_EDIT = 'rattachement_management:EDIT';
    case RATTACHEMENT_DELETE = 'rattachement_management:DELETE';

        // Permissions pour Destinataire
    case DESTINATAIRE_COLLECTION = 'destinataire_management:COLLECTION';
    case DESTINATAIRE_VIEW = 'destinataire_management:VIEW';
    case DESTINATAIRE_CREATE = 'destinataire_management:CREATE';
    case DESTINATAIRE_EDIT = 'destinataire_management:EDIT';
    case DESTINATAIRE_DELETE = 'destinataire_management:DELETE';

        // Permissions pour Notifier
    case NOTIFIER_COLLECTION = 'notifier_management:COLLECTION';
    case NOTIFIER_VIEW = 'notifier_management:VIEW';
    case NOTIFIER_CREATE = 'notifier_management:CREATE';
    case NOTIFIER_EDIT = 'notifier_management:EDIT';
    case NOTIFIER_DELETE = 'notifier_management:DELETE';

        // Permissions pour Compte Bloqué
    case COMPTE_BLOQUE_COLLECTION = 'compte_bloque_management:COLLECTION';
    case COMPTE_BLOQUE_VIEW = 'compte_bloque_management:VIEW';
    case COMPTE_BLOQUE_CREATE = 'compte_bloque_management:CREATE';
    case COMPTE_BLOQUE_EDIT = 'compte_bloque_management:EDIT';
    case COMPTE_BLOQUE_DELETE = 'compte_bloque_management:DELETE';

        // Permissions pour Commande
    case COMMANDE_COLLECTION = 'commande_management:COLLECTION';
    case COMMANDE_VIEW = 'commande_management:VIEW';
    case COMMANDE_CREATE = 'commande_management:CREATE';
    case COMMANDE_EDIT = 'commande_management:EDIT';
    case COMMANDE_DELETE = 'commande_management:DELETE';

    public static function getChoices(): array
    {
        return [
            'Gestion des utilisateurs' => [
                'Lister' => self::USER_COLLECTION->value,
                'Voir' => self::USER_VIEW->value,
                'Créer' => self::USER_CREATE->value,
                'Modifier' => self::USER_EDIT->value,
                'Supprimer' => self::USER_DELETE->value,
            ],
            'Gestion des régions' => [
                'Lister' => self::REGION_COLLECTION->value,
                'Voir' => self::REGION_VIEW->value,
                'Créer' => self::REGION_CREATE->value,
                'Modifier' => self::REGION_EDIT->value,
                'Supprimer' => self::REGION_DELETE->value,
            ],
            'Gestion des rattachements' => [
                'Lister' => self::RATTACHEMENT_COLLECTION->value,
                'Voir' => self::RATTACHEMENT_VIEW->value,
                'Créer' => self::RATTACHEMENT_CREATE->value,
                'Modifier' => self::RATTACHEMENT_EDIT->value,
                'Supprimer' => self::RATTACHEMENT_DELETE->value,
            ],
            'Gestion des destinataires' => [
                'Lister' => self::DESTINATAIRE_COLLECTION->value,
                'Voir' => self::DESTINATAIRE_VIEW->value,
                'Créer' => self::DESTINATAIRE_CREATE->value,
                'Modifier' => self::DESTINATAIRE_EDIT->value,
                'Supprimer' => self::DESTINATAIRE_DELETE->value,
            ],
            'Gestion des notifications' => [
                'Lister' => self::NOTIFIER_COLLECTION->value,
                'Voir' => self::NOTIFIER_VIEW->value,
                'Créer' => self::NOTIFIER_CREATE->value,
                'Modifier' => self::NOTIFIER_EDIT->value,
                'Supprimer' => self::NOTIFIER_DELETE->value,
            ],
            'Gestion des comptes bloqués' => [
                'Lister' => self::COMPTE_BLOQUE_COLLECTION->value,
                'Voir' => self::COMPTE_BLOQUE_VIEW->value,
                'Créer' => self::COMPTE_BLOQUE_CREATE->value,
                'Modifier' => self::COMPTE_BLOQUE_EDIT->value,
                'Supprimer' => self::COMPTE_BLOQUE_DELETE->value,
            ],
            'Gestion des commandes' => [
                'Lister' => self::COMMANDE_COLLECTION->value,
                'Voir' => self::COMMANDE_VIEW->value,
                'Créer' => self::COMMANDE_CREATE->value,
                'Modifier' => self::COMMANDE_EDIT->value,
                'Supprimer' => self::COMMANDE_DELETE->value,
            ],
        ];
    }
}
