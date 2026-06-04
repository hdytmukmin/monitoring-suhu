@php
    $inputClass = 'mt-2 h-11 w-full rounded-xl border border-zinc-300 bg-white px-3 text-sm shadow-sm';
    $labelClass = 'text-sm font-semibold text-zinc-800';
    $errorClass = 'mt-1 text-xs font-medium text-red-600';
@endphp

<div class="mx-auto max-w-4xl overflow-hidden rounded-[22px] border border-emerald-100 bg-white shadow-xl shadow-emerald-950/5">
    <div class="border-b border-emerald-100 bg-emerald-50 px-6 py-5">
        <div class="flex items-start gap-3">
            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">
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
                <label for="name" class="{{ $labelClass }}">Nama Ruangan</label>
                <input id="name" name="name" type="text" value="{{ old('name', $room->name) }}" class="{{ $inputClass }}" placeholder="Ruang Server">
                @error('name')
                    <p class="{{ $errorClass }}">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="code" class="{{ $labelClass }}">Kode Ruangan</label>
                <input id="code" name="code" type="text" value="{{ old('code', $room->code) }}" class="{{ $inputClass }}" placeholder="SERVER-01">
                @error('code')
                    <p class="{{ $errorClass }}">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="location" class="{{ $labelClass }}">Lokasi</label>
            <input id="location" name="location" type="text" value="{{ old('location', $room->location) }}" class="{{ $inputClass }}" placeholder="Gedung Utama">
            @error('location')
                <p class="{{ $errorClass }}">{{ $message }}</p>
            @enderror
        </div>

        <div class="rounded-2xl border border-orange-100 bg-orange-50/60 p-4">
            <div class="mb-4 flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-orange-100 text-orange-700">
                    @include('dashboard.partials.icon', ['name' => 'thermometer', 'class' => 'h-5 w-5'])
                </span>
                <div>
                    <p class="text-sm font-semibold text-orange-900">Ambang batas suhu</p>
                    <p class="text-xs text-orange-700">Nilai ini menentukan status Waspada dan Bahaya pada dashboard.</p>
                </div>
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="warning_temperature" class="{{ $labelClass }}">Batas Waspada</label>
                    <div class="mt-2 flex rounded-xl shadow-sm">
                        <input id="warning_temperature" name="warning_temperature" type="number" step="0.1" value="{{ old('warning_temperature', $room->warning_temperature) }}" class="h-11 min-w-0 flex-1 rounded-l-xl border border-zinc-300 bg-white px-3 text-sm">
                        <span class="inline-flex h-11 items-center rounded-r-xl border border-l-0 border-zinc-300 bg-white px-3 text-sm font-semibold text-orange-700">C</span>
                    </div>
                    @error('warning_temperature')
                        <p class="{{ $errorClass }}">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="danger_temperature" class="{{ $labelClass }}">Batas Bahaya</label>
                    <div class="mt-2 flex rounded-xl shadow-sm">
                        <input id="danger_temperature" name="danger_temperature" type="number" step="0.1" value="{{ old('danger_temperature', $room->danger_temperature) }}" class="h-11 min-w-0 flex-1 rounded-l-xl border border-zinc-300 bg-white px-3 text-sm">
                        <span class="inline-flex h-11 items-center rounded-r-xl border border-l-0 border-zinc-300 bg-white px-3 text-sm font-semibold text-red-700">C</span>
                    </div>
                    @error('danger_temperature')
                        <p class="{{ $errorClass }}">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <label class="flex items-center gap-3 rounded-2xl border border-emerald-100 bg-emerald-50/50 p-4">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $room->is_active)) class="h-4 w-4 rounded border-zinc-300">
            <span>
                <span class="block text-sm font-medium text-zinc-700">Ruangan aktif</span>
                <span class="block text-xs text-zinc-500">Ruangan aktif dapat menerima data sensor dan notifikasi.</span>
            </span>
        </label>

        <div class="flex items-center justify-end gap-3 border-t border-zinc-200 pt-5">
            <a href="{{ route('admin.rooms.index') }}" class="rounded-xl border border-zinc-300 px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
                Batal
            </a>
            <button type="submit" class="rounded-xl bg-emerald-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-800">
                Simpan
            </button>
        </div>
    </form>
</div>
