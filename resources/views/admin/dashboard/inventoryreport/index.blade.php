@extends('admin.layouts.app')

@section('title', 'Pharmacy M.S')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 text-gray-800">Inventory Reports</h1>
    <a href="#" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Generate PDF
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Comprehensive Inventory Report</h6>
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
                        <th>Unit Price</th>
                        <th>Current Stock</th>
                        <th>Stock Value</th>
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
                        <td>$5.00</td>
                        <td class="font-weight-bold">8 <small>(Low Stock)</small></td>
                        <td>$40.00</td>
                        <td>2024-06-30</td>
                        <td><span class="badge badge-warning w-100 text-center d-block">Low Stock</span></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Amoxicillin 250mg</td>
                        <td>Antibiotic</td>
                        <td>PharmaDirect</td>
                        <td>$8.50</td>
                        <td>25</td>
                        <td>$212.50</td>
                        <td>2025-01-15</td>
                        <td><span class="badge badge-success w-100 text-center d-block">In Stock</span></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Cough Syrup 100ml</td>
                        <td>Cough & Cold</td>
                        <td>HealthCare Distributors</td>
                        <td>$12.00</td>
                        <td>3 <small>(Critical)</small></td>
                        <td>$36.00</td>
                        <td>2023-12-01</td>
                        <td><span class="badge badge-danger w-100 text-center d-block">Expiring Soon</span></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Omeprazole 20mg</td>
                        <td>Antacid</td>
                        <td>Global Pharma</td>
                        <td>$15.75</td>
                        <td>42</td>
                        <td>$661.50</td>
                        <td>2024-09-30</td>
                        <td><span class="badge badge-success w-100 text-center d-block">In Stock</span></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="bg-light">
                        <td colspan="5" class="text-right font-weight-bold">Total Inventory Value:</td>
                        <td>78 items</td>
                        <td colspan="3">$950.00</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
