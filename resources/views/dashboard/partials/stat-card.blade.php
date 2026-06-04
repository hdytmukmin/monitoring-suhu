@php
    $toneClass = match ($tone ?? 'teal') {
        'sky' => 'border-sky-200 bg-sky-50 text-sky-700',
        'red' => 'border-red-200 bg-red-50 text-red-700',
        'amber' => 'border-amber-200 bg-amber-50 text-amber-700',
        default => 'border-teal-200 bg-teal-50 text-teal-700',
    };
    $iconClass = match ($tone ?? 'teal') {
        'sky' => 'bg-sky-100 text-sky-700',
        'red' => 'bg-red-100 text-red-700',
        'amber' => 'bg-amber-100 text-amber-700',
        default => 'bg-teal-100 text-teal-700',
    };
    $iconName = match ($tone ?? 'teal') {
        'sky' => 'thermometer',
        'red' => 'gauge',
        'amber' => 'chart',
        default => 'sensor',
    };
@endphp

<div class="rounded-[22px] border bg-white p-5 shadow-xl shadow-emerald-950/5 xl:p-6 2xl:p-8 {{ $toneClass }}">
    <div class="flex items-center justify-between gap-4">
        <p class="text-sm font-medium opacity-80 2xl:text-base">{{ $label }}</p>
        <div class="flex h-10 w-10 items-center justify-center rounded-2xl {{ $iconClass }}">
            @include('dashboard.partials.icon', ['name' => $iconName, 'class' => 'h-5 w-5'])
        </div>
    </div>
    <p @isset($valueId) id="{{ $valueId }}" @endisset class="mt-2 text-3xl font-semibold tabular-nums text-zinc-950 xl:text-4xl 2xl:text-5xl">{{ $value }}</p>
</div>
