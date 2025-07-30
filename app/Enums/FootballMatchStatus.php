<?php

namespace App\Enums;

enum FootballMatchStatus: string
{
    case SCHEDULED = 'scheduled';
    case ONGOING = 'ongoing';
    case HALFTIME = 'halftime';
    case FINISHED = 'finished';

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value', 'name');
    }

    public static function toSelectArray(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value] = ucfirst($case->value); // Or a more user-friendly label
        }
        return $options;
    }
}
