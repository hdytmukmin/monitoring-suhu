@php
    $status = $latest?->status;
    $statusClass = match ($status?->value) {
        'danger' => 'border-red-200 bg-red-50 text-red-800 shadow-red-100/70',
        'warning' => 'border-amber-200 bg-amber-50 text-amber-800 shadow-amber-100/70',
        default => 'border-emerald-200 bg-emerald-50 text-emerald-800 shadow-emerald-100/70',
    };
@endphp

<section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4 2xl:gap-6">
    <div class="overflow-hidden rounded-[22px] border border-emerald-100 bg-white shadow-xl shadow-emerald-950/5 md:col-span-2">
        <div class="h-1.5 bg-emerald-600"></div>
        <div class="p-5 xl:p-6 2xl:p-8">
        <p class="text-sm font-medium text-teal-700 2xl:text-base">Suhu terbaru</p>
        <div class="mt-3 flex items-end gap-3">
            <p class="text-5xl font-semibold tabular-nums text-zinc-950 xl:text-6xl 2xl:text-7xl">
                {{ $latest ? number_format((float) $latest->temperature, 1) : '--' }}
            </p>
            <p class="pb-2 text-lg font-medium text-zinc-500 xl:text-xl 2xl:text-2xl">C</p>
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

<<<<<<< HEAD
    <div class="rounded-[22px] border p-5 shadow-xl {{ $statusClass }}">
        <p class="text-sm font-medium opacity-80">Status</p>
        <p class="mt-3 text-3xl font-semibold">{{ $status?->label() ?? 'Normal' }}</p>
=======
    <div class="rounded-[22px] border p-5 shadow-xl xl:p-6 2xl:p-8 {{ $statusClass }}">
        <p class="text-sm font-medium opacity-80 2xl:text-base">Status</p>
        <p class="mt-3 text-3xl font-semibold xl:text-4xl 2xl:text-5xl">{{ $status?->label() ?? 'Normal' }}</p>
>>>>>>> 0727218 (responsive)
        <p class="mt-3 text-sm opacity-80">Auto-refresh setiap 30 detik.</p>
    </div>

    <div class="overflow-hidden rounded-[22px] border border-sky-100 bg-white shadow-xl shadow-emerald-950/5">
        <div class="h-1 bg-sky-500"></div>
<<<<<<< HEAD
        <div class="p-5">
        <p class="text-sm font-medium text-sky-700">Kelembapan</p>
        <p class="mt-3 text-3xl font-semibold tabular-nums text-zinc-950">
=======
        <div class="p-5 xl:p-6 2xl:p-8">
        <p class="text-sm font-medium text-sky-700 2xl:text-base">Kelembapan</p>
        <p class="mt-3 text-3xl font-semibold tabular-nums text-zinc-950 xl:text-4xl 2xl:text-5xl">
>>>>>>> 0727218 (responsive)
            {{ $latest?->humidity !== null ? number_format((float) $latest->humidity, 1).'%' : '-' }}
        </p>
        <p class="mt-3 text-sm text-zinc-500">Tersedia bila sensor mengirim humidity.</p>
        </div>
    </div>
</section>
