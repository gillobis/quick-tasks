<?php

namespace App\Enums;

enum EnumLevel: int
{
    case Reminder = 1;
    case Todo = 2;
    case Important = 3;
    case Urgent = 4;
    case Critic = 5;

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
