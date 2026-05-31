@php
    $menus = [
        ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'pattern' => 'admin'],
        ['label' => 'Ruangan', 'route' => 'admin.rooms.index', 'pattern' => 'admin/rooms*'],
        ['label' => 'Device', 'route' => 'admin.devices.index', 'pattern' => 'admin/devices*'],
        ['label' => 'Histori Suhu', 'route' => 'admin.readings.index', 'pattern' => 'admin/readings*'],
        ['label' => 'Notifikasi', 'route' => 'admin.notifications.index', 'pattern' => 'admin/notifications*'],
        ['label' => 'Log Notifikasi', 'route' => 'admin.notification-logs.index', 'pattern' => 'admin/notification-logs*'],
    ];
@endphp

<aside
    id="adminSidebar"
    class="fixed inset-y-0 left-0 z-40 flex w-72 -translate-x-full flex-col border-r border-zinc-200 bg-white shadow-xl transition-transform duration-200 lg:static lg:w-auto lg:translate-x-0 lg:shadow-none"
>
    <div class="flex h-16 items-center justify-between border-b border-zinc-200 px-5">
        <a href="{{ route('admin.dashboard') }}" class="flex min-w-0 items-center gap-3">
            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-zinc-950 text-sm font-semibold text-white">
                MS
            </span>
            <span class="min-w-0">
                <span class="block truncate text-sm font-semibold text-zinc-950">Monitoring Suhu</span>
                <span class="block truncate text-xs text-zinc-500">Admin Panel</span>
            </span>
        </a>

        <button
            type="button"
            id="adminSidebarClose"
            class="inline-flex h-9 w-9 items-center justify-center rounded-md text-zinc-500 hover:bg-zinc-100 hover:text-zinc-950 lg:hidden"
            aria-label="Tutup menu admin"
        >
            <span class="text-xl leading-none">x</span>
        </button>
    </div>

    <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-4">
        @foreach ($menus as $menu)
            @php
                $isActive = request()->is($menu['pattern']);
                $href = $menu['route'] ? route($menu['route']) : '#';
            @endphp

            <a
                href="{{ $href }}"
                class="flex items-center justify-between rounded-md px-3 py-2.5 text-sm font-medium transition {{ $isActive ? 'bg-zinc-950 text-white' : 'text-zinc-700 hover:bg-zinc-100 hover:text-zinc-950' }}"
            >
                <span>{{ $menu['label'] }}</span>
                @if ($isActive)
                    <span class="h-1.5 w-1.5 rounded-full bg-white"></span>
                @endif
            </a>
        @endforeach
    </nav>

    <div class="border-t border-zinc-200 p-4">
        <a
            href="{{ route('dashboard') }}"
            class="flex items-center justify-between rounded-md border border-zinc-200 px-3 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50 hover:text-zinc-950"
        >
            <span>Lihat Dashboard</span>
            <span aria-hidden="true">-&gt;</span>
        </a>
    </div>
</aside>
