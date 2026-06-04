@php
    $inputClass = 'mt-2 h-11 w-full rounded-xl border border-zinc-300 bg-white px-3 text-sm shadow-sm';
    $labelClass = 'text-sm font-semibold text-zinc-800';
    $errorClass = 'mt-1 text-xs font-medium text-red-600';
@endphp

<div class="mx-auto max-w-4xl overflow-hidden rounded-[22px] border border-sky-100 bg-white shadow-xl shadow-emerald-950/5">
    <div class="border-b border-sky-100 bg-sky-50 px-6 py-5">
        <div class="flex items-start gap-3">
            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-sky-100 text-sky-700">
                @include('dashboard.partials.icon', ['name' => 'sensor', 'class' => 'h-6 w-6'])
            </span>
            <div>
        <h2 class="text-base font-semibold text-zinc-950">{{ $title }}</h2>
        <p class="mt-1 text-sm text-zinc-500">{{ $description }}</p>
            </div>
        </div>
    </div>

    <form action="{{ $action }}" method="POST" class="space-y-6 p-6">
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="name" class="{{ $labelClass }}">Nama Device</label>
                <input id="name" name="name" type="text" value="{{ old('name', $device->name) }}" class="{{ $inputClass }}" placeholder="Arduino Uno DHT22 001">
                @error('name')
                    <p class="{{ $errorClass }}">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="device_uid" class="{{ $labelClass }}">Device UID</label>
                <input id="device_uid" name="device_uid" type="text" value="{{ old('device_uid', $device->device_uid) }}" class="{{ $inputClass }}" placeholder="ARDUINO-UNO-001">
                @error('device_uid')
                    <p class="{{ $errorClass }}">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="room_id" class="{{ $labelClass }}">Ruangan</label>
                <select id="room_id" name="room_id" class="{{ $inputClass }}">
                    <option value="">Pilih ruangan</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" @selected((int) old('room_id', $device->room_id) === $room->id)>
                            {{ $room->name }}
                        </option>
                    @endforeach
                </select>
                @error('room_id')
                    <p class="{{ $errorClass }}">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="sensor_type" class="{{ $labelClass }}">Tipe Sensor</label>
                <select id="sensor_type" name="sensor_type" class="{{ $inputClass }}">
                    @foreach (['DHT11', 'DHT22', 'LM35'] as $sensorType)
                        <option value="{{ $sensorType }}" @selected(old('sensor_type', $device->sensor_type) === $sensorType)>
                            {{ $sensorType }}
                        </option>
                    @endforeach
                </select>
                @error('sensor_type')
                    <p class="{{ $errorClass }}">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex gap-3 rounded-2xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800">
            @include('dashboard.partials.icon', ['name' => 'gauge', 'class' => 'mt-0.5 h-5 w-5 shrink-0'])
            <p>Token device hanya ditampilkan saat dibuat atau di-regenerate. Simpan token baru sebelum halaman ditutup.</p>
        </div>

        <div class="flex flex-col gap-3 rounded-2xl border border-sky-100 bg-sky-50/60 p-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-zinc-700">Device token</p>
                <p class="mt-1 text-xs text-zinc-500">Gunakan token ini sebagai Bearer token pada request Arduino.</p>
            </div>
            @if ($device->exists)
                <button
                    type="submit"
                    form="regenerate-token-form"
                    class="rounded-xl border border-sky-200 bg-white px-4 py-2 text-sm font-medium text-sky-800 hover:bg-sky-50"
                >
                    Regenerate Token
                </button>
            @else
                <span class="rounded-xl bg-white px-4 py-2 text-sm font-medium text-zinc-600">
                    Dibuat otomatis
                </span>
            @endif
        </div>

        <label class="flex items-center gap-3 rounded-2xl border border-emerald-100 bg-emerald-50/50 p-4">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $device->is_active)) class="h-4 w-4 rounded border-zinc-300">
            <span>
                <span class="block text-sm font-medium text-zinc-700">Device aktif</span>
                <span class="block text-xs text-zinc-500">Device aktif boleh mengirim data sensor ke API.</span>
            </span>
        </label>

        <div class="flex items-center justify-end gap-3 border-t border-zinc-200 pt-5">
            <a href="{{ route('admin.devices.index') }}" class="rounded-xl border border-zinc-300 px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
                Batal
            </a>
            <button type="submit" class="rounded-xl bg-emerald-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-800">
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
