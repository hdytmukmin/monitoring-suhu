<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationSetting;
use App\Models\Room;

class NotificationSettingController extends Controller
{
    public function index()
    {
        $settings = NotificationSetting::query()
            ->with('room')
            ->withCount('logs')
            ->latest()
            ->paginate(10);

        return view('admin.notifications.index', [
            'settings' => $settings,
        ]);
    }

    public function create()
    {
        return view('admin.notifications.create', [
            'notificationSetting' => new NotificationSetting([
                'channel' => NotificationSetting::CHANNEL_TELEGRAM,
                'cooldown_minutes' => 15,
                'is_active' => true,
            ]),
            'rooms' => $this->rooms(),
            'channels' => $this->channels(),
        ]);
    }

    public function edit(NotificationSetting $notificationSetting)
    {
        return view('admin.notifications.edit', [
            'notificationSetting' => $notificationSetting,
            'rooms' => $this->rooms(),
            'channels' => $this->channels(),
        ]);
    }

    private function rooms()
    {
        return Room::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    private function channels(): array
    {
        return [
            NotificationSetting::CHANNEL_TELEGRAM => 'Telegram',
            NotificationSetting::CHANNEL_WHATSAPP => 'WhatsApp',
        ];
    }
}
