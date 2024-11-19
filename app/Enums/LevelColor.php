<?php

namespace App\Enums;

enum LevelColor: string
{
    case Reminder = 'text-gray-800';
    case Todo = 'text-info';
    case Important = 'text-warning';
    case Urgent = 'text-error';
    case Critic = 'text-purple-800';
}
