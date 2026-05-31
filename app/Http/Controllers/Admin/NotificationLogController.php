<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationLog;
use App\Models\NotificationSetting;
use App\Models\Room;
use Illuminate\Http\Request;

class NotificationLogController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['room_id', 'channel', 'status', 'date_from', 'date_to']);

        $baseQuery = NotificationLog::query()
            ->with(['room', 'reading', 'setting'])
            ->when($filters['room_id'] ?? null, fn ($query, $roomId) => $query->where('room_id', $roomId))
            ->when($filters['channel'] ?? null, fn ($query, $channel) => $query->where('channel', $channel))
            ->when($filters['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
            ->when($filters['date_from'] ?? null, fn ($query, $date) => $query->whereDate('created_at', '>=', $date))
            ->when($filters['date_to'] ?? null, fn ($query, $date) => $query->whereDate('created_at', '<=', $date));

        $stats = [
            'total' => (clone $baseQuery)->count(),
            'pending' => (clone $baseQuery)->where('status', 'pending')->count(),
            'sent' => (clone $baseQuery)->where('status', 'sent')->count(),
            'failed' => (clone $baseQuery)->where('status', 'failed')->count(),
        ];

        $logs = (clone $baseQuery)
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.notification-logs.index', [
            'logs' => $logs,
            'rooms' => Room::query()->orderBy('name')->get(),
            'channels' => [
                NotificationSetting::CHANNEL_TELEGRAM => 'Telegram',
                NotificationSetting::CHANNEL_WHATSAPP => 'WhatsApp',
            ],
            'statuses' => ['pending' => 'Pending', 'sent' => 'Terkirim', 'failed' => 'Gagal'],
            'filters' => $filters,
            'stats' => $stats,
        ]);
    }
}
