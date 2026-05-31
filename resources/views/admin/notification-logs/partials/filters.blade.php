<form method="GET" class="grid gap-4 p-5 lg:grid-cols-5">
    <div>
        <label for="room_id" class="text-sm font-medium text-zinc-700">Ruangan</label>
        <select id="room_id" name="room_id" class="mt-2 h-10 w-full rounded-md border border-zinc-300 bg-white px-3 text-sm shadow-sm">
            <option value="">Semua ruangan</option>
            @foreach ($rooms as $room)
                <option value="{{ $room->id }}" @selected((string) ($filters['room_id'] ?? '') === (string) $room->id)>
                    {{ $room->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="channel" class="text-sm font-medium text-zinc-700">Channel</label>
        <select id="channel" name="channel" class="mt-2 h-10 w-full rounded-md border border-zinc-300 bg-white px-3 text-sm shadow-sm">
            <option value="">Semua channel</option>
            @foreach ($channels as $value => $label)
                <option value="{{ $value }}" @selected(($filters['channel'] ?? '') === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="status" class="text-sm font-medium text-zinc-700">Status</label>
        <select id="status" name="status" class="mt-2 h-10 w-full rounded-md border border-zinc-300 bg-white px-3 text-sm shadow-sm">
            <option value="">Semua status</option>
            @foreach ($statuses as $value => $label)
                <option value="{{ $value }}" @selected(($filters['status'] ?? '') === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="date_from" class="text-sm font-medium text-zinc-700">Dari Tanggal</label>
        <input id="date_from" name="date_from" type="date" value="{{ $filters['date_from'] ?? '' }}" class="mt-2 h-10 w-full rounded-md border border-zinc-300 bg-white px-3 text-sm shadow-sm">
    </div>

    <div>
        <label for="date_to" class="text-sm font-medium text-zinc-700">Sampai Tanggal</label>
        <input id="date_to" name="date_to" type="date" value="{{ $filters['date_to'] ?? '' }}" class="mt-2 h-10 w-full rounded-md border border-zinc-300 bg-white px-3 text-sm shadow-sm">
    </div>

    <div class="flex items-end gap-3 lg:col-span-5">
        <button class="rounded-md bg-zinc-950 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800">
            Terapkan Filter
        </button>
        <a href="{{ route('admin.notification-logs.index') }}" class="rounded-md border border-zinc-300 px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
            Reset
        </a>
    </div>
</form>
