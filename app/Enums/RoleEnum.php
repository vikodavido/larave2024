<?php

namespace App;

enum RoleEnum: string
{
    case ADMIN = 'admin';

    case CUSTOMER = 'customer';

    case MODERATOR = 'moderator';

    public static function values(): array
    {
        $values = [];

        foreach (self::cases() as $case) {
            $values[] = $case->value;
        }

        return $values;
    }


}
