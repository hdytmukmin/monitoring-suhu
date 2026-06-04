<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\TemperatureReading;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('dashboard.index', $this->dashboardPayload($request));
    }

    public function data(Request $request)
    {
        $payload = $this->dashboardPayload($request);

        return response()->json([
            'latest' => $payload['latest'] ? [
                'temperature' => number_format((float) $payload['latest']->temperature, 1),
                'humidity' => $payload['latest']->humidity !== null ? number_format((float) $payload['latest']->humidity, 1).'%' : '-',
                'room' => $payload['latest']->room?->name ?? 'Belum ada data sensor',
                'device' => $payload['latest']->device?->name,
                'recorded_at' => $payload['latest']->recorded_at?->format('d M Y H:i:s') ?? '-',
                'status' => [
                    'value' => $payload['latest']->status->value,
                    'label' => $payload['latest']->status->label(),
                ],
            ] : [
                'temperature' => '--',
                'humidity' => '-',
                'room' => 'Belum ada data sensor',
                'device' => null,
                'recorded_at' => '-',
                'status' => [
                    'value' => 'normal',
                    'label' => 'Normal',
                ],
            ],
            'stats' => [
                'min' => $payload['stats']['min'] !== null ? number_format((float) $payload['stats']['min'], 1).' C' : '-',
                'max' => $payload['stats']['max'] !== null ? number_format((float) $payload['stats']['max'], 1).' C' : '-',
                'avg' => $payload['stats']['avg'] !== null ? number_format((float) $payload['stats']['avg'], 1).' C' : '-',
            ],
            'chart' => [
                'labels' => $payload['chartLabels'],
                'values' => $payload['chartValues'],
            ],
            'recent_readings' => $payload['recentReadings']->map(fn ($reading) => [
                'time' => $reading->recorded_at->format('H:i:s'),
                'room' => $reading->room?->name ?? '-',
                'temperature' => number_format((float) $reading->temperature, 1).' C',
                'status' => $reading->status->value,
            ])->values(),
        ]);
    }

    private function dashboardPayload(Request $request): array
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

        return [
            'rooms' => $rooms,
            'selectedRoomId' => $roomId,
            'selectedDate' => $date,
            'latest' => $latest,
            'stats' => $stats,
            'recentReadings' => $recentReadings,
            'chartLabels' => $dailyReadings->map(fn ($reading) => $reading->recorded_at->format('H:i'))->values(),
            'chartValues' => $dailyReadings->map(fn ($reading) => (float) $reading->temperature)->values(),
        ];
    }
}
