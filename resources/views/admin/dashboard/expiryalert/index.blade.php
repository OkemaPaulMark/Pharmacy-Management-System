@extends('admin.layouts.app')

@section('title', 'Pharmacy M.S')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 text-gray-800">Expiry Alerts</h1>
    <a href="#" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Expiring Medicines</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Medicine</th>
                        <th>Category</th>
                        <th>Supplier</th>
                        <th>Current Stock</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Paracetamol 500mg</td>
                        <td>Painkiller</td>
                        <td>MediPlus Suppliers</td>
                        <td>8</td>
                        <td>2024-06-30</td>
                        <td><span class="badge badge-warning w-100 text-center d-block">Expiring Soon</span></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Amoxicillin 250mg</td>
                        <td>Antibiotic</td>
                        <td>PharmaDirect</td>
                        <td>25</td>
                        <td>2025-01-15</td>
                        <td><span class="badge badge-success w-100 text-center d-block">Safe</span></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Cough Syrup 100ml</td>
                        <td>Cough & Cold</td>
                        <td>HealthCare Distributors</td>
                        <td>3</td>
                        <td>2023-12-01</td>
                        <td><span class="badge badge-danger w-100 text-center d-block">Expired</span></td>
                    </tr>
                </tbody>
            </table>
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