@extends('admin.layouts.app')

@section('title', 'View Medicine - Pharmacy M.S')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 text-gray-800">Medicine Details</h1>
    <a href="{{ route('medicines.index') }}" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Medicines
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $medicine->name }}</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Medicine Information
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th>Medicine Name:</th>
                                            <td>{{ $medicine->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Category:</th>
                                            <td>{{ $medicine->category }}</td>
                                        </tr>
                                        <tr>
                                            <th>Supplier:</th>
                                            <td>{{ $medicine->supplier }}</td>
                                        </tr>
                                        <tr>
                                            <th>Description:</th>
                                            <td>{{ $medicine->description ?: 'No description available' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Stock Information
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th>Unit Price:</th>
                                            <td>UGX {{ number_format($medicine->unit_price, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Available Quantity:</th>
                                            <td>{{ $medicine->quantity }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Value:</th>
                                            <td>UGX {{ number_format($medicine->unit_price * $medicine->quantity, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Expiry Date:</th>
                                            <td>{{ $medicine->expiry_date->format('d/m/Y') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <a href="{{ route('medicines.edit', $medicine->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit Medicine
                </a>
                <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete {{ $medicine->name }}? This action cannot be undone!')">
                        <i class="fas fa-trash"></i> Delete Medicine
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection