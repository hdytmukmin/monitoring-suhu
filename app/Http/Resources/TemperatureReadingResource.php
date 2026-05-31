<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TemperatureReadingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'room' => [
                'id' => $this->room_id,
                'name' => $this->whenLoaded('room', fn () => $this->room->name),
            ],
            'device' => [
                'id' => $this->device_id,
                'uid' => $this->whenLoaded('device', fn () => $this->device->device_uid),
            ],
            'temperature' => (float) $this->temperature,
            'humidity' => $this->humidity === null ? null : (float) $this->humidity,
            'status' => [
                'value' => $this->status->value,
                'label' => $this->status->label(),
            ],
            'recorded_at' => $this->recorded_at?->toIso8601String(),
        ];
    }
}
