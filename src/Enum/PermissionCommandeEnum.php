<?php

namespace App\Security\Enum;

enum PermissionCommandeEnum: string
{
        // Permissions pour Commande
    case COMMANDE_COLLECTION = 'commande_management:COLLECTION';
    case COMMANDE_VIEW = 'commande_management:VIEW';
    case COMMANDE_CREATE = 'commande_management:CREATE';
    case COMMANDE_EDIT = 'commande_management:EDIT';
    case COMMANDE_DELETE = 'commande_management:DELETE';

        // Permissions pour les étapes de création
    case COMMANDE_CREATE_GENERAL = 'commande_management:CREATE_GENERAL';
    case COMMANDE_CREATE_FOURNISSEUR = 'commande_management:CREATE_FOURNISSEUR';
    case COMMANDE_CREATE_DESTINATAIRE = 'commande_management:CREATE_DESTINATAIRE';
    case COMMANDE_CREATE_NOTES = 'commande_management:CREATE_NOTES';
    case COMMANDE_CREATE_SIGNATURE = 'commande_management:CREATE_SIGNATURE';
    case COMMANDE_CREATE_VALIDATION = 'commande_management:CREATE_VALIDATION';

    public static function getChoices(): array
    {
        return [
            'Gestion des commandes' => [
                'Lister' => self::COMMANDE_COLLECTION->value,
                'Voir' => self::COMMANDE_VIEW->value,
                'Créer' => self::COMMANDE_CREATE->value,
                'Modifier' => self::COMMANDE_EDIT->value,
                'Supprimer' => self::COMMANDE_DELETE->value,
            ],
            'Création de commande' => [
                'Générale' => self::COMMANDE_CREATE_GENERAL->value,
                'Fournisseur' => self::COMMANDE_CREATE_FOURNISSEUR->value,
                'Destinataire' => self::COMMANDE_CREATE_DESTINATAIRE->value,
                'Notes' => self::COMMANDE_CREATE_NOTES->value,
                'Signature' => self::COMMANDE_CREATE_SIGNATURE->value,
                'Validation' => self::COMMANDE_CREATE_VALIDATION->value,
            ],
        ];
    }
}
