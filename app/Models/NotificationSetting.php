<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NotificationSetting extends Model
{
    use HasFactory;

    public const CHANNEL_TELEGRAM = 'telegram';
    public const CHANNEL_WHATSAPP = 'whatsapp';

    protected $fillable = [
        'room_id',
        'channel',
        'recipient',
        'is_active',
        'cooldown_minutes',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'cooldown_minutes' => 'integer',
        ];
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(NotificationLog::class);
    }
}
