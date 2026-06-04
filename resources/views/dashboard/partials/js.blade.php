<script>
    let labels = @json($chartLabels);
    let values = @json($chartValues);

    const dashboardDataUrl = @json(route('dashboard.data'));
    const canvas = document.getElementById('temperatureChart');
    const ctx = canvas?.getContext('2d');

    const statusCardClasses = {
        normal: 'border-emerald-200 bg-emerald-50 text-emerald-800 shadow-emerald-100/70',
        warning: 'border-amber-200 bg-amber-50 text-amber-800 shadow-amber-100/70',
        danger: 'border-red-200 bg-red-50 text-red-800 shadow-red-100/70',
    };

    const statusIconClasses = {
        normal: 'bg-emerald-100 text-emerald-700',
        warning: 'bg-amber-100 text-amber-700',
        danger: 'bg-red-100 text-red-700',
    };

    function escapeHtml(value) {
        return String(value ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function readingTone(status) {
        return {
            danger: 'border-red-100 bg-red-50 text-red-700',
            warning: 'border-amber-100 bg-amber-50 text-amber-700',
            normal: 'border-emerald-100 bg-emerald-50 text-emerald-700',
        }[status] ?? 'border-emerald-100 bg-emerald-50 text-emerald-700';
    }

    function drawChart() {
        if (!canvas || !ctx) {
            return;
        }

        const ratio = window.devicePixelRatio || 1;
        const width = canvas.clientWidth;
        const height = canvas.clientHeight;
        canvas.width = width * ratio;
        canvas.height = height * ratio;
        ctx.scale(ratio, ratio);
        ctx.clearRect(0, 0, width, height);

        const padding = { top: 20, right: 20, bottom: 36, left: 42 };
        const plotWidth = width - padding.left - padding.right;
        const plotHeight = height - padding.top - padding.bottom;
        const min = Math.min(...values, 20);
        const max = Math.max(...values, 40);
        const spread = Math.max(max - min, 1);

        ctx.strokeStyle = '#e4e4e7';
        ctx.lineWidth = 1;
        ctx.font = '12px sans-serif';
        ctx.fillStyle = '#71717a';

        for (let i = 0; i <= 4; i++) {
            const y = padding.top + (plotHeight / 4) * i;
            const label = (max - (spread / 4) * i).toFixed(1);
            ctx.beginPath();
            ctx.moveTo(padding.left, y);
            ctx.lineTo(width - padding.right, y);
            ctx.stroke();
            ctx.fillText(label, 4, y + 4);
        }

        if (values.length === 0) {
            ctx.fillText('Belum ada data untuk periode ini.', padding.left, padding.top + 24);
            return;
        }

        ctx.strokeStyle = '#0f766e';
        ctx.lineWidth = 2;
        ctx.beginPath();
        values.forEach((value, index) => {
            const x = padding.left + (values.length === 1 ? 0 : (plotWidth / (values.length - 1)) * index);
            const y = padding.top + plotHeight - (((value - min) / spread) * plotHeight);
            index === 0 ? ctx.moveTo(x, y) : ctx.lineTo(x, y);
        });
        ctx.stroke();

        ctx.fillStyle = '#0f766e';
        values.forEach((value, index) => {
            const x = padding.left + (values.length === 1 ? 0 : (plotWidth / (values.length - 1)) * index);
            const y = padding.top + plotHeight - (((value - min) / spread) * plotHeight);
            ctx.beginPath();
            ctx.arc(x, y, 3, 0, Math.PI * 2);
            ctx.fill();
        });

        ctx.fillStyle = '#71717a';
        if (labels.length > 0) {
            ctx.fillText(labels[0], padding.left, height - 10);
            ctx.fillText(labels[labels.length - 1], width - padding.right - 36, height - 10);
        }
    }

    function updateText(id, value) {
        const element = document.getElementById(id);

        if (element) {
            element.textContent = value;
        }
    }

    function updateStatusClasses(status) {
        const card = document.getElementById('latestStatusCard');
        const icon = document.getElementById('latestStatusIcon');

        if (card) {
            card.className = `rounded-[22px] border p-5 shadow-xl xl:p-6 2xl:p-8 ${statusCardClasses[status] ?? statusCardClasses.normal}`;
        }

        if (icon) {
            icon.className = `flex h-11 w-11 items-center justify-center rounded-2xl ${statusIconClasses[status] ?? statusIconClasses.normal}`;
        }
    }

    function renderRecentReadings(readings) {
        const body = document.getElementById('recentReadingsBody');

        if (!body) {
            return;
        }

        if (!readings.length) {
            body.innerHTML = `
                <tr>
                    <td colspan="3" class="py-10 text-center">
                        <div class="mx-auto flex max-w-xs flex-col items-center gap-3 text-zinc-500">
                            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-700">SN</span>
                            <span>Belum ada histori suhu.</span>
                        </div>
                    </td>
                </tr>
            `;
            return;
        }

        body.innerHTML = readings.map((reading) => `
            <tr class="group">
                <td class="rounded-l-2xl border-y border-l border-zinc-100 bg-white px-3 py-3 text-zinc-600 shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                    ${escapeHtml(reading.time)}
                </td>
                <td class="border-y border-zinc-100 bg-white px-3 py-3 font-medium text-zinc-900 shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                    ${escapeHtml(reading.room)}
                </td>
                <td class="rounded-r-2xl border-y border-r border-zinc-100 bg-white px-3 py-3 text-right shadow-sm transition group-hover:border-emerald-100 group-hover:bg-emerald-50/40">
                    <span class="inline-flex items-center rounded-full border px-2.5 py-1 text-xs font-bold tabular-nums ${readingTone(reading.status)}">
                        ${escapeHtml(reading.temperature)}
                    </span>
                </td>
            </tr>
        `).join('');
    }

    async function refreshDashboard() {
        const url = new URL(dashboardDataUrl, window.location.origin);
        const currentParams = new URLSearchParams(window.location.search);
        currentParams.forEach((value, key) => url.searchParams.set(key, value));

        try {
            const response = await fetch(url, {
                headers: { Accept: 'application/json' },
            });

            if (!response.ok) {
                return;
            }

            const payload = await response.json();
            const latest = payload.latest;

            updateText('latestTemperature', latest.temperature);
            updateText('latestHumidity', latest.humidity);
            updateText('latestRoom', latest.room);
            updateText('latestDevice', latest.device ? ` / ${latest.device}` : '');
            updateText('latestRecordedAt', latest.recorded_at);
            updateText('latestStatusLabel', latest.status.label);
            updateText('statMin', payload.stats.min);
            updateText('statMax', payload.stats.max);
            updateText('statAvg', payload.stats.avg);
            updateStatusClasses(latest.status.value);

            labels = payload.chart.labels;
            values = payload.chart.values;
            renderRecentReadings(payload.recent_readings);
            drawChart();
        } catch (error) {
            console.warn('Dashboard refresh gagal.', error);
        }
    }

    drawChart();
    window.addEventListener('resize', drawChart);
    window.setInterval(refreshDashboard, 30000);
</script>
