<?php

namespace Database\Seeders;

use App\Models\Device;
use App\Models\NotificationSetting;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Monitoring',
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);

        $room = Room::query()->create([
            'name' => 'Ruang Server',
            'code' => 'SERVER-01',
            'location' => 'Gedung Utama',
            'warning_temperature' => 30,
            'danger_temperature' => 35,
        ]);

        Device::query()->create([
            'room_id' => $room->id,
            'device_uid' => 'ARDUINO-UNO-001',
            'name' => 'Arduino Uno DHT22 001',
            'sensor_type' => 'DHT22',
            'token_hash' => Device::hashToken('dev-sensor-token-ubah-ini'),
        ]);

        NotificationSetting::query()->create([
            'room_id' => $room->id,
            'channel' => NotificationSetting::CHANNEL_TELEGRAM,
            'recipient' => 'ISI_CHAT_ID_TELEGRAM',
            'cooldown_minutes' => 15,
            'is_active' => false,
        ]);
    }
}
