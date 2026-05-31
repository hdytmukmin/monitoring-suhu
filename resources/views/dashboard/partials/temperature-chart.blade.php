<div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
    <div class="flex items-center justify-between gap-4">
        <h2 class="text-lg font-semibold">Grafik Suhu Harian</h2>
        <p class="text-sm text-zinc-500">{{ $selectedDate->format('d M Y') }}</p>
    </div>

    <canvas id="temperatureChart" class="mt-6 h-80 w-full"></canvas>
</div>
