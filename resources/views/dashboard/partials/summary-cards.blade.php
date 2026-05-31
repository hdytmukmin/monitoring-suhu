<section class="grid gap-4 lg:grid-cols-3">
    @include('dashboard.partials.stat-card', [
        'label' => 'Minimum hari ini',
        'value' => $stats['min'] !== null ? number_format((float) $stats['min'], 1).' C' : '-',
    ])

    @include('dashboard.partials.stat-card', [
        'label' => 'Maksimum hari ini',
        'value' => $stats['max'] !== null ? number_format((float) $stats['max'], 1).' C' : '-',
    ])

    @include('dashboard.partials.stat-card', [
        'label' => 'Rata-rata hari ini',
        'value' => $stats['avg'] !== null ? number_format((float) $stats['avg'], 1).' C' : '-',
    ])
</section>
