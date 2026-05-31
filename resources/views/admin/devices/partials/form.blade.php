<div class="mx-auto max-w-3xl rounded-lg border border-zinc-200 bg-white shadow-sm">
    <div class="border-b border-zinc-200 px-5 py-4">
        <h2 class="text-base font-semibold text-zinc-950">{{ $title }}</h2>
        <p class="mt-1 text-sm text-zinc-500">{{ $description }}</p>
    </div>

    <form action="{{ $action }}" method="POST" class="space-y-5 p-5">
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="name" class="text-sm font-medium text-zinc-700">Nama Device</label>
                <input id="name" name="name" type="text" value="{{ old('name', $device->name) }}" class="mt-2 h-10 w-full rounded-md border border-zinc-300 bg-white px-3 text-sm shadow-sm" placeholder="Arduino Uno DHT22 001">
                @error('name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="device_uid" class="text-sm font-medium text-zinc-700">Device UID</label>
                <input id="device_uid" name="device_uid" type="text" value="{{ old('device_uid', $device->device_uid) }}" class="mt-2 h-10 w-full rounded-md border border-zinc-300 bg-white px-3 text-sm shadow-sm" placeholder="ARDUINO-UNO-001">
                @error('device_uid')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="room_id" class="text-sm font-medium text-zinc-700">Ruangan</label>
                <select id="room_id" name="room_id" class="mt-2 h-10 w-full rounded-md border border-zinc-300 bg-white px-3 text-sm shadow-sm">
                    <option value="">Pilih ruangan</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" @selected((int) old('room_id', $device->room_id) === $room->id)>
                            {{ $room->name }}
                        </option>
                    @endforeach
                </select>
                @error('room_id')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="sensor_type" class="text-sm font-medium text-zinc-700">Tipe Sensor</label>
                <select id="sensor_type" name="sensor_type" class="mt-2 h-10 w-full rounded-md border border-zinc-300 bg-white px-3 text-sm shadow-sm">
                    @foreach (['DHT11', 'DHT22', 'LM35'] as $sensorType)
                        <option value="{{ $sensorType }}" @selected(old('sensor_type', $device->sensor_type) === $sensorType)>
                            {{ $sensorType }}
                        </option>
                    @endforeach
                </select>
                @error('sensor_type')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="rounded-md border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800">
            Token device hanya boleh ditampilkan saat dibuat atau di-regenerate. UI tombolnya disiapkan di sini, tetapi logika token akan kita aktifkan saat tahap CRUD.
        </div>

        <div class="flex flex-col gap-3 rounded-md border border-zinc-200 p-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-zinc-700">Device token</p>
                <p class="mt-1 text-xs text-zinc-500">Gunakan token ini sebagai Bearer token pada request Arduino.</p>
            </div>
            @if ($device->exists)
                <button
                    type="submit"
                    form="regenerate-token-form"
                    class="rounded-md border border-zinc-300 px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50"
                >
                    Regenerate Token
                </button>
            @else
                <span class="rounded-md bg-zinc-100 px-4 py-2 text-sm font-medium text-zinc-600">
                    Dibuat otomatis
                </span>
            @endif
        </div>

        <label class="flex items-center gap-3 rounded-md border border-zinc-200 p-3">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $device->is_active)) class="h-4 w-4 rounded border-zinc-300">
            <span>
                <span class="block text-sm font-medium text-zinc-700">Device aktif</span>
                <span class="block text-xs text-zinc-500">Device aktif boleh mengirim data sensor ke API.</span>
            </span>
        </label>

        <div class="flex items-center justify-end gap-3 border-t border-zinc-200 pt-5">
            <a href="{{ route('admin.devices.index') }}" class="rounded-md border border-zinc-300 px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
                Batal
            </a>
            <button type="submit" class="rounded-md bg-zinc-950 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800">
                Simpan
            </button>
        </div>
    </form>

    @if ($device->exists)
        <form id="regenerate-token-form" action="{{ route('admin.devices.token', $device) }}" method="POST">
            @csrf
            @method('PATCH')
        </form>
    @endif
</div>
