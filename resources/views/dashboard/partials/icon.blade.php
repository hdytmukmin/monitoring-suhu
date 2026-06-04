@php
    $name = $name ?? 'thermometer';
    $class = $class ?? 'h-5 w-5';
@endphp

@switch($name)
    @case('droplet')
        <svg class="{{ $class }}" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M12 3.25S6.5 9.35 6.5 14.1A5.5 5.5 0 0 0 12 19.75a5.5 5.5 0 0 0 5.5-5.65C17.5 9.35 12 3.25 12 3.25Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
            <path d="M9.75 14.25c.2 1.25 1.1 2.1 2.35 2.25" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
        </svg>
        @break

    @case('sensor')
        <svg class="{{ $class }}" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <rect x="7" y="7" width="10" height="10" rx="2" stroke="currentColor" stroke-width="1.8"/>
            <path d="M10 3.75v2.1M14 3.75v2.1M10 18.15v2.1M14 18.15v2.1M3.75 10h2.1M3.75 14h2.1M18.15 10h2.1M18.15 14h2.1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            <path d="M10.25 12h3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
        </svg>
        @break

    @case('gauge')
        <svg class="{{ $class }}" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M4.5 15.75a7.5 7.5 0 1 1 15 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            <path d="m12 15 3.75-4.25" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            <path d="M7.25 16.25h9.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
        </svg>
        @break

    @case('chart')
        <svg class="{{ $class }}" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M4.5 19.25V5.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            <path d="M4.5 19.25h15" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            <path d="m7.5 15 3.25-3.25 2.5 2.1 4-5.1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        @break

    @default
        <svg class="{{ $class }}" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M12 4.25a3 3 0 0 0-3 3v5.35a5 5 0 1 0 6 0V7.25a3 3 0 0 0-3-3Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
            <path d="M12 8.25v7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            <path d="M12 17.25h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
        </svg>
@endswitch
