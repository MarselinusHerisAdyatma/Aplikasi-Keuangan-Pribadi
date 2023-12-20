<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Catatan Keuangan</title>

    <!-- Custom fonts for this template -->
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('dashboard.layout.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('dashboard.layout.navbar')
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>
                    @if(session('status'))
                    <div class="alert alert-info" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row">
                        <!-- Total Saldo -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Saldo</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalSaldo"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-info fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Total Pemasukan -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Pemasukan</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalPemasukan"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Total Pengeluaran -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Total Pengeluaran</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalPengeluaran"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Include jQuery -->
                        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

                        <script>
                            // Update the total values when new pemasukan or pengeluaran is added
                            function updateTotalValues() {
                                $.ajax({
                                    url: '/get-updated-totals', // Updated route
                                    method: 'GET',
                                    success: function (data) {
                                        $('#totalSaldo').html('Rp. ' + data.saldo);
                                        $('#totalPemasukan').html('Rp. ' + data.totalPemasukan);
                                        $('#totalPengeluaran').html('Rp. ' + data.totalPengeluaran);
                                    },
                                    error: function (error) {
                                        console.error('Error updating totals:', error);
                                    }
                                });
                            }
                            // Call the updateTotalValues function when new pemasukan or pengeluaran is added
                            // For example, call this function after a successful form submission
                            updateTotalValues();
                        </script>
                    </div>

                    <div class="row">
                        <!-- Include Income Chart Here -->
                        <div class="col-xl-6 col-lg-5">
                            <div class="card shadow mb-4">
                                <div class="chart-container">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Grafik Pemasukan</h6>
                                    </div>
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
                                                    label: 'Pemasukan',
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
                                </div>
                            </div>
                        </div>
                        <!-- End Income Chart -->
                        
                        <!-- Include Expense Chart Here -->
                        <div class="col-xl-6 col-lg-5">
                            <div class="card shadow mb-4">
                                <div class="chart-container">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Grafik Pengeluaran</h6>
                                    </div>
                                    <canvas id="expenseChart" width="400" height="200"></canvas>
                                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                    <script>
                                        var ctxExpense = document.getElementById('expenseChart').getContext('2d');
                                        var expenseData = @json($expenseData);

                                        var chartExpense = new Chart(ctxExpense, {
                                            type: 'line',
                                            data: {
                                                labels: expenseData.dates,
                                                datasets: [{
                                                    label: 'Pengeluaran',
                                                    data: expenseData.amounts,
                                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                                    borderColor: 'rgba(255, 99, 132, 1)',
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
                                </div>
                            </div>
                        </div>
                        <!-- End Expense Chart -->
                    </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Kelompok 4</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script>
        Highcharts.chart('chartpemasukanpengeluaran', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Pemasukan & Pengeluaran'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    colors: ['#1CC88A','#E74A3B'],
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Persentase',
        colorByPoint: true,
        data: [{
            name: 'Pemasukan',
            y: {{ $user->total_pemasukan }}
        }, {
            name: 'Pengeluaran',
            y: {{ $user->total_pengeluaran }}
        }]
    }]
});
Highcharts.chart('chartpengeluaran', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Grafik Pengeluaran by Kategori'
    },
    xAxis: {
        categories: {!! json_encode($kategori_pengeluaran) !!},
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Rupiah (Rp)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>Rp. {point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    colors: ['#E74A3B'],
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Pengeluaran',
        data: {!! json_encode($data_pengeluaran_by_kategori) !!}
    }]
});
Highcharts.chart('chartpemasukan', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Grafik Pemasukan by Kategori'
    },
    xAxis: {
        categories: {!! json_encode($kategori_pemasukan) !!},
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Rupiah (Rp)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>Rp. {point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    colors: ['#1CC88A'],
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Pemasukan',
        data: {!! json_encode($data_pemasukan_by_kategori) !!}
    }]
});
    </script>

</body>

</html>