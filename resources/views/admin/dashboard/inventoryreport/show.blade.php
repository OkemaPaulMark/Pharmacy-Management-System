@extends('admin.layouts.app')

@section('title', 'Medicine Details - Pharmacy M.S')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Medicine Details</h1>
        <a href="{{ route('inventoryreport.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Medicine Information</h6>
        </div>
        <div class="card-body">
            <!-- Display medicine details with verified stock value and status -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th>Medicine</th>
                        <td>{{ $medicine->name }}</td>
                    </tr>
                    <tr>
                        <th>Supplier</th>
                        <td>{{ $medicine->supplier ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Unit Price</th>
                        <td>${{ number_format($medicine->unit_price, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Current Stock</th>
                        <td>
                            {{ $medicine->quantity }}
                            <!-- Status annotation -->
                            @if ($medicine->status == 'Critical Stock')
                                <small>(Critical)</small>
                            @elseif ($medicine->status == 'Low Stock')
                                <small>(Low Stock)</small>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Stock Value</th>
                        <!-- Verified: unit_price * quantity -->
                        <td>${{ number_format($medicine->stock_value, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Expiry Date</th>
                        <td>{{ $medicine->expiry_date->format('Y-m-d') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <!-- Status badge -->
                            @if ($medicine->status == 'Critical Stock')
                                <span class="badge badge-danger w-100 text-center d-block">Critical Stock</span>
                            @elseif ($medicine->status == 'Low Stock')
                                <span class="badge badge-warning w-100 text-center d-block">Low Stock</span>
                            @else
                                <span class="badge badge-success w-100 text-center d-block">In Stock</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $medicine->description ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Linked Stock</th>
                        <td>{{ $medicine->stock ? $medicine->stock->medicine : 'None' }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- Action buttons -->
            <a href="{{ route('inventoryreport.edit', $medicine->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('inventoryreport.destroy', $medicine->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this medicine?');">Delete</button>
            </form>
        </div>
    </div>
@endsection
