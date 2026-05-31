@extends('admin.layouts.app')

@section('title', 'Manajemen Ruangan')
@section('page-title', 'Manajemen Ruangan')
@section('page-eyebrow', 'Master Data')

@section('page-actions')
    <a
        href="{{ route('admin.rooms.create') }}"
        class="inline-flex h-10 items-center rounded-md bg-zinc-950 px-4 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800"
    >
        Tambah Ruangan
    </a>
@endsection

@section('content')
    <div class="rounded-lg border border-zinc-200 bg-white shadow-sm">
        <div class="border-b border-zinc-200 px-5 py-4">
            <h2 class="text-base font-semibold text-zinc-950">Daftar Ruangan</h2>
            <p class="mt-1 text-sm text-zinc-500">Kelola identitas ruangan dan ambang batas suhu per ruangan.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-zinc-200 bg-zinc-50 text-xs uppercase text-zinc-500">
                    <tr>
                        <th class="px-5 py-3">Ruangan</th>
                        <th class="px-5 py-3">Lokasi</th>
                        <th class="px-5 py-3 text-right">Waspada</th>
                        <th class="px-5 py-3 text-right">Bahaya</th>
                        <th class="px-5 py-3 text-center">Device</th>
                        <th class="px-5 py-3 text-center">Status</th>
                        <th class="px-5 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse ($rooms as $room)
                        <tr>
                            <td class="px-5 py-4">
                                <p class="font-medium text-zinc-950">{{ $room->name }}</p>
                                <p class="mt-1 text-xs text-zinc-500">{{ $room->code }}</p>
                            </td>
                            <td class="px-5 py-4 text-zinc-600">{{ $room->location ?? '-' }}</td>
                            <td class="px-5 py-4 text-right tabular-nums">{{ number_format((float) $room->warning_temperature, 1) }} C</td>
                            <td class="px-5 py-4 text-right tabular-nums">{{ number_format((float) $room->danger_temperature, 1) }} C</td>
                            <td class="px-5 py-4 text-center tabular-nums">{{ $room->devices_count }}</td>
                            <td class="px-5 py-4 text-center">
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $room->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-zinc-100 text-zinc-600' }}">
                                    {{ $room->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('admin.rooms.edit', $room) }}" class="font-medium text-zinc-950 hover:underline">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" onsubmit="return confirm('Hapus ruangan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-700 hover:underline">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-10 text-center text-zinc-500">
                                Belum ada data ruangan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($rooms->hasPages())
            <div class="border-t border-zinc-200 px-5 py-4">
                {{ $rooms->links() }}
            </div>
        @endif
    </div>
@endsection
