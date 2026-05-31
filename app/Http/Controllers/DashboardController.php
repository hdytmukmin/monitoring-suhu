<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\TemperatureReading;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $roomId = $request->integer('room_id') ?: null;
        $date = $request->date('date')?->startOfDay() ?? today();

        $rooms = Room::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $query = TemperatureReading::query()
            ->with(['room', 'device'])
            ->when($roomId, fn ($query) => $query->where('room_id', $roomId));

        $latest = (clone $query)
            ->latest('recorded_at')
            ->first();

        $dailyReadings = (clone $query)
            ->whereBetween('recorded_at', [$date->copy()->startOfDay(), $date->copy()->endOfDay()])
            ->orderBy('recorded_at')
            ->get();

        $stats = [
            'min' => $dailyReadings->min('temperature'),
            'max' => $dailyReadings->max('temperature'),
            'avg' => $dailyReadings->avg('temperature'),
        ];

        $recentReadings = (clone $query)
            ->latest('recorded_at')
            ->limit(20)
            ->get();

        return view('dashboard.index', [
            'rooms' => $rooms,
            'selectedRoomId' => $roomId,
            'selectedDate' => $date,
            'latest' => $latest,
            'stats' => $stats,
            'recentReadings' => $recentReadings,
            'chartLabels' => $dailyReadings->map(fn ($reading) => $reading->recorded_at->format('H:i'))->values(),
            'chartValues' => $dailyReadings->map(fn ($reading) => (float) $reading->temperature)->values(),
        ]);
    }
}
