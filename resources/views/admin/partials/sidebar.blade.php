@php
    $menus = [
        ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'pattern' => 'admin', 'group' => 'Overview', 'icon' => 'gauge'],
        ['label' => 'Ruangan', 'route' => 'admin.rooms.index', 'pattern' => 'admin/rooms*', 'group' => 'Master Data', 'icon' => 'sensor'],
        ['label' => 'Device', 'route' => 'admin.devices.index', 'pattern' => 'admin/devices*', 'group' => 'Master Data', 'icon' => 'sensor'],
        ['label' => 'Histori Suhu', 'route' => 'admin.readings.index', 'pattern' => 'admin/readings*', 'group' => 'Monitoring', 'icon' => 'chart'],
        ['label' => 'Notifikasi', 'route' => 'admin.notifications.index', 'pattern' => 'admin/notifications*', 'group' => 'Monitoring', 'icon' => 'thermometer'],
        ['label' => 'Log Notifikasi', 'route' => 'admin.notification-logs.index', 'pattern' => 'admin/notification-logs*', 'group' => 'Monitoring', 'icon' => 'gauge'],
    ];

    $currentGroup = null;
@endphp

<aside
    id="adminSidebar"
    class="fixed inset-y-0 left-0 z-40 flex w-72 -translate-x-full flex-col border-r border-emerald-100 bg-white text-slate-900 shadow-xl shadow-emerald-950/10 transition-transform duration-200 lg:static lg:w-auto lg:translate-x-0 lg:shadow-none"
>
    <div class="flex h-[76px] items-center justify-between border-b border-emerald-100 px-8">
        <a href="{{ route('admin.dashboard') }}" class="flex min-w-0 items-center gap-3 rounded-md">
            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-[linear-gradient(135deg,#059669,#0ea5e9)] text-white shadow-sm shadow-emerald-200">
                @include('dashboard.partials.icon', ['name' => 'thermometer', 'class' => 'h-6 w-6'])
            </span>
            <span class="min-w-0">
                <span class="block truncate text-xl font-bold text-emerald-950">SuhuMon</span>
                <span class="block truncate text-xs font-semibold uppercase tracking-wide text-emerald-600">Admin Panel</span>
            </span>
        </a>

        <button
            type="button"
            id="adminSidebarClose"
            class="inline-flex h-9 w-9 items-center justify-center rounded-md text-slate-500 transition hover:bg-emerald-50 hover:text-emerald-900 lg:hidden"
            aria-label="Tutup menu admin"
        >
            <span class="text-xl leading-none">x</span>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto px-8 py-7">
        @foreach ($menus as $menu)
            @php
                $isActive = request()->is($menu['pattern']);
                $href = $menu['route'] ? route($menu['route']) : '#';
            @endphp

            @if ($currentGroup !== $menu['group'])
                @php $currentGroup = $menu['group']; @endphp
                <p class="px-1 pb-3 pt-5 text-xs font-bold uppercase tracking-wide text-emerald-800 first:pt-0">
                    {{ $currentGroup }}
                </p>
            @endif

            <a
                href="{{ $href }}"
                class="mb-3 flex items-center justify-between rounded-2xl border px-4 py-3 text-base font-bold transition {{ $isActive ? 'border-emerald-700 bg-emerald-700 text-white shadow-lg shadow-emerald-100' : 'border-emerald-100 bg-white text-slate-600 hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-900' }}"
            >
                <span class="flex min-w-0 items-center gap-3">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg {{ $isActive ? 'bg-white/15 text-white' : 'bg-emerald-50 text-emerald-700' }}">
                        @include('dashboard.partials.icon', ['name' => $menu['icon'], 'class' => 'h-4 w-4'])
                    </span>
                    <span class="truncate">{{ $menu['label'] }}</span>
                </span>
                @if ($isActive)
                    <span class="h-2 w-2 rounded-full bg-white"></span>
                @endif
            </a>
        @endforeach
    </nav>

    <div class="border-t border-emerald-100 p-6">
        <a
            href="{{ route('dashboard') }}"
            class="flex items-center justify-between rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-sm font-bold text-emerald-800 transition hover:border-emerald-200 hover:bg-white"
        >
            <span class="flex items-center gap-2">
                @include('dashboard.partials.icon', ['name' => 'chart', 'class' => 'h-4 w-4'])
                Lihat Dashboard
            </span>
            <span aria-hidden="true">-&gt;</span>
        </a>
    </div>
</aside>
