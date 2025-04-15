@extends('admin.layouts.app')

@section('title', 'Pharmacy M.S - Inventory Reports')

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
                <!-- Table with dynamic data, verified stock value and status -->
                <table class="table table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Medicine</th>
                        <th>Supplier</th>
                        <th>Unit Price</th>
                        <th>Current Stock</th>
                        <th>Stock Value</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($medicines as $index => $medicine)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $medicine->name }}</td>
                            <!-- Supplier as string -->
                            <td>{{ $medicine->supplier ?? 'N/A' }}</td>
                            <td>{{ number_format($medicine->unit_price, 2) }}</td>
                            <td>
                                {{ $medicine->quantity }}
                                <!-- Status annotations -->
                                @if ($medicine->status == 'Critical Stock')
                                    <small>(Critical)</small>
                                @elseif ($medicine->status == 'Low Stock')
                                    <small>(Low Stock)</small>
                                @endif
                            </td>
                            <!-- Stock Value: unit_price * quantity -->
                            <td>{{ number_format($medicine->stock_value, 2) }}</td>
                            <td>{{ $medicine->expiry_date->format('Y-m-d') }}</td>
                            <td>
                                <!-- Status badges -->
                                @if ($medicine->status == 'Critical Stock')
                                    <span class="badge badge-danger w-100 text-center d-block">Critical Stock</span>
                                @elseif ($medicine->status == 'Low Stock')
                                    <span class="badge badge-warning w-100 text-center d-block">Low Stock</span>
                                @else
                                    <span class="badge badge-success w-100 text-center d-block">In Stock</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No inventory records available.</td>
                        </tr>
                    @endforelse
                    </tbody>
                    <tfoot>
                    <tr class="bg-light">
                        <td colspan="4" class="text-right font-weight-bold">Total Inventory Value:</td>
                        <td>{{ $totalItems }} items</td>
                        <td colspan="3">UGX{{ number_format($totalValue, 2) }}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
