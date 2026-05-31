<script>
    const labels = @json($chartLabels);
    const values = @json($chartValues);
    const canvas = document.getElementById('temperatureChart');
    const ctx = canvas.getContext('2d');

    function drawChart() {
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

    drawChart();
    window.addEventListener('resize', drawChart);
</script>
