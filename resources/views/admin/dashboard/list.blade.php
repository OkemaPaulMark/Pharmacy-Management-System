@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Today's Sales -->
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <i class="fas fa-dollar-sign fa-2x text-success"></i>
                        </div>
                        <div class="col-3">
                            <span class="mdi mdi-arrow-top-right icon-item icon icon-box-success"></span>
                        </div>
                    </div>
                    <h5 class="text-muted font-weight-normal">Today's Sales</h5>
                    <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0">
                            UGX {{ number_format($todaySales ?? 0) }}
                        </h3>
                    </div>
                    <p>Today's Medicine Sale Transactions.</p>
                </div>
            </div>
        </div>

        <!-- Total Sales -->
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <i class="fas fa-coins fa-2x text-primary"></i>
                        </div>
                        <div class="col-3">
                            <span class="mdi mdi-arrow-top-right icon-item icon icon-box-primary"></span>
                        </div>
                    </div>
                    <h5 class="text-muted font-weight-normal">Total Sales</h5>
                    <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0">
                            UGX {{ number_format($totalSales ?? 0) }}
                        </h3>
                    </div>
                    <p>All Medicine Sales Recorded.</p>
                </div>
            </div>
        </div>

        <!-- Total Medicines -->
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <i class="fas fa-pills fa-2x text-warning"></i>
                        </div>
                        <div class="col-3">
                            <span class="mdi mdi-caps-lock icon-item icon icon-box-warning"></span>
                        </div>
                    </div>
                    <h5 class="text-muted font-weight-normal">Total Medicines</h5>
                    <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0">
                            {{ number_format($totalMedicines ?? 0) }}
                        </h3>
                    </div>
                    <p>Registered Medicines in Stock.</p>
                </div>
            </div>
        </div>

        <!-- Total Suppliers -->
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <i class="fas fa-truck fa-2x text-info"></i>
                        </div>
                        <div class="col-3">
                            <span class="mdi mdi-truck-delivery icon-item icon icon-box-info"></span>
                        </div>
                    </div>
                    <h5 class="text-muted font-weight-normal">Total Suppliers</h5>
                    <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0">
                            {{ number_format($totalSuppliers ?? 0) }}
                        </h3>
                    </div>
                    <p>Suppliers Registered in System.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
