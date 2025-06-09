@extends('layouts.dashboardAdmin')

@section('content')
<div class="container-fluid" style="background: #f4f6fa; min-height:100vh;">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 p-0" style="background: #22314e; min-height:100vh;">
            <div class="text-center py-4">
                <div style="background:#fff; border-radius:50%; width:70px; height:70px; margin:auto;">
                    <i class="fa fa-user" style="font-size:40px; color:#22314e; line-height:70px;"></i>
                </div>
                <div class="mt-3" style="color:#fff; font-weight:bold;">Admin</div>
                <div style="color:#b0b8c1; font-size:13px;">Selamat Datang</div>
            </div>
            <ul class="nav flex-column mt-4">
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('homepage') }}"><i class="fa fa-home"></i> Home</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fa fa-file"></i> Kambing</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fa fa-envelope"></i> Pemasok</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fa fa-bell"></i> Customer</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fa fa-map-marker"></i> Transaksi</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('goat.diagnose') }}"><i class="fa fa-map-marker"></i> Deteksi Penyakit</a></li>
            </ul>
        </div>
        <!-- Main Content -->
        <div class="col-md-10">
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="card text-white" style="background:#22314e;">
                        <div class="card-body">
                            <div>Earning</div>
                            <div style="font-size:28px; font-weight:bold;">$ 628</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div>Share <i class="fa fa-share-square-o"></i></div>
                            <div style="font-size:28px; font-weight:bold;">2434</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div>Likes <i class="fa fa-thumbs-up"></i></div>
                            <div style="font-size:28px; font-weight:bold;">1259</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div>Rating <i class="fa fa-star" style="color:orange;"></i></div>
                            <div style="font-size:28px; font-weight:bold;">8,5</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Charts Section -->
            <div class="row mt-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>Result</div>
                                <button class="btn btn-warning btn-sm">Check Now</button>
                            </div>
                            <!-- Contoh Chart (gunakan Chart.js atau gambar statis) -->
                            <canvas id="barChart" height="120"></canvas>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="d-flex">
                                <div>
                                    <span style="background:#f6c23e; width:10px; height:10px; display:inline-block; border-radius:2px;"></span> Lorem Ipsum
                                    <span style="background:#22314e; width:10px; height:10px; display:inline-block; border-radius:2px; margin-left:10px;"></span> Dolor Amet
                                </div>
                            </div>
                            <!-- Contoh Area Chart -->
                            <canvas id="areaChart" height="80"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body text-center">
                            <!-- Donut Chart -->
                            <canvas id="donutChart" width="120" height="120"></canvas>
                            <div style="font-size:28px; font-weight:bold; margin-top:-80px;">45%</div>
                            <div class="mt-4">
                                <div>Lorem ipsum</div>
                                <div>Lorem ipsum</div>
                                <div>Lorem ipsum</div>
                                <div>Lorem ipsum</div>
                            </div>
                            <button class="btn btn-warning mt-2">Check Now</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <!-- Calendar Placeholder -->
                            <div class="calendar-placeholder" style="height:100px; background:#f4f6fa; border-radius:8px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Bar Chart
    var ctx = document.getElementById('barChart').getContext('2d');
    var barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUNE', 'JULY', 'AUG', 'SEP'],
            datasets: [
                {
                    label: '2019',
                    backgroundColor: '#22314e',
                    data: [12, 19, 3, 5, 21, 19, 7, 8, 9]
                },
                {
                    label: '2020',
                    backgroundColor: '#f6c23e',
                    data: [8, 11, 7, 10, 15, 12, 6, 7, 8]
                }
            ]
        },
        options: {
            responsive: true,
            legend: { display: false }
        }
    });

    // Area Chart
    var ctx2 = document.getElementById('areaChart').getContext('2d');
    var areaChart = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUNE', 'JULY', 'AUG', 'SEP'],
            datasets: [
                {
                    label: 'Lorem Ipsum',
                    backgroundColor: 'rgba(246,194,62,0.3)',
                    borderColor: '#f6c23e',
                    data: [10, 15, 7, 12, 18, 14, 10, 12, 13],
                    fill: true
                },
                {
                    label: 'Dolor Amet',
                    backgroundColor: 'rgba(34,49,78,0.3)',
                    borderColor: '#22314e',
                    data: [8, 12, 6, 10, 15, 11, 8, 10, 11],
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            legend: { display: false }
        }
    });

    // Donut Chart
    var ctx3 = document.getElementById('donutChart').getContext('2d');
    var donutChart = new Chart(ctx3, {
        type: 'doughnut',
        data: {
            labels: ['Complete', 'Remaining'],
            datasets: [{
                data: [45, 55],
                backgroundColor: ['#22314e', '#f6c23e'],
                borderWidth: 0
            }]
        },
        options: {
            cutout: '75%',
            responsive: false,
            legend: { display: false },
            tooltips: { enabled: false }
        }
    });
</script>
@endsection
