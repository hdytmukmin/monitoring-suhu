<div class="overflow-hidden rounded-[22px] border border-zinc-200 bg-white shadow-xl shadow-emerald-950/5">
    <div class="border-b border-zinc-100 px-5 py-4 2xl:px-7 2xl:py-5">
        <h2 class="text-lg font-semibold text-zinc-950 2xl:text-xl">Histori Terbaru</h2>
        <p class="mt-1 text-sm text-zinc-500">Pembacaan sensor terakhir dari ruangan.</p>
    </div>

    <div class="overflow-x-auto px-5 py-4 2xl:px-7">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-zinc-200 text-xs uppercase text-zinc-500">
                <tr>
                    <th class="py-3 pr-3">Waktu</th>
                    <th class="py-3 pr-3">Ruang</th>
                    <th class="py-3 text-right">Suhu</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100">
                @forelse ($recentReadings as $reading)
                    <tr>
                        <td class="py-3 pr-3 text-zinc-600">{{ $reading->recorded_at->format('H:i:s') }}</td>
                        <td class="py-3 pr-3 font-medium text-zinc-900">{{ $reading->room->name }}</td>
                        <td class="py-3 text-right font-semibold tabular-nums text-zinc-950">
                            {{ number_format((float) $reading->temperature, 1) }} C
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-8 text-center text-zinc-500">Belum ada histori suhu.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
