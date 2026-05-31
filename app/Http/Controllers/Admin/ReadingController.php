<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TemperatureStatus;
use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Room;
use App\Models\TemperatureReading;
use Illuminate\Http\Request;

class ReadingController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['room_id', 'device_id', 'status', 'date_from', 'date_to']);

        $baseQuery = TemperatureReading::query()
            ->with(['room', 'device'])
            ->when($filters['room_id'] ?? null, fn ($query, $roomId) => $query->where('room_id', $roomId))
            ->when($filters['device_id'] ?? null, fn ($query, $deviceId) => $query->where('device_id', $deviceId))
            ->when($filters['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
            ->when($filters['date_from'] ?? null, fn ($query, $date) => $query->whereDate('recorded_at', '>=', $date))
            ->when($filters['date_to'] ?? null, fn ($query, $date) => $query->whereDate('recorded_at', '<=', $date));

        $stats = [
            'count' => (clone $baseQuery)->count(),
            'min' => (clone $baseQuery)->min('temperature'),
            'max' => (clone $baseQuery)->max('temperature'),
            'avg' => (clone $baseQuery)->avg('temperature'),
        ];

        $readings = (clone $baseQuery)
            ->latest('recorded_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.readings.index', [
            'readings' => $readings,
            'rooms' => Room::query()->orderBy('name')->get(),
            'devices' => Device::query()->orderBy('name')->get(),
            'statuses' => TemperatureStatus::cases(),
            'filters' => $filters,
            'stats' => $stats,
        ]);
    }
}
