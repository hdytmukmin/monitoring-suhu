@extends('admin.layouts.app')

@section('title', 'Histori Suhu')
@section('page-title', 'Histori Suhu')
@section('page-eyebrow', 'Monitoring')

@section('content')
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @include('admin.readings.partials.stat-card', [
            'label' => 'Total Data',
            'value' => number_format($stats['count']),
        ])
        @include('admin.readings.partials.stat-card', [
            'label' => 'Minimum',
            'value' => $stats['min'] !== null ? number_format((float) $stats['min'], 1).' C' : '-',
        ])
        @include('admin.readings.partials.stat-card', [
            'label' => 'Maksimum',
            'value' => $stats['max'] !== null ? number_format((float) $stats['max'], 1).' C' : '-',
        ])
        @include('admin.readings.partials.stat-card', [
            'label' => 'Rata-rata',
            'value' => $stats['avg'] !== null ? number_format((float) $stats['avg'], 1).' C' : '-',
        ])
    </div>

    <div class="mt-6 rounded-lg border border-zinc-200 bg-white shadow-sm">
        <div class="border-b border-zinc-200 px-5 py-4">
            <h2 class="text-base font-semibold text-zinc-950">Filter Histori</h2>
            <p class="mt-1 text-sm text-zinc-500">Gunakan filter untuk melihat data suhu berdasarkan ruangan, device, status, dan tanggal.</p>
        </div>

        @include('admin.readings.partials.filters')
    </div>

    <div class="mt-6 rounded-lg border border-zinc-200 bg-white shadow-sm">
        <div class="border-b border-zinc-200 px-5 py-4">
            <h2 class="text-base font-semibold text-zinc-950">Data Sensor</h2>
            <p class="mt-1 text-sm text-zinc-500">Daftar pembacaan suhu terbaru sesuai filter.</p>
        </div>

        @include('admin.readings.partials.table')
    </div>
@endsection
