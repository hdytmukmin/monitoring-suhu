<div class="overflow-hidden rounded-[22px] border border-zinc-200 bg-white shadow-xl shadow-emerald-950/5">
    <div class="border-b border-zinc-100 px-5 py-4 2xl:px-7 2xl:py-5">
        <h2 class="text-lg font-semibold text-zinc-950 2xl:text-xl">Histori Terbaru</h2>
        <p class="mt-1 text-sm text-zinc-500">Pembacaan sensor terakhir dari ruangan.</p>
    </div>

    <div class="overflow-x-auto px-5 py-4 2xl:px-7">
        <table class="w-full min-w-[420px] border-separate border-spacing-y-2 text-left text-sm">
            <thead class="text-xs uppercase text-zinc-500">
                <tr>
                    <th class="px-3 py-2">Waktu</th>
                    <th class="px-3 py-2">Ruang</th>
                    <th class="px-3 py-2 text-right">Suhu</th>
                </tr>
            </thead>
            <tbody id="recentReadingsBody">
                @forelse ($recentReadings as $reading)
                    @php
                        $statusTone = match ($reading->status->value) {
                            'danger' => 'border-red-100 bg-red-50 text-red-700',
                            'warning' => 'border-amber-100 bg-amber-50 text-amber-700',
                            default => 'border-emerald-100 bg-emerald-50 text-emerald-700',
                        };
                    @endphp
                    <tr class="group">
                        <td class="rounded-l-2xl border-y border-l border-zinc-100 bg-white px-3 py-3 text-zinc-600 shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                            {{ $reading->recorded_at->format('H:i:s') }}
                        </td>
                        <td class="border-y border-zinc-100 bg-white px-3 py-3 font-medium text-zinc-900 shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                            {{ $reading->room->name }}
                        </td>
                        <td class="rounded-r-2xl border-y border-r border-zinc-100 bg-white px-3 py-3 text-right shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                            <span class="inline-flex items-center gap-1.5 rounded-full border px-2.5 py-1 text-xs font-bold tabular-nums {{ $statusTone }}">
                                @include('dashboard.partials.icon', ['name' => 'thermometer', 'class' => 'h-3.5 w-3.5'])
                                {{ number_format((float) $reading->temperature, 1) }} C
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-10 text-center">
                            <div class="mx-auto flex max-w-xs flex-col items-center gap-3 text-zinc-500">
                                <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-700">
                                    @include('dashboard.partials.icon', ['name' => 'sensor', 'class' => 'h-6 w-6'])
                                </span>
                                <span>Belum ada histori suhu.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
