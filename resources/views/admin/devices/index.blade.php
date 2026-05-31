@extends('admin.layouts.app')

@section('title', 'Manajemen Device')
@section('page-title', 'Manajemen Device')
@section('page-eyebrow', 'Master Data')

@section('page-actions')
    <a
        href="{{ route('admin.devices.create') }}"
        class="inline-flex h-10 items-center rounded-md bg-zinc-950 px-4 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800"
    >
        Tambah Device
    </a>
@endsection

@section('content')
    <div class="rounded-lg border border-zinc-200 bg-white shadow-sm">
        <div class="border-b border-zinc-200 px-5 py-4">
            <h2 class="text-base font-semibold text-zinc-950">Daftar Device Arduino</h2>
            <p class="mt-1 text-sm text-zinc-500">Kelola alat, sensor, ruangan terpasang, dan status koneksi terakhir.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-zinc-200 bg-zinc-50 text-xs uppercase text-zinc-500">
                    <tr>
                        <th class="px-5 py-3">Device</th>
                        <th class="px-5 py-3">Ruangan</th>
                        <th class="px-5 py-3">Sensor</th>
                        <th class="px-5 py-3 text-center">Reading</th>
                        <th class="px-5 py-3">Terakhir Online</th>
                        <th class="px-5 py-3 text-center">Status</th>
                        <th class="px-5 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse ($devices as $device)
                        @php
                            $isOnline = $device->last_seen_at?->gte(now()->subMinutes(5)) ?? false;
                        @endphp

                        <tr>
                            <td class="px-5 py-4">
                                <p class="font-medium text-zinc-950">{{ $device->name }}</p>
                                <p class="mt-1 text-xs text-zinc-500">{{ $device->device_uid }}</p>
                            </td>
                            <td class="px-5 py-4 text-zinc-600">{{ $device->room?->name ?? '-' }}</td>
                            <td class="px-5 py-4 text-zinc-600">{{ $device->sensor_type }}</td>
                            <td class="px-5 py-4 text-center tabular-nums">{{ $device->readings_count }}</td>
                            <td class="px-5 py-4 text-zinc-600">
                                {{ $device->last_seen_at?->format('d M Y H:i') ?? 'Belum pernah' }}
                            </td>
                            <td class="px-5 py-4 text-center">
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $device->is_active ? ($isOnline ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700') : 'bg-zinc-100 text-zinc-600' }}">
                                    {{ $device->is_active ? ($isOnline ? 'Online' : 'Aktif') : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('admin.devices.edit', $device) }}" class="font-medium text-zinc-950 hover:underline">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.devices.destroy', $device) }}" method="POST" onsubmit="return confirm('Hapus device ini?')">
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
                                Belum ada data device.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($devices->hasPages())
            <div class="border-t border-zinc-200 px-5 py-4">
                {{ $devices->links() }}
            </div>
        @endif
    </div>
@endsection
