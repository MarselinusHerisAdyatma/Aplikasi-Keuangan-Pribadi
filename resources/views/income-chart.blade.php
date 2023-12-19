<!-- resources/views/income-chart.blade.php -->
@extends('dashboard.layout.master')

@section('title_content')
    <h6 class="m-0 font-weight-bold text-primary">Income Chart</h6>
@endsection

@section('content')
    <canvas id="incomeChart" width="400" height="200"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('incomeChart').getContext('2d');
        var incomeData = @json($incomeData);

        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: incomeData.dates,
                datasets: [{
                    label: 'Total Income',
                    data: incomeData.amounts,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
