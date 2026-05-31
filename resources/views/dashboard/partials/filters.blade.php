<form method="GET" class="grid gap-3 sm:grid-cols-[minmax(190px,1fr)_180px_auto] 2xl:grid-cols-[minmax(240px,1fr)_210px_auto]">
    <select name="room_id" class="h-11 rounded-xl border border-zinc-300 bg-white px-3 text-sm text-slate-950 shadow-sm 2xl:h-12 2xl:text-base">
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
        class="h-11 rounded-xl border border-zinc-300 bg-white px-3 text-sm text-slate-950 shadow-sm 2xl:h-12 2xl:text-base"
    >

    <button class="h-11 rounded-xl bg-zinc-950 px-5 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800 2xl:h-12 2xl:px-6 2xl:text-base">
        Filter
    </button>
</form>
