@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')
@section('page-eyebrow', 'Admin')

@section('content')
    <section class="mb-8 overflow-hidden rounded-[28px] bg-emerald-950 text-white shadow-2xl shadow-emerald-950/10">
        <div class="grid gap-8 bg-[linear-gradient(110deg,#064e3b_0%,#047857_52%,#38bdf8_100%)] px-7 py-10 lg:grid-cols-[1fr_620px] lg:items-center">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm font-semibold uppercase tracking-[0.18em] text-emerald-50 backdrop-blur">
                    @include('dashboard.partials.icon', ['name' => 'sensor', 'class' => 'h-4 w-4 text-cyan-100'])
                    Monitoring Suhu
                </div>
                <h2 class="mt-4 text-4xl font-bold tracking-tight text-white">Pantau Suhu Ruangan</h2>
                <p class="mt-3 max-w-2xl text-base text-emerald-50">Lihat kondisi ruangan, pembacaan sensor terbaru, dan peringatan suhu dari satu dashboard yang ringkas.</p>
                <a href="{{ route('admin.readings.index') }}" class="mt-8 inline-flex h-11 items-center justify-center rounded-xl bg-white px-5 text-sm font-bold text-emerald-900 shadow-sm hover:bg-emerald-50">
                    @include('dashboard.partials.icon', ['name' => 'chart', 'class' => 'mr-2 h-4 w-4'])
                    Lihat Histori
                </a>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-3xl border border-white/20 bg-white/15 p-6 shadow-sm backdrop-blur">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm font-medium uppercase tracking-wide text-emerald-50">Total Ruangan</p>
                        @include('dashboard.partials.icon', ['name' => 'sensor', 'class' => 'h-5 w-5 text-emerald-100'])
                    </div>
                    <p class="mt-5 text-4xl font-bold">{{ number_format($stats['rooms']) }}</p>
                    <p class="mt-2 text-sm text-emerald-50">Ruangan yang dipantau</p>
                </div>
                <div class="rounded-3xl border border-white/20 bg-white/15 p-6 shadow-sm backdrop-blur">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm font-medium uppercase tracking-wide text-emerald-50">Sensor Aktif</p>
                        @include('dashboard.partials.icon', ['name' => 'sensor', 'class' => 'h-5 w-5 text-cyan-100'])
                    </div>
                    <p class="mt-5 text-4xl font-bold">{{ number_format($stats['active_devices']) }}</p>
                    <p class="mt-2 text-sm text-emerald-50">{{ number_format($stats['online_devices']) }} mengirim data terbaru</p>
                </div>
                <div class="rounded-3xl border border-white/20 bg-white/15 p-6 shadow-sm backdrop-blur">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm font-medium uppercase tracking-wide text-emerald-50">Data Hari Ini</p>
                        @include('dashboard.partials.icon', ['name' => 'thermometer', 'class' => 'h-5 w-5 text-amber-100'])
                    </div>
                    <p class="mt-5 text-4xl font-bold">{{ number_format($stats['readings_today']) }}</p>
                    <p class="mt-2 text-sm text-emerald-50">Pembacaan suhu diterima</p>
                </div>
                <div class="rounded-3xl border border-white/20 bg-white/15 p-6 shadow-sm backdrop-blur">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm font-medium uppercase tracking-wide text-emerald-50">Peringatan Suhu</p>
                        @include('dashboard.partials.icon', ['name' => 'gauge', 'class' => 'h-5 w-5 text-red-100'])
                    </div>
                    <p class="mt-5 text-4xl font-bold">{{ number_format($stats['pending_alerts']) }}</p>
                    <p class="mt-2 text-sm text-emerald-50">{{ number_format($stats['failed_alerts']) }} notifikasi gagal terkirim</p>
                </div>
            </div>
        </div>
    </section>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-[22px] border border-emerald-100 bg-white p-6 shadow-xl shadow-emerald-950/5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-bold uppercase tracking-wide text-slate-500">Total Ruangan</p>
                    <p class="mt-8 text-4xl font-bold text-slate-900">{{ number_format($stats['rooms']) }}</p>
                    <p class="mt-3 text-sm text-slate-500">Ruangan monitoring aktif.</p>
                </div>
                <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">
                    @include('dashboard.partials.icon', ['name' => 'sensor', 'class' => 'h-6 w-6'])
                </span>
            </div>
        </div>

        <div class="rounded-[22px] border border-sky-100 bg-white p-6 shadow-xl shadow-emerald-950/5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-bold uppercase tracking-wide text-slate-500">Sensor Aktif</p>
                    <p class="mt-8 text-4xl font-bold text-slate-900">{{ number_format($stats['active_devices']) }}</p>
                    <p class="mt-3 text-sm text-slate-500">{{ number_format($stats['online_devices']) }} baru mengirim data.</p>
                </div>
                <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-100 text-sky-700">
                    @include('dashboard.partials.icon', ['name' => 'sensor', 'class' => 'h-6 w-6'])
                </span>
            </div>
        </div>

        <div class="rounded-[22px] border border-orange-100 bg-white p-6 shadow-xl shadow-emerald-950/5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-bold uppercase tracking-wide text-slate-500">Data Hari Ini</p>
                    <p class="mt-8 text-4xl font-bold text-slate-900">{{ number_format($stats['readings_today']) }}</p>
                    <p class="mt-3 text-sm text-slate-500">Pembacaan suhu diterima.</p>
                </div>
                <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-100 text-orange-700">
                    @include('dashboard.partials.icon', ['name' => 'thermometer', 'class' => 'h-6 w-6'])
                </span>
            </div>
        </div>

        <div class="rounded-[22px] border border-red-100 bg-white p-6 shadow-xl shadow-emerald-950/5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-bold uppercase tracking-wide text-slate-500">Peringatan Suhu</p>
                    <p class="mt-8 text-4xl font-bold text-slate-900">{{ number_format($stats['pending_alerts']) }}</p>
                    <p class="mt-3 text-sm text-slate-500">{{ number_format($stats['failed_alerts']) }} notifikasi gagal.</p>
                </div>
                <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-100 text-red-700">
                    @include('dashboard.partials.icon', ['name' => 'gauge', 'class' => 'h-6 w-6'])
                </span>
            </div>
        </div>
    </div>

    <div class="mt-6 grid gap-6 xl:grid-cols-2">
        <div class="modern-panel rounded-xl">
            <div class="border-b border-zinc-200 px-5 py-4">
                <h2 class="text-base font-semibold text-zinc-950">Device Terbaru</h2>
                <p class="mt-1 text-sm text-zinc-500">Pantau koneksi device berdasarkan waktu terakhir mengirim data.</p>
            </div>

            <div class="divide-y divide-zinc-100">
                @forelse ($recentDevices as $device)
                    @php
                        $isOnline = $device->last_seen_at?->gte(now()->subMinutes(5)) ?? false;
                    @endphp

                    <div class="flex items-center justify-between gap-4 px-5 py-4">
                        <div class="min-w-0">
                            <p class="truncate text-sm font-medium text-zinc-950">{{ $device->name }}</p>
                            <p class="mt-1 truncate text-xs text-zinc-500">{{ $device->room?->name ?? '-' }} / {{ $device->device_uid }}</p>
                        </div>
                        <div class="shrink-0 text-right">
                            <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $isOnline ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">
                                {{ $isOnline ? 'Online' : 'Standby' }}
                            </span>
                            <p class="mt-1 text-xs text-zinc-500">{{ $device->last_seen_at?->format('H:i') ?? '-' }}</p>
                        </div>
                    </div>
                @empty
                    <div class="px-5 py-10 text-center text-sm text-zinc-500">Belum ada device.</div>
                @endforelse
            </div>
        </div>

        <div class="modern-panel rounded-xl">
            <div class="border-b border-zinc-200 px-5 py-4">
                <h2 class="text-base font-semibold text-zinc-950">Alert Terbaru</h2>
                <p class="mt-1 text-sm text-zinc-500">Riwayat alert suhu yang dibuat sistem.</p>
            </div>

            <div class="divide-y divide-zinc-100">
                @forelse ($recentAlerts as $alert)
                    @php
                        $statusClass = match ($alert->status) {
                            'sent' => 'bg-emerald-50 text-emerald-700',
                            'failed' => 'bg-red-50 text-red-700',
                            default => 'bg-amber-50 text-amber-700',
                        };
                    @endphp

                    <div class="flex items-start justify-between gap-4 px-5 py-4">
                        <div class="min-w-0">
                            <p class="truncate text-sm font-medium text-zinc-950">{{ $alert->room?->name ?? '-' }}</p>
                            <p class="mt-1 truncate text-xs text-zinc-500">
                                {{ ucfirst($alert->channel) }} ke {{ $alert->recipient }}
                            </p>
                        </div>
                        <div class="shrink-0 text-right">
                            <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $statusClass }}">
                                {{ ucfirst($alert->status) }}
                            </span>
                            <p class="mt-1 text-xs text-zinc-500">{{ $alert->created_at->format('H:i') }}</p>
                        </div>
                    </div>
                @empty
                    <div class="px-5 py-10 text-center text-sm text-zinc-500">Belum ada alert.</div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="modern-panel mt-6 rounded-xl">
        <div class="border-b border-zinc-200 px-5 py-4">
            <h2 class="text-base font-semibold text-zinc-950">Reading Terbaru</h2>
            <p class="mt-1 text-sm text-zinc-500">Data sensor terakhir yang diterima dari API Arduino.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-zinc-200 bg-zinc-50 text-xs uppercase text-zinc-500">
                    <tr>
                        <th class="px-5 py-3">Waktu</th>
                        <th class="px-5 py-3">Ruangan</th>
                        <th class="px-5 py-3">Device</th>
                        <th class="px-5 py-3 text-right">Suhu</th>
                        <th class="px-5 py-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse ($latestReadings as $reading)
                        @php
                            $statusClass = match ($reading->status->value) {
                                'danger' => 'bg-red-50 text-red-700',
                                'warning' => 'bg-amber-50 text-amber-700',
                                default => 'bg-emerald-50 text-emerald-700',
                            };
                        @endphp
                        <tr>
                            <td class="px-5 py-4 text-zinc-600">{{ $reading->recorded_at->format('d M Y H:i:s') }}</td>
                            <td class="px-5 py-4">{{ $reading->room?->name ?? '-' }}</td>
                            <td class="px-5 py-4 text-zinc-600">{{ $reading->device?->name ?? '-' }}</td>
                            <td class="px-5 py-4 text-right font-medium tabular-nums">{{ number_format((float) $reading->temperature, 1) }} C</td>
                            <td class="px-5 py-4 text-center">
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $statusClass }}">
                                    {{ $reading->status->label() }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center text-zinc-500">Belum ada data sensor.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
