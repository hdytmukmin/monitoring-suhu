<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')

    <title>@yield('title', config('app.name'))</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('dashboard.partials.css')
    @stack('styles')
</head>
<body class="dashboard-shell text-zinc-950 antialiased">
    @yield('content')

    @stack('scripts')
</body>
</html>
