@extends('layouts.template')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Halo, apa kabar!!</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        Selamat datang di halaman utama.</p>
        <!-- Chart's container -->
        <canvas id="usersChart" width="400" height="200"></canvas>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('usersChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($usersPerDay->pluck('date')),
            datasets: [{
                label: 'User Registrations per Day',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: @json($usersPerDay->pluck('count')),
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
});
</script>

@endsection
