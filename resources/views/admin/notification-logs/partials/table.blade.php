<div class="overflow-x-auto p-3">
    <table class="w-full min-w-[980px] border-separate border-spacing-y-2 text-left text-sm">
        <thead class="text-xs uppercase text-zinc-500">
            <tr>
                <th class="px-4 py-2">Waktu</th>
                <th class="px-4 py-2">Ruangan</th>
                <th class="px-4 py-2">Channel</th>
                <th class="px-4 py-2">Recipient</th>
                <th class="px-4 py-2 text-right">Suhu</th>
                <th class="px-4 py-2 text-center">Status</th>
                <th class="px-4 py-2">Error</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($logs as $log)
                @php
                    $statusClass = match ($log->status) {
                        'sent' => 'border-emerald-100 bg-emerald-50 text-emerald-700',
                        'failed' => 'border-red-100 bg-red-50 text-red-700',
                        default => 'border-amber-100 bg-amber-50 text-amber-700',
                    };
                    $rowAccent = match ($log->status) {
                        'sent' => 'before:bg-emerald-500',
                        'failed' => 'before:bg-red-500',
                        default => 'before:bg-amber-500',
                    };
                @endphp

                <tr class="group relative {{ $rowAccent }} before:absolute before:left-0 before:top-2 before:h-[calc(100%-1rem)] before:w-1 before:rounded-full">
                    <td class="rounded-l-2xl border-y border-l border-zinc-100 bg-white px-4 py-4 text-zinc-600 shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                        <p>{{ $log->created_at->format('d M Y H:i:s') }}</p>
                        @if ($log->sent_at)
                            <p class="mt-1 text-xs text-zinc-500">Sent: {{ $log->sent_at->format('H:i:s') }}</p>
                        @endif
                    </td>
                    <td class="border-y border-zinc-100 bg-white px-4 py-4 font-semibold text-zinc-950 shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">{{ $log->room?->name ?? '-' }}</td>
                    <td class="border-y border-zinc-100 bg-white px-4 py-4 shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                        <span class="inline-flex rounded-full border border-sky-100 bg-sky-50 px-2.5 py-1 text-xs font-semibold capitalize text-sky-700">{{ $log->channel }}</span>
                    </td>
                    <td class="border-y border-zinc-100 bg-white px-4 py-4 text-zinc-600 shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">{{ $log->recipient }}</td>
                    <td class="border-y border-zinc-100 bg-white px-4 py-4 text-right shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-orange-100 bg-orange-50 px-2.5 py-1 text-xs font-bold tabular-nums text-orange-700">
                            @include('dashboard.partials.icon', ['name' => 'thermometer', 'class' => 'h-3.5 w-3.5'])
                            {{ $log->reading ? number_format((float) $log->reading->temperature, 1).' C' : '-' }}
                        </span>
                    </td>
                    <td class="border-y border-zinc-100 bg-white px-4 py-4 text-center shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                        <span class="inline-flex rounded-full border px-2.5 py-1 text-xs font-medium {{ $statusClass }}">
                            {{ ucfirst($log->status) }}
                        </span>
                    </td>
                    <td class="max-w-xs rounded-r-2xl border-y border-r border-zinc-100 bg-white px-4 py-4 text-zinc-600 shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                        <p class="truncate" title="{{ $log->error_message }}">
                            {{ $log->error_message ?: '-' }}
                        </p>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-5 py-12 text-center">
                        <div class="mx-auto flex max-w-sm flex-col items-center gap-3 text-zinc-500">
                            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-700">
                                @include('dashboard.partials.icon', ['name' => 'gauge', 'class' => 'h-6 w-6'])
                            </span>
                            <span>Belum ada log notifikasi untuk filter ini.</span>
                        </div>
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
