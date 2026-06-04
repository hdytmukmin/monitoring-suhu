@php
    $inputClass = 'mt-2 h-11 w-full rounded-xl border border-zinc-300 bg-white px-3 text-sm shadow-sm';
    $labelClass = 'text-sm font-semibold text-zinc-800';
    $errorClass = 'mt-1 text-xs font-medium text-red-600';
@endphp

<div class="mx-auto max-w-4xl overflow-hidden rounded-[22px] border border-amber-100 bg-white shadow-xl shadow-emerald-950/5">
    <div class="border-b border-amber-100 bg-amber-50 px-6 py-5">
        <div class="flex items-start gap-3">
            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-amber-100 text-amber-700">
                @include('dashboard.partials.icon', ['name' => 'gauge', 'class' => 'h-6 w-6'])
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
                <label for="channel" class="{{ $labelClass }}">Channel</label>
                <select id="channel" name="channel" class="{{ $inputClass }}">
                    @foreach ($channels as $value => $label)
                        <option value="{{ $value }}" @selected(old('channel', $notificationSetting->channel) === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('channel')
                    <p class="{{ $errorClass }}">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="room_id" class="{{ $labelClass }}">Ruangan</label>
                <select id="room_id" name="room_id" class="{{ $inputClass }}">
                    <option value="">Global semua ruangan</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" @selected((int) old('room_id', $notificationSetting->room_id) === $room->id)>
                            {{ $room->name }}
                        </option>
                    @endforeach
                </select>
                @error('room_id')
                    <p class="{{ $errorClass }}">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="recipient" class="{{ $labelClass }}">Recipient</label>
            <input
                id="recipient"
                name="recipient"
                type="text"
                value="{{ old('recipient', $notificationSetting->recipient) }}"
                class="{{ $inputClass }}"
                placeholder="Chat ID Telegram atau nomor WhatsApp"
            >
            <p class="mt-2 text-xs text-zinc-500">Telegram memakai chat ID. WhatsApp memakai nomor tujuan sesuai format provider API.</p>
            @error('recipient')
                <p class="{{ $errorClass }}">{{ $message }}</p>
            @enderror
        </div>

        <div class="rounded-2xl border border-amber-100 bg-amber-50/60 p-4">
            <label for="cooldown_minutes" class="{{ $labelClass }}">Cooldown Notifikasi</label>
            <p class="mt-1 text-xs text-amber-700">Sistem menunggu durasi ini sebelum mengirim ulang alert untuk ruangan yang sama.</p>
            <div class="mt-2 flex rounded-xl shadow-sm">
                <input
                    id="cooldown_minutes"
                    name="cooldown_minutes"
                    type="number"
                    min="1"
                    max="1440"
                    value="{{ old('cooldown_minutes', $notificationSetting->cooldown_minutes) }}"
                    class="h-11 min-w-0 flex-1 rounded-l-xl border border-zinc-300 bg-white px-3 text-sm"
                >
                <span class="inline-flex h-11 items-center rounded-r-xl border border-l-0 border-zinc-300 bg-white px-3 text-sm font-semibold text-amber-700">menit</span>
            </div>
            @error('cooldown_minutes')
                <p class="{{ $errorClass }}">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-3 rounded-2xl border border-sky-200 bg-sky-50 p-4 text-sm text-sky-800">
            @include('dashboard.partials.icon', ['name' => 'sensor', 'class' => 'mt-0.5 h-5 w-5 shrink-0'])
            <p>Token bot Telegram, URL provider WhatsApp, dan token WhatsApp tetap disimpan di file environment agar tidak terekspos di halaman admin.</p>
        </div>

        <label class="flex items-center gap-3 rounded-2xl border border-emerald-100 bg-emerald-50/50 p-4">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $notificationSetting->is_active)) class="h-4 w-4 rounded border-zinc-300">
            <span>
                <span class="block text-sm font-medium text-zinc-700">Channel aktif</span>
                <span class="block text-xs text-zinc-500">Channel aktif akan menerima alert ketika suhu melewati batas.</span>
            </span>
        </label>

        <div class="flex items-center justify-end gap-3 border-t border-zinc-200 pt-5">
            <a href="{{ route('admin.notifications.index') }}" class="rounded-xl border border-zinc-300 px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
                Batal
            </a>
            <button type="submit" class="rounded-xl bg-emerald-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-800">
                Simpan
            </button>
        </div>
    </form>
</div>
