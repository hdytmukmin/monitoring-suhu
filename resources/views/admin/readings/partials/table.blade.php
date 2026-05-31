<div class="overflow-x-auto">
    <table class="w-full text-left text-sm">
        <thead class="border-b border-zinc-200 bg-zinc-50 text-xs uppercase text-zinc-500">
            <tr>
                <th class="px-5 py-3">Waktu</th>
                <th class="px-5 py-3">Ruangan</th>
                <th class="px-5 py-3">Device</th>
                <th class="px-5 py-3 text-right">Suhu</th>
                <th class="px-5 py-3 text-right">Humidity</th>
                <th class="px-5 py-3 text-center">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-zinc-100">
            @forelse ($readings as $reading)
                <tr>
                    <td class="px-5 py-4 text-zinc-600">{{ $reading->recorded_at->format('d M Y H:i:s') }}</td>
                    <td class="px-5 py-4">{{ $reading->room?->name ?? '-' }}</td>
                    <td class="px-5 py-4 text-zinc-600">{{ $reading->device?->name ?? '-' }}</td>
                    <td class="px-5 py-4 text-right font-medium tabular-nums">{{ number_format((float) $reading->temperature, 1) }} C</td>
                    <td class="px-5 py-4 text-right tabular-nums">{{ $reading->humidity !== null ? number_format((float) $reading->humidity, 1).'%' : '-' }}</td>
                    <td class="px-5 py-4 text-center">
                        @php
                            $statusClass = match ($reading->status->value) {
                                'danger' => 'bg-red-50 text-red-700',
                                'warning' => 'bg-amber-50 text-amber-700',
                                default => 'bg-emerald-50 text-emerald-700',
                            };
                        @endphp
                        <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $statusClass }}">
                            {{ $reading->status->label() }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-5 py-10 text-center text-zinc-500">
                        Belum ada histori suhu untuk filter ini.
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
