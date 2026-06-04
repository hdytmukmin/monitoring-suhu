<div class="overflow-x-auto p-3">
    <table class="w-full min-w-[860px] border-separate border-spacing-y-2 text-left text-sm">
        <thead class="text-xs uppercase text-zinc-500">
            <tr>
                <th class="px-4 py-2">Waktu</th>
                <th class="px-4 py-2">Ruangan</th>
                <th class="px-4 py-2">Device</th>
                <th class="px-4 py-2 text-right">Suhu</th>
                <th class="px-4 py-2 text-right">Humidity</th>
                <th class="px-4 py-2 text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($readings as $reading)
                @php
                    $statusClass = match ($reading->status->value) {
                        'danger' => 'border-red-100 bg-red-50 text-red-700',
                        'warning' => 'border-amber-100 bg-amber-50 text-amber-700',
                        default => 'border-emerald-100 bg-emerald-50 text-emerald-700',
                    };
                    $rowAccent = match ($reading->status->value) {
                        'danger' => 'before:bg-red-500',
                        'warning' => 'before:bg-amber-500',
                        default => 'before:bg-emerald-500',
                    };
                @endphp
                <tr class="group relative {{ $rowAccent }} before:absolute before:left-0 before:top-2 before:h-[calc(100%-1rem)] before:w-1 before:rounded-full">
                    <td class="rounded-l-2xl border-y border-l border-zinc-100 bg-white px-4 py-4 text-zinc-600 shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                        {{ $reading->recorded_at->format('d M Y H:i:s') }}
                    </td>
                    <td class="border-y border-zinc-100 bg-white px-4 py-4 shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                        <p class="font-semibold text-zinc-950">{{ $reading->room?->name ?? '-' }}</p>
                    </td>
                    <td class="border-y border-zinc-100 bg-white px-4 py-4 text-zinc-600 shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">{{ $reading->device?->name ?? '-' }}</td>
                    <td class="border-y border-zinc-100 bg-white px-4 py-4 text-right shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                        <span class="inline-flex items-center gap-1.5 rounded-full border px-2.5 py-1 text-xs font-bold tabular-nums {{ $statusClass }}">
                            @include('dashboard.partials.icon', ['name' => 'thermometer', 'class' => 'h-3.5 w-3.5'])
                            {{ number_format((float) $reading->temperature, 1) }} C
                        </span>
                    </td>
                    <td class="border-y border-zinc-100 bg-white px-4 py-4 text-right shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-sky-100 bg-sky-50 px-2.5 py-1 text-xs font-semibold tabular-nums text-sky-700">
                            @include('dashboard.partials.icon', ['name' => 'droplet', 'class' => 'h-3.5 w-3.5'])
                            {{ $reading->humidity !== null ? number_format((float) $reading->humidity, 1).'%' : '-' }}
                        </span>
                    </td>
                    <td class="rounded-r-2xl border-y border-r border-zinc-100 bg-white px-4 py-4 text-center shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                        <span class="inline-flex rounded-full border px-2.5 py-1 text-xs font-semibold {{ $statusClass }}">
                            {{ $reading->status->label() }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-5 py-12 text-center">
                        <div class="mx-auto flex max-w-sm flex-col items-center gap-3 text-zinc-500">
                            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-700">
                                @include('dashboard.partials.icon', ['name' => 'sensor', 'class' => 'h-6 w-6'])
                            </span>
                            <span>Belum ada histori suhu untuk filter ini.</span>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if ($readings->hasPages())
    <div class="border-t border-zinc-200 px-5 py-4">
        {{ $readings->links() }}
    </div>
@endif
