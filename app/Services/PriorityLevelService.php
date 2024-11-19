<?php

namespace App\Services;

class PriorityLevelService
{
    private static $levels = [
        1 => [
            'text' => 'Reminder',
            'color' => 'gray-800',
        ],
        2 => [
            'text' => 'To do',
            'color' => 'info',
        ],
        3 => [
            'text' => 'Important',
            'color' => 'warning',
        ],
        4 => [
            'text' => 'Urgent',
            'color' => 'error',
        ],
        5 => [
            'text' => 'Critic',
            'color' => 'purple-800',
        ],
    ];

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function getText($level)
    {
        if (! $level) {
            return '';
        }

        return self::$levels[$level]['text'];
    }

    public static function getColor($level)
    {
        if (! $level) {
            return '';
        }

        return self::$levels[$level]['color'];
    }
}
