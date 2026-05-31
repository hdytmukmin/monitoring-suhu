<div class="overflow-hidden rounded-[22px] border border-emerald-100 bg-white shadow-xl shadow-emerald-950/5">
    <div class="flex items-center justify-between gap-4 border-b border-emerald-100 bg-emerald-50 px-5 py-4 2xl:px-7 2xl:py-5">
        <h2 class="text-lg font-semibold text-teal-950 2xl:text-xl">Grafik Suhu Harian</h2>
        <p class="rounded-full bg-white px-3 py-1 text-sm font-bold text-emerald-700 2xl:px-4 2xl:py-1.5">{{ $selectedDate->format('d M Y') }}</p>
    </div>

    <div class="p-5 2xl:p-7">
        <canvas id="temperatureChart" class="h-80 w-full xl:h-[460px] 2xl:h-[600px]"></canvas>
    </div>
</div>
