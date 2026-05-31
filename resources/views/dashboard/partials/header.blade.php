<header class="overflow-hidden rounded-[28px] bg-emerald-950 text-white shadow-2xl shadow-emerald-950/10 2xl:rounded-[32px]">
    <div class="grid min-h-56 bg-[linear-gradient(110deg,#064e3b_0%,#047857_58%,#bbf7d0_100%)] px-6 py-8 sm:px-8 lg:grid-cols-[minmax(0,1fr)_minmax(420px,620px)] lg:items-end lg:gap-8 xl:min-h-64 xl:px-10 2xl:min-h-72 2xl:grid-cols-[minmax(0,1fr)_680px] 2xl:px-12 2xl:py-12">
    <div class="max-w-5xl">
        <p class="text-sm font-semibold uppercase tracking-[0.22em] text-emerald-100 2xl:text-base">Laravel + Arduino Uno</p>
        <h1 class="mt-4 text-4xl font-bold tracking-tight text-white sm:text-5xl xl:text-6xl 2xl:text-7xl">Monitoring Suhu Ruangan</h1>
        <p class="mt-3 max-w-4xl text-base leading-7 text-emerald-50 xl:text-lg 2xl:text-xl">Pantau suhu, kelembapan, status ruangan, dan histori sensor secara real-time dari satu dashboard.</p>
    </div>

    <div class="mt-6 rounded-3xl border border-white/20 bg-white/15 p-4 shadow-sm backdrop-blur lg:mt-0 2xl:p-5">
        @include('dashboard.partials.filters')
    </div>
    </div>
</header>
