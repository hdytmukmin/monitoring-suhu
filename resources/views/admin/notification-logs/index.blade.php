@extends('admin.layouts.app')

@section('title', 'Log Notifikasi')
@section('page-title', 'Log Notifikasi')
@section('page-eyebrow', 'Monitoring')

@section('content')
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @include('admin.notification-logs.partials.stat-card', [
            'label' => 'Total Log',
            'value' => number_format($stats['total']),
        ])
        @include('admin.notification-logs.partials.stat-card', [
            'label' => 'Pending',
            'value' => number_format($stats['pending']),
        ])
        @include('admin.notification-logs.partials.stat-card', [
            'label' => 'Terkirim',
            'value' => number_format($stats['sent']),
        ])
        @include('admin.notification-logs.partials.stat-card', [
            'label' => 'Gagal',
            'value' => number_format($stats['failed']),
        ])
    </div>

    <div class="mt-6 rounded-lg border border-zinc-200 bg-white shadow-sm">
        <div class="border-b border-zinc-200 px-5 py-4">
            <h2 class="text-base font-semibold text-zinc-950">Filter Log</h2>
            <p class="mt-1 text-sm text-zinc-500">Pantau status pengiriman alert berdasarkan ruangan, channel, status, dan tanggal.</p>
        </div>

        @include('admin.notification-logs.partials.filters')
    </div>

    <div class="mt-6 rounded-lg border border-zinc-200 bg-white shadow-sm">
        <div class="border-b border-zinc-200 px-5 py-4">
            <h2 class="text-base font-semibold text-zinc-950">Riwayat Pengiriman</h2>
            <p class="mt-1 text-sm text-zinc-500">Daftar notifikasi yang dibuat oleh sistem ketika suhu melewati ambang batas.</p>
        </div>

        @include('admin.notification-logs.partials.table')
    </div>
@endsection
