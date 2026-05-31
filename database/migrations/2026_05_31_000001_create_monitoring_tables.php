<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false)->after('password');
        });

        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('location')->nullable();
            $table->decimal('warning_temperature', 5, 2)->default(30);
            $table->decimal('danger_temperature', 5, 2)->default(35);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('device_uid')->unique();
            $table->string('name');
            $table->string('sensor_type')->default('DHT22');
            $table->string('token_hash');
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_seen_at')->nullable();
            $table->timestamps();
        });

        Schema::create('temperature_readings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('device_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->decimal('temperature', 5, 2);
            $table->decimal('humidity', 5, 2)->nullable();
            $table->string('status', 20);
            $table->timestamp('recorded_at');
            $table->timestamps();

            $table->index(['room_id', 'recorded_at']);
            $table->index(['device_id', 'recorded_at']);
            $table->index(['status', 'recorded_at']);
        });

        Schema::create('notification_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('channel', 20);
            $table->string('recipient');
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('cooldown_minutes')->default(15);
            $table->timestamps();

            $table->index(['room_id', 'channel', 'is_active']);
        });

        Schema::create('notification_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('temperature_reading_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('notification_setting_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->string('channel', 20);
            $table->string('recipient');
            $table->string('status', 20)->default('pending');
            $table->text('message');
            $table->text('error_message')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();

            $table->index(['room_id', 'channel', 'status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_logs');
        Schema::dropIfExists('notification_settings');
        Schema::dropIfExists('temperature_readings');
        Schema::dropIfExists('devices');
        Schema::dropIfExists('rooms');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');
        });
    }
};
