<div class="overflow-x-auto">
    <table class="w-full text-left text-sm">
        <thead class="border-b border-zinc-200 bg-zinc-50 text-xs uppercase text-zinc-500">
            <tr>
                <th class="px-5 py-3">Waktu</th>
                <th class="px-5 py-3">Ruangan</th>
                <th class="px-5 py-3">Channel</th>
                <th class="px-5 py-3">Recipient</th>
                <th class="px-5 py-3 text-right">Suhu</th>
                <th class="px-5 py-3 text-center">Status</th>
                <th class="px-5 py-3">Error</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-zinc-100">
            @forelse ($logs as $log)
                @php
                    $statusClass = match ($log->status) {
                        'sent' => 'bg-emerald-50 text-emerald-700',
                        'failed' => 'bg-red-50 text-red-700',
                        default => 'bg-amber-50 text-amber-700',
                    };
                @endphp

                <tr>
                    <td class="px-5 py-4 text-zinc-600">
                        <p>{{ $log->created_at->format('d M Y H:i:s') }}</p>
                        @if ($log->sent_at)
                            <p class="mt-1 text-xs text-zinc-500">Sent: {{ $log->sent_at->format('H:i:s') }}</p>
                        @endif
                    </td>
                    <td class="px-5 py-4">{{ $log->room?->name ?? '-' }}</td>
                    <td class="px-5 py-4 capitalize text-zinc-600">{{ $log->channel }}</td>
                    <td class="px-5 py-4 text-zinc-600">{{ $log->recipient }}</td>
                    <td class="px-5 py-4 text-right font-medium tabular-nums">
                        {{ $log->reading ? number_format((float) $log->reading->temperature, 1).' C' : '-' }}
                    </td>
                    <td class="px-5 py-4 text-center">
                        <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $statusClass }}">
                            {{ ucfirst($log->status) }}
                        </span>
                    </td>
                    <td class="max-w-xs px-5 py-4 text-zinc-600">
                        <p class="truncate" title="{{ $log->error_message }}">
                            {{ $log->error_message ?: '-' }}
                        </p>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-5 py-10 text-center text-zinc-500">
                        Belum ada log notifikasi untuk filter ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if ($logs->hasPages())
    <div class="border-t border-zinc-200 px-5 py-4">
        {{ $logs->links() }}
    </div>
@endif
