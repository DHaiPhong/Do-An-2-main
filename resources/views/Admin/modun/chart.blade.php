<div style="margin-left: 1rem">
    <label for="">Chọn tháng:</label>
    <form method="GET" action="{{ route('revenue.chart') }}">
        <select name="month" onchange="this.form.submit()">
            @for ($i = 1; $i <= 12; $i++)
                <option style="display: none" value="">Chọn</option>
                <option value="{{ $i }}" {{ request()->get('month') == $i ? 'selected' : '' }}>
                    Tháng {{ $i }}
                </option>
            @endfor
        </select>
    </form>
    <canvas id="revenueChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctx = document.getElementById('revenueChart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json(array_keys($revenuesForEachDay)), // Biểu đồ sẽ hiển thị ngày.
            datasets: [{
                label: 'Doanh thu tháng ' + {{ $month }},
                data: @json(array_values($revenuesForEachDay)), // Biểu đồ sẽ hiển thị doanh thu.
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { // Sẽ chứa giá trị doanh thu.
                    beginAtZero: true
                },
                x: { // Sẽ chứa ngày.
                    beginAtZero: true
                }
            }
        }
    });
</script>
