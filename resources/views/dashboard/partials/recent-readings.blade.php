<div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
    <h2 class="text-lg font-semibold">Histori Terbaru</h2>
    <div class="mt-4 overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-zinc-200 text-xs uppercase text-zinc-500">
                <tr>
                    <th class="py-2 pr-3">Waktu</th>
                    <th class="py-2 pr-3">Ruang</th>
                    <th class="py-2 text-right">Suhu</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100">
                @forelse ($recentReadings as $reading)
                    <tr>
                        <td class="py-2 pr-3 text-zinc-600">{{ $reading->recorded_at->format('H:i:s') }}</td>
                        <td class="py-2 pr-3">{{ $reading->room->name }}</td>
                        <td class="py-2 text-right font-medium tabular-nums">
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
