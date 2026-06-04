<header class="overflow-hidden rounded-[28px] bg-emerald-950 text-white shadow-2xl shadow-emerald-950/10 2xl:rounded-[32px]">
    <div class="grid min-h-56 bg-[linear-gradient(110deg,#064e3b_0%,#047857_50%,#38bdf8_100%)] px-6 py-8 sm:px-8 lg:grid-cols-[minmax(0,1fr)_minmax(420px,620px)] lg:items-end lg:gap-8 xl:min-h-64 xl:px-10 2xl:min-h-72 2xl:grid-cols-[minmax(0,1fr)_680px] 2xl:px-12 2xl:py-12">
    <div class="max-w-5xl">
        <div class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm font-semibold uppercase tracking-[0.18em] text-emerald-50 shadow-sm backdrop-blur 2xl:text-base">
            @include('dashboard.partials.icon', ['name' => 'sensor', 'class' => 'h-4 w-4 text-cyan-100'])
            Laravel + Arduino Uno
        </div>
        <h1 class="mt-4 text-4xl font-bold tracking-tight text-white sm:text-5xl xl:text-6xl 2xl:text-7xl">Monitoring Suhu Ruangan</h1>
        <p class="mt-3 max-w-4xl text-base leading-7 text-emerald-50 xl:text-lg 2xl:text-xl">Pantau suhu, kelembapan, status ruangan, dan histori sensor secara real-time dari satu dashboard.</p>

        <div class="mt-6 grid gap-3 sm:grid-cols-3">
            <div class="inline-flex items-center gap-3 rounded-2xl border border-white/15 bg-white/10 px-4 py-3 text-sm font-medium text-white/90 backdrop-blur">
                @include('dashboard.partials.icon', ['name' => 'thermometer', 'class' => 'h-5 w-5 text-amber-200'])
                Sensor suhu aktif
            </div>
            <div class="inline-flex items-center gap-3 rounded-2xl border border-white/15 bg-white/10 px-4 py-3 text-sm font-medium text-white/90 backdrop-blur">
                @include('dashboard.partials.icon', ['name' => 'droplet', 'class' => 'h-5 w-5 text-sky-200'])
                Kelembapan ruangan
            </div>
            <div class="inline-flex items-center gap-3 rounded-2xl border border-white/15 bg-white/10 px-4 py-3 text-sm font-medium text-white/90 backdrop-blur">
                @include('dashboard.partials.icon', ['name' => 'gauge', 'class' => 'h-5 w-5 text-red-200'])
                Status ambang batas
            </div>
        </div>
    </div>

    <div class="mt-6 rounded-3xl border border-white/20 bg-white/15 p-4 shadow-sm backdrop-blur lg:mt-0 2xl:p-5">
        @include('dashboard.partials.filters')
    </div>
    </div>
</header>
