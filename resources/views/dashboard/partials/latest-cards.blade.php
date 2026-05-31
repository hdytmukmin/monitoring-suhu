@php
    $status = $latest?->status;
    $statusClass = match ($status?->value) {
        'danger' => 'border-red-200 bg-red-50 text-red-800 shadow-red-100/70',
        'warning' => 'border-amber-200 bg-amber-50 text-amber-800 shadow-amber-100/70',
        default => 'border-emerald-200 bg-emerald-50 text-emerald-800 shadow-emerald-100/70',
    };
@endphp

<section class="grid gap-4 lg:grid-cols-4">
    <div class="overflow-hidden rounded-[22px] border border-emerald-100 bg-white shadow-xl shadow-emerald-950/5 lg:col-span-2">
        <div class="h-1.5 bg-emerald-600"></div>
        <div class="p-5">
        <p class="text-sm font-medium text-teal-700">Suhu terbaru</p>
        <div class="mt-3 flex items-end gap-3">
            <p class="text-5xl font-semibold tabular-nums text-zinc-950">
                {{ $latest ? number_format((float) $latest->temperature, 1) : '--' }}
            </p>
            <p class="pb-2 text-lg font-medium text-zinc-500">C</p>
        </div>
        <p class="mt-3 text-sm text-zinc-600">
            {{ $latest?->room?->name ?? 'Belum ada data sensor' }}
            @if ($latest?->device)
                <span class="text-zinc-400">/ {{ $latest->device->name }}</span>
            @endif
        </p>
        <p class="mt-1 text-xs text-zinc-500">
            Update terakhir: {{ $latest?->recorded_at?->format('d M Y H:i:s') ?? '-' }}
        </p>
        </div>
    </div>

    <div class="rounded-[22px] border p-5 shadow-xl {{ $statusClass }}">
        <p class="text-sm font-medium opacity-80">Status</p>
        <p class="mt-3 text-3xl font-semibold">{{ $status?->label() ?? 'Normal' }}</p>
        <p class="mt-3 text-sm opacity-80">Auto-refresh setiap 30 detik.</p>
    </div>

    <div class="overflow-hidden rounded-[22px] border border-sky-100 bg-white shadow-xl shadow-emerald-950/5">
        <div class="h-1 bg-sky-500"></div>
        <div class="p-5">
        <p class="text-sm font-medium text-sky-700">Kelembapan</p>
        <p class="mt-3 text-3xl font-semibold tabular-nums text-zinc-950">
            {{ $latest?->humidity !== null ? number_format((float) $latest->humidity, 1).'%' : '-' }}
        </p>
        <p class="mt-3 text-sm text-zinc-500">Tersedia bila sensor mengirim humidity.</p>
        </div>
    </div>
</section>
