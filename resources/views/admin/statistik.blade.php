<h2>📊 Statistik Penyakit</h2>

<canvas id="chartPenyakit"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('chartPenyakit');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($chartLabels) !!},
        datasets: [{
            label: 'Jumlah Kasus',
            data: {!! json_encode($chartData) !!}
        }]
    }
});
</script>