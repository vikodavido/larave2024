<?php

namespace App\Enums\Permissions;

enum AccountEnum: string
{
    case EDIT = 'edit_account';
    case DELETE = 'delete_account';

    public static function values(): array
    {
        $values = [];

        foreach (self::cases() as $case) {
            $values[] = $case->value;
        }

        return $values;
    }
}
