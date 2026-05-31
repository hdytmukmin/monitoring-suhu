<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeviceRequest;
use App\Models\Device;
use App\Models\Room;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::query()
            ->with('room')
            ->withCount('readings')
            ->latest()
            ->paginate(10);

        return view('admin.devices.index', [
            'devices' => $devices,
        ]);
    }

    public function create()
    {
        return view('admin.devices.create', [
            'device' => new Device([
                'sensor_type' => 'DHT22',
                'is_active' => true,
            ]),
            'rooms' => $this->rooms(),
        ]);
    }

    public function edit(Device $device)
    {
        return view('admin.devices.edit', [
            'device' => $device,
            'rooms' => $this->rooms(),
        ]);
    }

    public function store(DeviceRequest $request)
    {
        $token = $this->makeToken();
        $payload = $request->validated();
        $payload['token_hash'] = Device::hashToken($token);

        Device::query()->create($payload);

        return redirect()
            ->route('admin.devices.index')
            ->with('success', 'Device berhasil ditambahkan.')
            ->with('device_token', $token);
    }

    public function update(DeviceRequest $request, Device $device)
    {
        $device->update($request->validated());

        return redirect()
            ->route('admin.devices.index')
            ->with('success', 'Device berhasil diperbarui.');
    }

    public function regenerateToken(Device $device)
    {
        $token = $this->makeToken();

        $device->update([
            'token_hash' => Device::hashToken($token),
        ]);

        return redirect()
            ->route('admin.devices.index')
            ->with('success', 'Token device berhasil dibuat ulang.')
            ->with('device_token', $token);
    }

    public function destroy(Device $device)
    {
        if ($device->readings()->exists()) {
            return redirect()
                ->route('admin.devices.index')
                ->with('error', 'Device tidak dapat dihapus karena sudah memiliki histori suhu.');
        }

        try {
            $device->delete();
        } catch (QueryException) {
            return redirect()
                ->route('admin.devices.index')
                ->with('error', 'Device tidak dapat dihapus karena masih dipakai data lain.');
        }

        return redirect()
            ->route('admin.devices.index')
            ->with('success', 'Device berhasil dihapus.');
    }

    private function rooms()
    {
        return Room::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    private function makeToken(): string
    {
        return 'dev_'.Str::random(48);
    }
}
