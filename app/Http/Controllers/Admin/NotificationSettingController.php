<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NotificationSettingRequest;
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

    public function store(NotificationSettingRequest $request)
    {
        NotificationSetting::query()->create($request->validated());

        return redirect()
            ->route('admin.notifications.index')
            ->with('success', 'Pengaturan notifikasi berhasil ditambahkan.');
    }

    public function update(NotificationSettingRequest $request, NotificationSetting $notificationSetting)
    {
        $notificationSetting->update($request->validated());

        return redirect()
            ->route('admin.notifications.index')
            ->with('success', 'Pengaturan notifikasi berhasil diperbarui.');
    }

    public function destroy(NotificationSetting $notificationSetting)
    {
        if ($notificationSetting->logs()->exists()) {
            $notificationSetting->update(['is_active' => false]);

            return redirect()
                ->route('admin.notifications.index')
                ->with('success', 'Pengaturan notifikasi sudah memiliki log, jadi dinonaktifkan tanpa menghapus histori.');
        }

        $notificationSetting->delete();

        return redirect()
            ->route('admin.notifications.index')
            ->with('success', 'Pengaturan notifikasi berhasil dihapus.');
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
