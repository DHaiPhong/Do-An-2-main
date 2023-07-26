<div style="margin-left: 1rem">
    <h4 class="card-title">Danh Thu Theo Năm</h4>
    <br>
    <label for="">Chọn năm:</label>
    <form method="GET" action="{{ route('revenue.chartYear') }}">
        <select name="year" onchange="this.form.submit()">
            @for ($i = 2000; $i <= date('Y'); $i++)
                <option style="display: none" value="">Chọn</option>
                <option value="{{ $i }}" {{ request()->get('year') == $i ? 'selected' : '' }}>
                    Năm {{ $i }}
                </option>
            @endfor
        </select>
    </form>
    <canvas id="revenueChartYear"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctx = document.getElementById('revenueChartYear');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json(array_keys($revenuesForEachMonth)), // Biểu đồ sẽ hiển thị ngày.
            datasets: [{
                label: 'Doanh thu năm ' + {{ $year_chart }},
                data: @json(array_values($revenuesForEachMonth)), // Biểu đồ sẽ hiển thị doanh thu.
            }]
        },
        options: {
            scales: {
                y: { // Sẽ chứa giá trị doanh thu.
                    beginAtZero: true
                },
                x: { // Sẽ chứa tháng.
                    beginAtZero: true
                }
            }
        }
    });
</script>
