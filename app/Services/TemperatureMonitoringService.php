<?php

namespace App\Services;

use App\Enums\TemperatureStatus;
use App\Jobs\SendTemperatureAlert;
use App\Models\Device;
use App\Models\NotificationLog;
use App\Models\NotificationSetting;
use App\Models\Room;
use App\Models\TemperatureReading;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TemperatureMonitoringService
{
    public function storeReading(array $payload, string $token): TemperatureReading
    {
        return DB::transaction(function () use ($payload, $token) {
            $device = Device::query()
                ->with('room')
                ->where('device_uid', $payload['device_id'])
                ->where('is_active', true)
                ->lockForUpdate()
                ->first();

            if (! $device || ! $device->tokenMatches($token)) {
                throw ValidationException::withMessages([
                    'device_id' => 'Device tidak terdaftar atau token tidak valid.',
                ]);
            }

            if ((int) $payload['room_id'] !== (int) $device->room_id) {
                throw ValidationException::withMessages([
                    'room_id' => 'Device tidak terdaftar untuk ruangan ini.',
                ]);
            }

            $recordedAt = isset($payload['timestamp'])
                ? Carbon::parse($payload['timestamp'])
                : now();

            if ($recordedAt->isFuture() || $recordedAt->lt(now()->subDays(7))) {
                throw ValidationException::withMessages([
                    'timestamp' => 'Timestamp sensor di luar rentang yang diizinkan.',
                ]);
            }

            $status = $this->resolveStatus($device->room, (float) $payload['temperature']);

            $reading = TemperatureReading::query()->create([
                'room_id' => $device->room_id,
                'device_id' => $device->id,
                'temperature' => $payload['temperature'],
                'humidity' => $payload['humidity'] ?? null,
                'status' => $status,
                'recorded_at' => $recordedAt,
            ]);

            $device->forceFill(['last_seen_at' => now()])->save();

            if ($status !== TemperatureStatus::Normal) {
                $this->queueNotifications($reading->load('room'), $status);
            }

            return $reading->load(['room', 'device']);
        });
    }

    public function resolveStatus(Room $room, float $temperature): TemperatureStatus
    {
        if ($temperature >= (float) $room->danger_temperature) {
            return TemperatureStatus::Danger;
        }

        if ($temperature >= (float) $room->warning_temperature) {
            return TemperatureStatus::Warning;
        }

        return TemperatureStatus::Normal;
    }

    private function queueNotifications(TemperatureReading $reading, TemperatureStatus $status): void
    {
        $settings = NotificationSetting::query()
            ->where('is_active', true)
            ->where(function ($query) use ($reading) {
                $query->whereNull('room_id')
                    ->orWhere('room_id', $reading->room_id);
            })
            ->get();

        foreach ($settings as $setting) {
            if ($this->isCoolingDown($reading, $setting)) {
                continue;
            }

            $message = sprintf(
                "Peringatan suhu %s\nRuangan: %s\nSuhu: %.2f C\nAmbang waspada: %.2f C\nAmbang bahaya: %.2f C\nWaktu: %s",
                $status->label(),
                $reading->room->name,
                (float) $reading->temperature,
                (float) $reading->room->warning_temperature,
                (float) $reading->room->danger_temperature,
                $reading->recorded_at->format('Y-m-d H:i:s')
            );

            $log = NotificationLog::query()->create([
                'room_id' => $reading->room_id,
                'temperature_reading_id' => $reading->id,
                'notification_setting_id' => $setting->id,
                'channel' => $setting->channel,
                'recipient' => $setting->recipient,
                'status' => 'pending',
                'message' => $message,
            ]);

            SendTemperatureAlert::dispatch($log);
        }
    }

    private function isCoolingDown(TemperatureReading $reading, NotificationSetting $setting): bool
    {
        return NotificationLog::query()
            ->where('room_id', $reading->room_id)
            ->where('channel', $setting->channel)
            ->where('recipient', $setting->recipient)
            ->whereIn('status', ['pending', 'sent'])
            ->where('created_at', '>=', now()->subMinutes($setting->cooldown_minutes))
            ->exists();
    }
}
