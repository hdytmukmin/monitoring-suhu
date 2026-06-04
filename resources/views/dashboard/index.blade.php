@extends('dashboard.layouts.app')

@section('title', 'Monitoring Suhu Ruangan')

@section('content')
    <main class="flex min-h-screen w-full max-w-none flex-col gap-6 px-4 py-5 sm:px-6 lg:px-8 xl:px-10 2xl:gap-8 2xl:px-12 2xl:py-8">
        @include('dashboard.partials.header')
        @include('dashboard.partials.latest-cards')
        @include('dashboard.partials.summary-cards')

        <section class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_440px] 2xl:grid-cols-[minmax(0,1fr)_520px] 2xl:gap-8">
            @include('dashboard.partials.temperature-chart')
            @include('dashboard.partials.recent-readings')
        </section>
    </main>
@endsection

@push('scripts')
    @include('dashboard.partials.js')
@endpush
