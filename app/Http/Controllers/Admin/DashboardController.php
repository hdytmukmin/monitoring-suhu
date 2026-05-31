<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\NotificationLog;
use App\Models\Room;
use App\Models\TemperatureReading;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $stats = [
            'rooms' => Room::query()->count(),
            'active_devices' => Device::query()->where('is_active', true)->count(),
            'online_devices' => Device::query()
                ->where('is_active', true)
                ->where('last_seen_at', '>=', now()->subMinutes(5))
                ->count(),
            'readings_today' => TemperatureReading::query()->whereDate('recorded_at', today())->count(),
            'pending_alerts' => NotificationLog::query()->where('status', 'pending')->count(),
            'failed_alerts' => NotificationLog::query()->where('status', 'failed')->count(),
        ];

        $recentDevices = Device::query()
            ->with('room')
            ->latest('last_seen_at')
            ->limit(5)
            ->get();

        $recentAlerts = NotificationLog::query()
            ->with(['room', 'reading'])
            ->latest()
            ->limit(5)
            ->get();

        $latestReadings = TemperatureReading::query()
            ->with(['room', 'device'])
            ->latest('recorded_at')
            ->limit(5)
            ->get();

        return view('admin.dashboard.index', [
            'stats' => $stats,
            'recentDevices' => $recentDevices,
            'recentAlerts' => $recentAlerts,
            'latestReadings' => $latestReadings,
        ]);
    }
}
