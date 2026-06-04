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
    <div class="modern-panel rounded-[22px]">
        <div class="border-b border-zinc-200 px-5 py-4">
            <h2 class="text-base font-semibold text-zinc-950">Daftar Ruangan</h2>
            <p class="mt-1 text-sm text-zinc-500">Kelola identitas ruangan dan ambang batas suhu per ruangan.</p>
        </div>

        <div class="overflow-x-auto p-3">
            <table class="w-full min-w-[900px] border-separate border-spacing-y-2 text-left text-sm">
                <thead class="text-xs uppercase text-zinc-500">
                    <tr>
                        <th class="px-4 py-2">Ruangan</th>
                        <th class="px-4 py-2">Lokasi</th>
                        <th class="px-4 py-2 text-right">Waspada</th>
                        <th class="px-4 py-2 text-right">Bahaya</th>
                        <th class="px-4 py-2 text-center">Device</th>
                        <th class="px-4 py-2 text-center">Status</th>
                        <th class="px-4 py-2 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rooms as $room)
                        <tr class="group">
                            <td class="rounded-l-2xl border-y border-l border-zinc-100 bg-white px-4 py-4 shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                                <p class="font-medium text-zinc-950">{{ $room->name }}</p>
                                <p class="mt-1 text-xs text-zinc-500">{{ $room->code }}</p>
                            </td>
                            <td class="border-y border-zinc-100 bg-white px-4 py-4 text-zinc-600 shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">{{ $room->location ?? '-' }}</td>
                            <td class="border-y border-zinc-100 bg-white px-4 py-4 text-right shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                                <span class="inline-flex rounded-full border border-amber-100 bg-amber-50 px-2.5 py-1 text-xs font-semibold tabular-nums text-amber-700">{{ number_format((float) $room->warning_temperature, 1) }} C</span>
                            </td>
                            <td class="border-y border-zinc-100 bg-white px-4 py-4 text-right shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                                <span class="inline-flex rounded-full border border-red-100 bg-red-50 px-2.5 py-1 text-xs font-semibold tabular-nums text-red-700">{{ number_format((float) $room->danger_temperature, 1) }} C</span>
                            </td>
                            <td class="border-y border-zinc-100 bg-white px-4 py-4 text-center shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                                <span class="inline-flex rounded-full border border-sky-100 bg-sky-50 px-2.5 py-1 text-xs font-semibold tabular-nums text-sky-700">{{ $room->devices_count }}</span>
                            </td>
                            <td class="border-y border-zinc-100 bg-white px-4 py-4 text-center shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                                <span class="inline-flex rounded-full border px-2.5 py-1 text-xs font-medium {{ $room->is_active ? 'border-emerald-100 bg-emerald-50 text-emerald-700' : 'border-zinc-200 bg-zinc-100 text-zinc-600' }}">
                                    {{ $room->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="rounded-r-2xl border-y border-r border-zinc-100 bg-white px-4 py-4 text-right shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
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
                            <td colspan="7" class="px-5 py-12 text-center">
                                <div class="mx-auto flex max-w-sm flex-col items-center gap-3 text-zinc-500">
                                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-700">
                                        @include('dashboard.partials.icon', ['name' => 'sensor', 'class' => 'h-6 w-6'])
                                    </span>
                                    <span>Belum ada data ruangan.</span>
                                </div>
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
