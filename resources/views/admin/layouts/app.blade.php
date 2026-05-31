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
<body class="admin-shell text-zinc-950 antialiased">
    <div id="adminSidebarBackdrop" class="fixed inset-0 z-30 hidden bg-zinc-950/35 backdrop-blur-sm lg:hidden"></div>

    <div class="min-h-screen lg:grid lg:grid-cols-[300px_1fr]">
        @include('admin.partials.sidebar')

        <div class="min-w-0">
            <header class="sticky top-0 z-20 border-b border-emerald-100 bg-white/90 shadow-sm shadow-emerald-100/50 backdrop-blur">
                <div class="flex h-[76px] items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
                    <button
                        type="button"
                        id="adminSidebarOpen"
                        class="inline-flex h-10 items-center justify-center rounded-xl border border-emerald-200 bg-white px-3 text-sm font-semibold text-emerald-800 shadow-sm transition hover:border-emerald-300 hover:bg-emerald-50 lg:hidden"
                        aria-label="Buka menu admin"
                    >
                        Menu
                    </button>

                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700">@yield('page-eyebrow', 'Admin')</p>
                        <h1 class="mt-0.5 truncate text-xl font-bold text-slate-900">@yield('page-title', 'Monitoring Suhu')</h1>
                    </div>

                    <div class="flex items-center gap-3">
                        @yield('page-actions')

                        <div class="hidden items-center gap-4 rounded-full border border-emerald-100 bg-white py-2 pl-4 pr-2 shadow-sm sm:flex">
                            <div class="relative">
                                <span class="absolute -right-1 -top-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white">!</span>
                                <span class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-50 text-lg text-emerald-700">B</span>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-emerald-950">Super Admin</p>
                                <p class="text-xs font-semibold uppercase text-slate-500">Monitoring</p>
                            </div>
                            <div class="flex h-11 w-11 items-center justify-center rounded-full border-2 border-slate-950 bg-white text-sm font-bold text-slate-950">
                                A
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="min-w-0 px-4 py-8 sm:px-6 lg:px-9">
                @if (session('success'))
                    <div class="mb-5 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800 shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-800 shadow-sm">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('device_token'))
                    <div class="mb-5 rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-900 shadow-sm">
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
