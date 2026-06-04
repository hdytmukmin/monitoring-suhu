@php
    $status = $latest?->status;
    $statusClass = match ($status?->value) {
        'danger' => 'border-red-200 bg-red-50 text-red-800 shadow-red-100/70',
        'warning' => 'border-amber-200 bg-amber-50 text-amber-800 shadow-amber-100/70',
        default => 'border-emerald-200 bg-emerald-50 text-emerald-800 shadow-emerald-100/70',
    };
    $statusIconClass = match ($status?->value) {
        'danger' => 'bg-red-100 text-red-700',
        'warning' => 'bg-amber-100 text-amber-700',
        default => 'bg-emerald-100 text-emerald-700',
    };
@endphp

<section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4 2xl:gap-6">
    <div class="overflow-hidden rounded-[22px] border border-emerald-100 bg-white shadow-xl shadow-emerald-950/5 md:col-span-2">
        <div class="h-1.5 bg-[linear-gradient(90deg,#059669,#f59e0b,#ef4444)]"></div>
        <div class="p-5 xl:p-6 2xl:p-8">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium text-teal-700 2xl:text-base">Suhu terbaru</p>
                    <div class="mt-3 flex items-end gap-3">
                        <p class="text-5xl font-semibold tabular-nums text-zinc-950 xl:text-6xl 2xl:text-7xl">
                            {{ $latest ? number_format((float) $latest->temperature, 1) : '--' }}
                        </p>
                        <p class="pb-2 text-lg font-medium text-zinc-500 xl:text-xl 2xl:text-2xl">C</p>
                    </div>
                </div>
                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-orange-100 text-orange-700 ring-8 ring-orange-50">
                    @include('dashboard.partials.icon', ['name' => 'thermometer', 'class' => 'h-7 w-7'])
                </div>
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

    <div class="rounded-[22px] border p-5 shadow-xl xl:p-6 2xl:p-8 {{ $statusClass }}">
        <div class="flex items-center justify-between gap-4">
            <p class="text-sm font-medium opacity-80 2xl:text-base">Status</p>
            <div class="flex h-11 w-11 items-center justify-center rounded-2xl {{ $statusIconClass }}">
                @include('dashboard.partials.icon', ['name' => 'gauge', 'class' => 'h-6 w-6'])
            </div>
        </div>
        <p class="mt-3 text-3xl font-semibold xl:text-4xl 2xl:text-5xl">{{ $status?->label() ?? 'Normal' }}</p>
        <p class="mt-3 text-sm opacity-80">Auto-refresh setiap 30 detik.</p>
    </div>

    <div class="overflow-hidden rounded-[22px] border border-sky-100 bg-white shadow-xl shadow-emerald-950/5">
        <div class="h-1 bg-sky-500"></div>
        <div class="p-5 xl:p-6 2xl:p-8">
            <div class="flex items-center justify-between gap-4">
                <p class="text-sm font-medium text-sky-700 2xl:text-base">Kelembapan</p>
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-sky-100 text-sky-700">
                    @include('dashboard.partials.icon', ['name' => 'droplet', 'class' => 'h-6 w-6'])
                </div>
            </div>
            <p class="mt-3 text-3xl font-semibold tabular-nums text-zinc-950 xl:text-4xl 2xl:text-5xl">
                {{ $latest?->humidity !== null ? number_format((float) $latest->humidity, 1).'%' : '-' }}
            </p>
            <p class="mt-3 text-sm text-zinc-500">Tersedia bila sensor mengirim humidity.</p>
        </div>
    </div>
</section>
