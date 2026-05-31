<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'location',
        'warning_temperature',
        'danger_temperature',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'warning_temperature' => 'decimal:2',
            'danger_temperature' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }

    public function readings(): HasMany
    {
        return $this->hasMany(TemperatureReading::class);
    }

    public function notificationSettings(): HasMany
    {
        return $this->hasMany(NotificationSetting::class);
    }
}
