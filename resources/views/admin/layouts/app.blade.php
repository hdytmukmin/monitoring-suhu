<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Admin Monitoring Suhu')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('admin.partials.css')
    @stack('styles')
</head>
<body class="bg-zinc-50 text-zinc-950 antialiased">
    <div id="adminSidebarBackdrop" class="fixed inset-0 z-30 hidden bg-zinc-950/40 lg:hidden"></div>

    <div class="min-h-screen lg:grid lg:grid-cols-[280px_1fr]">
        @include('admin.partials.sidebar')

        <div class="min-w-0">
            <header class="sticky top-0 z-20 border-b border-zinc-200 bg-white/90 backdrop-blur">
                <div class="flex h-16 items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
                    <button
                        type="button"
                        id="adminSidebarOpen"
                        class="inline-flex h-10 items-center justify-center rounded-md border border-zinc-200 bg-white px-3 text-sm font-medium text-zinc-700 shadow-sm hover:bg-zinc-50 lg:hidden"
                        aria-label="Buka menu admin"
                    >
                        Menu
                    </button>

                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-medium uppercase tracking-wide text-zinc-500">@yield('page-eyebrow', 'Admin')</p>
                        <h1 class="truncate text-lg font-semibold text-zinc-950">@yield('page-title', 'Monitoring Suhu')</h1>
                    </div>

                    <div class="flex items-center gap-3">
                        @yield('page-actions')

                        <div class="hidden items-center gap-3 border-l border-zinc-200 pl-3 sm:flex">
                            <div class="text-right">
                                <p class="text-sm font-medium text-zinc-950">Admin</p>
                                <p class="text-xs text-zinc-500">Monitoring</p>
                            </div>
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-zinc-950 text-sm font-semibold text-white">
                                A
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="min-w-0 px-4 py-6 sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="mb-5 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-5 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-800">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('device_token'))
                    <div class="mb-5 rounded-md border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-900">
                        <p class="font-semibold">Token device baru. Simpan sekarang, token tidak akan ditampilkan ulang.</p>
                        <code class="mt-2 block break-all rounded bg-white px-3 py-2 text-xs text-zinc-950">{{ session('device_token') }}</code>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @include('admin.partials.js')
    @stack('scripts')
</body>
</html>
