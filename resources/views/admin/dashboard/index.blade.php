@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')
@section('page-eyebrow', 'Admin')

@section('content')
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-zinc-500">Total Ruangan</p>
            <p class="mt-2 text-3xl font-semibold tabular-nums">0</p>
        </div>

        <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-zinc-500">Device Aktif</p>
            <p class="mt-2 text-3xl font-semibold tabular-nums">0</p>
        </div>

        <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-zinc-500">Reading Hari Ini</p>
            <p class="mt-2 text-3xl font-semibold tabular-nums">0</p>
        </div>

        <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-zinc-500">Alert Pending</p>
            <p class="mt-2 text-3xl font-semibold tabular-nums">0</p>
        </div>
    </div>

    <div class="mt-6 rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
        <h2 class="text-lg font-semibold text-zinc-950">Ringkasan Sistem</h2>
        <div class="mt-4 grid gap-3 text-sm text-zinc-600 md:grid-cols-3">
            <div class="rounded-md bg-zinc-50 p-4">
                <p class="font-medium text-zinc-950">Monitoring</p>
                <p class="mt-1">Dashboard publik dan API sensor sudah tersedia.</p>
            </div>
            <div class="rounded-md bg-zinc-50 p-4">
                <p class="font-medium text-zinc-950">Konfigurasi</p>
                <p class="mt-1">Menu ruangan, device, dan notifikasi siap diisi bertahap.</p>
            </div>
            <div class="rounded-md bg-zinc-50 p-4">
                <p class="font-medium text-zinc-950">Keamanan</p>
                <p class="mt-1">Auth admin akan dipasang sebelum CRUD data aktif.</p>
            </div>
        </div>
    </div>
@endsection
