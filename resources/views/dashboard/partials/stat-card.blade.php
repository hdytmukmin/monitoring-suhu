@php
    $toneClass = match ($tone ?? 'teal') {
        'sky' => 'border-sky-200 bg-sky-50 text-sky-700',
        'red' => 'border-red-200 bg-red-50 text-red-700',
        'amber' => 'border-amber-200 bg-amber-50 text-amber-700',
        default => 'border-teal-200 bg-teal-50 text-teal-700',
    };
@endphp

<div class="rounded-[22px] border bg-white p-5 shadow-xl shadow-emerald-950/5 xl:p-6 2xl:p-8 {{ $toneClass }}">
    <p class="text-sm font-medium opacity-80 2xl:text-base">{{ $label }}</p>
    <p class="mt-2 text-3xl font-semibold tabular-nums text-zinc-950 xl:text-4xl 2xl:text-5xl">{{ $value }}</p>
</div>
