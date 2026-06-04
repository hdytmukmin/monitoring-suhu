<?php

namespace Database\Seeders;

use App\Enums\TemperatureStatus;
use App\Models\Device;
use App\Models\Room;
use App\Models\TemperatureReading;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TemperatureReadingSeeder extends Seeder
{
    /**
     * Seed sample sensor readings for dashboard and report preview.
     */
    public function run(): void
    {
        $room = Room::query()->where('is_active', true)->first()
            ?? Room::query()->create([
                'name' => 'Ruang Server',
                'code' => 'SERVER-01',
                'location' => 'Gedung Utama',
                'warning_temperature' => 30,
                'danger_temperature' => 35,
                'is_active' => true,
            ]);

        $device = Device::query()
            ->where('room_id', $room->id)
            ->where('is_active', true)
            ->first()
            ?? Device::query()->create([
                'room_id' => $room->id,
                'device_uid' => 'ARDUINO-UNO-001',
                'name' => 'Arduino Uno DHT22 001',
                'sensor_type' => 'DHT22',
                'token_hash' => Device::hashToken('dev-sensor-token-ubah-ini'),
                'is_active' => true,
            ]);

        $now = now();
        $readings = [];

        for ($dayOffset = 6; $dayOffset >= 0; $dayOffset--) {
            $date = $now->copy()->subDays($dayOffset)->startOfDay();

            $hasReadingsForDate = TemperatureReading::query()
                ->where('room_id', $room->id)
                ->where('device_id', $device->id)
                ->whereBetween('recorded_at', [$date->copy()->startOfDay(), $date->copy()->endOfDay()])
                ->exists();

            if ($hasReadingsForDate) {
                continue;
            }

            foreach ([7, 9, 11, 13, 15, 17, 19, 21] as $hour) {
                $recordedAt = $date->copy()->setTime($hour, random_int(0, 45));
                $temperature = $this->temperatureFor($hour, $dayOffset);

                $readings[] = [
                    'room_id' => $room->id,
                    'device_id' => $device->id,
                    'temperature' => $temperature,
                    'humidity' => $this->humidityFor($temperature),
                    'status' => $this->statusFor($room, $temperature)->value,
                    'recorded_at' => $recordedAt,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        if ($readings === []) {
            return;
        }

        TemperatureReading::query()->insert($readings);

        $device->forceFill([
            'last_seen_at' => collect($readings)->max('recorded_at'),
        ])->save();
    }

    private function temperatureFor(int $hour, int $dayOffset): float
    {
        $baseTemperature = match (true) {
            $hour < 10 => 26.2,
            $hour < 14 => 28.4,
            $hour < 18 => 31.1,
            default => 29.3,
        };

        if ($dayOffset === 0 && $hour >= 15 && $hour <= 17) {
            $baseTemperature += 4.1;
        }

        return round($baseTemperature + random_int(-8, 10) / 10, 2);
    }

    private function humidityFor(float $temperature): float
    {
        return round(max(48, min(78, 84 - $temperature + random_int(-4, 4))), 2);
    }

    private function statusFor(Room $room, float $temperature): TemperatureStatus
    {
        if ($temperature >= (float) $room->danger_temperature) {
            return TemperatureStatus::Danger;
        }

        if ($temperature >= (float) $room->warning_temperature) {
            return TemperatureStatus::Warning;
        }

        return TemperatureStatus::Normal;
    }
}
