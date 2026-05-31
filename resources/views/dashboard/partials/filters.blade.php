<form method="GET" class="grid gap-3 sm:grid-cols-[220px_180px_auto]">
    <select name="room_id" class="h-10 rounded-md border border-zinc-300 bg-white px-3 text-sm shadow-sm">
        <option value="">Semua ruangan</option>
        @foreach ($rooms as $room)
            <option value="{{ $room->id }}" @selected($selectedRoomId === $room->id)>
                {{ $room->name }}
            </option>
        @endforeach
    </select>

    <input
        type="date"
        name="date"
        value="{{ $selectedDate->toDateString() }}"
        class="h-10 rounded-md border border-zinc-300 bg-white px-3 text-sm shadow-sm"
    >

    <button class="h-10 rounded-md bg-zinc-950 px-4 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800">
        Filter
    </button>
</form>
