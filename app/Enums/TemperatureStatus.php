<?php

namespace App\Enums;

enum TemperatureStatus: string
{
    case Normal = 'normal';
    case Warning = 'warning';
    case Danger = 'danger';

    public function label(): string
    {
        return match ($this) {
            self::Normal => 'Normal',
            self::Warning => 'Waspada',
            self::Danger => 'Bahaya',
        };
    }
}
