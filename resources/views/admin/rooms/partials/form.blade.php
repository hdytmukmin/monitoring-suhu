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
                <label for="name" class="text-sm font-medium text-zinc-700">Nama Ruangan</label>
                <input id="name" name="name" type="text" value="{{ old('name', $room->name) }}" class="mt-2 h-10 w-full rounded-md border border-zinc-300 bg-white px-3 text-sm shadow-sm" placeholder="Ruang Server">
                @error('name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="code" class="text-sm font-medium text-zinc-700">Kode Ruangan</label>
                <input id="code" name="code" type="text" value="{{ old('code', $room->code) }}" class="mt-2 h-10 w-full rounded-md border border-zinc-300 bg-white px-3 text-sm shadow-sm" placeholder="SERVER-01">
                @error('code')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="location" class="text-sm font-medium text-zinc-700">Lokasi</label>
            <input id="location" name="location" type="text" value="{{ old('location', $room->location) }}" class="mt-2 h-10 w-full rounded-md border border-zinc-300 bg-white px-3 text-sm shadow-sm" placeholder="Gedung Utama">
            @error('location')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="warning_temperature" class="text-sm font-medium text-zinc-700">Batas Waspada</label>
                <div class="mt-2 flex rounded-md shadow-sm">
                    <input id="warning_temperature" name="warning_temperature" type="number" step="0.1" value="{{ old('warning_temperature', $room->warning_temperature) }}" class="h-10 min-w-0 flex-1 rounded-l-md border border-zinc-300 bg-white px-3 text-sm">
                    <span class="inline-flex h-10 items-center rounded-r-md border border-l-0 border-zinc-300 bg-zinc-50 px-3 text-sm text-zinc-500">C</span>
                </div>
                @error('warning_temperature')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="danger_temperature" class="text-sm font-medium text-zinc-700">Batas Bahaya</label>
                <div class="mt-2 flex rounded-md shadow-sm">
                    <input id="danger_temperature" name="danger_temperature" type="number" step="0.1" value="{{ old('danger_temperature', $room->danger_temperature) }}" class="h-10 min-w-0 flex-1 rounded-l-md border border-zinc-300 bg-white px-3 text-sm">
                    <span class="inline-flex h-10 items-center rounded-r-md border border-l-0 border-zinc-300 bg-zinc-50 px-3 text-sm text-zinc-500">C</span>
                </div>
                @error('danger_temperature')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <label class="flex items-center gap-3 rounded-md border border-zinc-200 p-3">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $room->is_active)) class="h-4 w-4 rounded border-zinc-300">
            <span>
                <span class="block text-sm font-medium text-zinc-700">Ruangan aktif</span>
                <span class="block text-xs text-zinc-500">Ruangan aktif dapat menerima data sensor dan notifikasi.</span>
            </span>
        </label>

        <div class="flex items-center justify-end gap-3 border-t border-zinc-200 pt-5">
            <a href="{{ route('admin.rooms.index') }}" class="rounded-md border border-zinc-300 px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
                Batal
            </a>
            <button type="submit" class="rounded-md bg-zinc-950 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800">
                Simpan
            </button>
        </div>
    </form>
</div>
