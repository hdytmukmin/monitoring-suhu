@extends('dashboard.layouts.app')

@section('title', 'Monitoring Suhu Ruangan')

@section('meta')
    <meta http-equiv="refresh" content="30">
@endsection

@section('content')
    <main class="mx-auto flex min-h-screen w-full max-w-7xl flex-col gap-6 px-4 py-6 sm:px-6 lg:px-8">
        @include('dashboard.partials.header')
        @include('dashboard.partials.latest-cards')
        @include('dashboard.partials.summary-cards')

        <section class="grid gap-6 lg:grid-cols-[1fr_420px]">
            @include('dashboard.partials.temperature-chart')
            @include('dashboard.partials.recent-readings')
        </section>
    </main>
@endsection

@push('scripts')
    @include('dashboard.partials.js')
@endpush
