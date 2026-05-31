@extends('admin.layouts.app')

@section('title', 'Pengaturan Notifikasi')
@section('page-title', 'Pengaturan Notifikasi')
@section('page-eyebrow', 'Monitoring')

@section('page-actions')
    <a
        href="{{ route('admin.notifications.create') }}"
        class="inline-flex h-10 items-center rounded-md bg-zinc-950 px-4 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800"
    >
        Tambah Channel
    </a>
@endsection

@section('content')
    <div class="rounded-lg border border-zinc-200 bg-white shadow-sm">
        <div class="border-b border-zinc-200 px-5 py-4">
            <h2 class="text-base font-semibold text-zinc-950">Daftar Channel Notifikasi</h2>
            <p class="mt-1 text-sm text-zinc-500">Atur tujuan pengiriman alert suhu dan cooldown agar notifikasi tidak spam.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-zinc-200 bg-zinc-50 text-xs uppercase text-zinc-500">
                    <tr>
                        <th class="px-5 py-3">Channel</th>
                        <th class="px-5 py-3">Ruangan</th>
                        <th class="px-5 py-3">Recipient</th>
                        <th class="px-5 py-3 text-center">Cooldown</th>
                        <th class="px-5 py-3 text-center">Log</th>
                        <th class="px-5 py-3 text-center">Status</th>
                        <th class="px-5 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse ($settings as $setting)
                        <tr>
                            <td class="px-5 py-4">
                                <p class="font-medium capitalize text-zinc-950">{{ $setting->channel }}</p>
                                <p class="mt-1 text-xs text-zinc-500">Alert suhu ruangan</p>
                            </td>
                            <td class="px-5 py-4 text-zinc-600">{{ $setting->room?->name ?? 'Global' }}</td>
                            <td class="px-5 py-4 text-zinc-600">{{ $setting->recipient }}</td>
                            <td class="px-5 py-4 text-center tabular-nums">{{ $setting->cooldown_minutes }} menit</td>
                            <td class="px-5 py-4 text-center tabular-nums">{{ $setting->logs_count }}</td>
                            <td class="px-5 py-4 text-center">
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $setting->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-zinc-100 text-zinc-600' }}">
                                    {{ $setting->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('admin.notifications.edit', $setting) }}" class="font-medium text-zinc-950 hover:underline">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.notifications.destroy', $setting) }}" method="POST" onsubmit="return confirm('Hapus atau nonaktifkan pengaturan notifikasi ini?')">
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
                                Belum ada pengaturan notifikasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($settings->hasPages())
            <div class="border-t border-zinc-200 px-5 py-4">
                {{ $settings->links() }}
            </div>
        @endif
    </div>
@endsection
