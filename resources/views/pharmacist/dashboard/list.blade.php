<!-- File: resources/views/pharmacist/dashboard/list.blade.php -->
@extends('pharmacist.layouts.app')

@section('title', 'Pharmacy M.S')

@section('content')
    <!-- Display error if present -->
    @if (isset($error))
        <div class="alert alert-danger">{{ $error }}</div>
    @endif

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <h1 class="h3 mb-0 text-gray-800">Pharmacist Dashboard</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
        </a> -->
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="container-fluid py-4">
            <div class="row min-vh-80 h-100">
                <div class="col-12">
                    <div class="row">
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="">
                                                <i class="fas fa-dollar-sign fa-2x text-success"></i>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="icon icon-box-success">
                                                <span class="mdi mdi-arrow-top-right icon-item"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="text-muted font-weight-normal">Today's Sales</h5>
                                    <div class="d-flex align-items-center align-self-start">
                                        <h3 class="mb-0">@isset($todaySales){{ $todaySales }}@else 0 @endisset</h3>
                                    </div>
                                    <p>Number of Medicine sales made today.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="">
                                                <i class="fas fa-pills fa-2x text-warning"></i>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="icon icon-box-success">
                                                <span class="mdi mdi-arrow-top-right icon-item"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="text-muted font-weight-normal">Low-Stock Items</h5>
                                    <div class="d-flex align-items-center align-self-start">
                                        <h3 class="mb-0">@isset($lowStockItems){{ $lowStockItems }}@else 0 @endisset</h3>
                                    </div>
                                    <p>Stock packages that are in low supply.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="">
                                                <i class="fas fa-calendar-times fa-2x text-danger"></i>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="icon icon-box-danger">
                                                <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="text-muted font-weight-normal">Expiring Soon</h5>
                                    <div class="d-flex align-items-center align-self-start">
                                        <h3 class="mb-0">@isset($expiringSoon){{ $expiringSoon }}@else 0 @endisset</h3>
                                    </div>
                                    <p>Stock packages that are soon expiring.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="">
                                                <i class="fas fa-prescription-bottle-alt fa-2x text-info"></i>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="icon icon-box-success">
                                                <span class="mdi mdi-arrow-top-right icon-item"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="text-muted font-weight-normal">Total Stocks</h5>
                                    <div class="d-flex align-items-center align-self-start">
                                        <h3 class="mb-0">@isset($totalStocks){{ $totalStocks }}@else 0 @endisset</h3>
                                    </div>
                                    <p>The total number of stocks available.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <!-- Bar Chart -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Medicine Quantities</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Stock by Supplier</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="pieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small" id="pieLegend"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Line Chart Row -->
    <div class="row">
        <div class="col-xl-6 col-lg-6 mt-5">
            <div class="card shadow mb-4 mx-auto" style="margin-top: 20px;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Stock Expiry Timeline</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area" style="height: 400px;">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Bar Chart
            const barCtx = document.getElementById('barChart');
            if (barCtx) {
                new Chart(barCtx, {
                    type: 'bar',
                    data: {
                        labels: @json($barLabels),
                        datasets: [{
                            label: 'Quantity',
                            data: @json($barData),
                            backgroundColor: 'rgba(54, 162, 235, 0.7)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `${context.dataset.label}: ${context.raw}`;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { precision: 0 }
                            }
                        }
                    }
                });
            }

            // Pie Chart
            const pieCtx = document.getElementById('pieChart');
            if (pieCtx) {
                const pieColors = [
                    '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e',
                    '#e74a3b', '#6610f2', '#fd7e14', '#20c997'
                ];

                const pieChart = new Chart(pieCtx, {
                    type: 'pie',
                    data: {
                        labels: @json($pieLabels),
                        datasets: [{
                            data: @json($pieData),
                            backgroundColor: pieColors,
                            hoverBackgroundColor: pieColors.map(c => `${c}dd`),
                            hoverBorderColor: "rgba(234, 236, 244, 1)"
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.raw || 0;
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = Math.round((value / total) * 100);
                                        return `${label}: ${value} (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    }
                });

                // Generate legend
                const legendContainer = document.getElementById('pieLegend');
                if (legendContainer) {
                    pieChart.data.labels.forEach((label, i) => {
                        legendContainer.innerHTML += `
                            <span class="mr-3">
                                <i class="fas fa-circle" style="color:${pieColors[i]}"></i> ${label}
                            </span>
                        `;
                    });
                }
            }

            // Line Chart
            const lineCtx = document.getElementById('lineChart');
            if (lineCtx) {
                new Chart(lineCtx, {
                    type: 'line',
                    data: {
                        labels: @json($lineLabels),
                        datasets: [{
                            label: 'Quantity Expiring',
                            data: @json($lineData),
                            backgroundColor: 'rgba(78, 115, 223, 0.05)',
                            borderColor: 'rgba(78, 115, 223, 1)',
                            pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                            pointBorderColor: '#fff',
                            pointHoverBackgroundColor: '#fff',
                            pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                            pointRadius: 3,
                            pointHoverRadius: 5,
                            fill: true,
                            tension: 0.3
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `${context.dataset.label}: ${context.raw}`;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: { grid: { display: false } },
                            y: {
                                beginAtZero: true,
                                ticks: { precision: 0 }
                            }
                        }
                    }
                });
            }
        });
    </script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
@endpush
