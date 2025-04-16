<!-- File: resources/views/admin/dashboard/list.blade.php -->
@extends('admin.layouts.app')

@section('title', 'Pharmacy M.S')

@section('content')
    <!-- Display error if present -->
    @if (isset($error))
        <div class="alert alert-danger">{{ $error }}</div>
    @endif

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
        </a>
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
                                        <!-- Dynamic count of today's sales -->
                                        <h3 class="mb-0">@isset($todaySales){{ $todaySales }}@else 0 @endisset</h3>
                                    </div>
                                    <p></p>
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
                                        <!-- Dynamic count of low-stock items -->
                                        <h3 class="mb-0">@isset($lowStockItems){{ $lowStockItems }}@else 0 @endisset</h3>
                                    </div>
                                    <p></p>
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
                                        <!-- Dynamic count of items expiring soon -->
                                        <h3 class="mb-0">@isset($expiringSoon){{ $expiringSoon }}@else 0 @endisset</h3>
                                    </div>
                                    <p></p>
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
                                        <!-- Dynamic count of total stocks -->
                                        <h3 class="mb-0">@isset($totalStocks){{ $totalStocks }}@else 0 @endisset</h3>
                                    </div>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
@endpush
