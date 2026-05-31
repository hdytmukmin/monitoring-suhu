<header class="overflow-hidden rounded-[28px] bg-emerald-950 text-white shadow-2xl shadow-emerald-950/10">
    <div class="grid min-h-56 bg-[linear-gradient(110deg,#064e3b_0%,#047857_58%,#bbf7d0_100%)] px-7 py-8 lg:grid-cols-[1fr_auto] lg:items-end lg:gap-6">
    <div>
        <p class="text-sm font-semibold uppercase tracking-[0.22em] text-emerald-100">Laravel + Arduino Uno</p>
        <h1 class="mt-4 text-4xl font-bold tracking-tight text-white sm:text-5xl">Monitoring Suhu Ruangan</h1>
        <p class="mt-3 max-w-2xl text-base text-emerald-50">Pantau suhu, kelembapan, status ruangan, dan histori sensor secara real-time dari satu dashboard.</p>
    </div>

    <div class="mt-6 rounded-3xl border border-white/20 bg-white/15 p-4 shadow-sm backdrop-blur lg:mt-0">
        @include('dashboard.partials.filters')
    </div>
    </div>
</header>
