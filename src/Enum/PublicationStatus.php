<?php

namespace App\Enum;

/**
 * Enum PublicationStatus.
 */
enum PublicationStatus: string
{
    case Published = 'published';
    case Archived = 'archived';
    case Review = 'review';

    public static function getChoices(): array
    {
        return [
            'Publié' => self::Published->value,
            'Archivé' => self::Archived->value,
            'En revue' => self::Review->value,
        ];
    }
}