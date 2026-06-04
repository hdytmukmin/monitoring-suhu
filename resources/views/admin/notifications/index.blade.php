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
    <div class="modern-panel rounded-[22px]">
        <div class="border-b border-zinc-200 px-5 py-4">
            <h2 class="text-base font-semibold text-zinc-950">Daftar Channel Notifikasi</h2>
            <p class="mt-1 text-sm text-zinc-500">Atur tujuan pengiriman alert suhu dan cooldown agar notifikasi tidak spam.</p>
        </div>

        <div class="overflow-x-auto p-3">
            <table class="w-full min-w-[920px] border-separate border-spacing-y-2 text-left text-sm">
                <thead class="text-xs uppercase text-zinc-500">
                    <tr>
                        <th class="px-4 py-2">Channel</th>
                        <th class="px-4 py-2">Ruangan</th>
                        <th class="px-4 py-2">Recipient</th>
                        <th class="px-4 py-2 text-center">Cooldown</th>
                        <th class="px-4 py-2 text-center">Log</th>
                        <th class="px-4 py-2 text-center">Status</th>
                        <th class="px-4 py-2 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($settings as $setting)
                        <tr class="group">
                            <td class="rounded-l-2xl border-y border-l border-zinc-100 bg-white px-4 py-4 shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                                <p class="font-medium capitalize text-zinc-950">{{ $setting->channel }}</p>
                                <p class="mt-1 text-xs text-zinc-500">Alert suhu ruangan</p>
                            </td>
                            <td class="border-y border-zinc-100 bg-white px-4 py-4 font-medium text-zinc-700 shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">{{ $setting->room?->name ?? 'Global' }}</td>
                            <td class="border-y border-zinc-100 bg-white px-4 py-4 text-zinc-600 shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">{{ $setting->recipient }}</td>
                            <td class="border-y border-zinc-100 bg-white px-4 py-4 text-center shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                                <span class="inline-flex rounded-full border border-amber-100 bg-amber-50 px-2.5 py-1 text-xs font-semibold tabular-nums text-amber-700">{{ $setting->cooldown_minutes }} menit</span>
                            </td>
                            <td class="border-y border-zinc-100 bg-white px-4 py-4 text-center shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                                <span class="inline-flex rounded-full border border-sky-100 bg-sky-50 px-2.5 py-1 text-xs font-semibold tabular-nums text-sky-700">{{ $setting->logs_count }}</span>
                            </td>
                            <td class="border-y border-zinc-100 bg-white px-4 py-4 text-center shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                                <span class="inline-flex rounded-full border px-2.5 py-1 text-xs font-medium {{ $setting->is_active ? 'border-emerald-100 bg-emerald-50 text-emerald-700' : 'border-zinc-200 bg-zinc-100 text-zinc-600' }}">
                                    {{ $setting->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="rounded-r-2xl border-y border-r border-zinc-100 bg-white px-4 py-4 text-right shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
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
                            <td colspan="7" class="px-5 py-12 text-center">
                                <div class="mx-auto flex max-w-sm flex-col items-center gap-3 text-zinc-500">
                                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-700">
                                        @include('dashboard.partials.icon', ['name' => 'gauge', 'class' => 'h-6 w-6'])
                                    </span>
                                    <span>Belum ada pengaturan notifikasi.</span>
                                </div>
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
