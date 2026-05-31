<div class="mx-auto max-w-3xl rounded-lg border border-zinc-200 bg-white shadow-sm">
    <div class="border-b border-zinc-200 px-5 py-4">
        <h2 class="text-base font-semibold text-zinc-950">{{ $title }}</h2>
        <p class="mt-1 text-sm text-zinc-500">{{ $description }}</p>
    </div>

    <form action="#" method="POST" class="space-y-5 p-5">
        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="channel" class="text-sm font-medium text-zinc-700">Channel</label>
                <select id="channel" name="channel" class="mt-2 h-10 w-full rounded-md border border-zinc-300 bg-white px-3 text-sm shadow-sm">
                    @foreach ($channels as $value => $label)
                        <option value="{{ $value }}" @selected(old('channel', $notificationSetting->channel) === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="room_id" class="text-sm font-medium text-zinc-700">Ruangan</label>
                <select id="room_id" name="room_id" class="mt-2 h-10 w-full rounded-md border border-zinc-300 bg-white px-3 text-sm shadow-sm">
                    <option value="">Global semua ruangan</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" @selected((int) old('room_id', $notificationSetting->room_id) === $room->id)>
                            {{ $room->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label for="recipient" class="text-sm font-medium text-zinc-700">Recipient</label>
            <input
                id="recipient"
                name="recipient"
                type="text"
                value="{{ old('recipient', $notificationSetting->recipient) }}"
                class="mt-2 h-10 w-full rounded-md border border-zinc-300 bg-white px-3 text-sm shadow-sm"
                placeholder="Chat ID Telegram atau nomor WhatsApp"
            >
            <p class="mt-2 text-xs text-zinc-500">Telegram memakai chat ID. WhatsApp memakai nomor tujuan sesuai format provider API.</p>
        </div>

        <div>
            <label for="cooldown_minutes" class="text-sm font-medium text-zinc-700">Cooldown Notifikasi</label>
            <div class="mt-2 flex rounded-md shadow-sm">
                <input
                    id="cooldown_minutes"
                    name="cooldown_minutes"
                    type="number"
                    min="1"
                    max="1440"
                    value="{{ old('cooldown_minutes', $notificationSetting->cooldown_minutes) }}"
                    class="h-10 min-w-0 flex-1 rounded-l-md border border-zinc-300 bg-white px-3 text-sm"
                >
                <span class="inline-flex h-10 items-center rounded-r-md border border-l-0 border-zinc-300 bg-zinc-50 px-3 text-sm text-zinc-500">menit</span>
            </div>
        </div>

        <div class="rounded-md border border-sky-200 bg-sky-50 p-4 text-sm text-sky-800">
            Token bot Telegram, URL provider WhatsApp, dan token WhatsApp tetap disimpan di file environment agar tidak terekspos di halaman admin.
        </div>

        <label class="flex items-center gap-3 rounded-md border border-zinc-200 p-3">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $notificationSetting->is_active)) class="h-4 w-4 rounded border-zinc-300">
            <span>
                <span class="block text-sm font-medium text-zinc-700">Channel aktif</span>
                <span class="block text-xs text-zinc-500">Channel aktif akan menerima alert ketika suhu melewati batas.</span>
            </span>
        </label>

        <div class="flex items-center justify-end gap-3 border-t border-zinc-200 pt-5">
            <a href="{{ route('admin.notifications.index') }}" class="rounded-md border border-zinc-300 px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
                Batal
            </a>
            <button type="button" class="rounded-md bg-zinc-950 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800">
                Simpan
            </button>
        </div>
    </form>
</div>
