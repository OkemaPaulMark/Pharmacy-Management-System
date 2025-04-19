@extends('admin.layouts.app')

@section('title', 'Stock Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Stock Details</h6>
                    <a href="{{ route('stocks.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Stock Information -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="m-0 font-weight-bold">Stock Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th width="40%">Stock ID:</th>
                                                <td>#{{ $stock->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Medicine Name:</th>
                                                <td>{{ $stock->medicine }}</td>
                                            </tr>
                                            <tr>
                                                <th>Quantity:</th>
                                                <td>
                                                    <span class="badge badge-info">
                                                        {{ $stock->quantity }} units
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Unit Cost:</th>
                                                <td>{{ number_format($stock->unit_cost, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total Value:</th>
                                                <td>{{ number_format($stock->quantity * $stock->unit_cost, 2) }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Supplier & Date Information -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="m-0 font-weight-bold">Supplier & Dates</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th width="40%">Supplier:</th>
                                                <td>
                                                    <a href="{{ route('suppliers.show', $stock->supplier_id) }}">
                                                        {{ $stock->supplier->supplier_name }}
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Contact Person:</th>
                                                <td>{{ $stock->supplier->contact_person }}</td>
                                            </tr>
                                            <tr>
                                                <th>Purchase Date:</th>
                                                <td>{{ $stock->purchase_date->format('M d, Y') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Expiry Date:</th>
                                                <td>
                                                    @php
                                                        $expiryClass = $stock->expiry_date->isPast() ? 'badge-danger' : 
                                                                      ($stock->expiry_date->diffInMonths(now()) < 3 ? 'badge-warning' : 'badge-success');
                                                    @endphp
                                                    <span class="badge {{ $expiryClass }}">
                                                        {{ $stock->expiry_date->format('M d, Y') }}
                                                        @if($stock->expiry_date->isPast())
                                                            (Expired)
                                                        @elseif($stock->expiry_date->diffInMonths(now()) < 3)
                                                            (Expiring Soon)
                                                        @endif
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Days Until Expiry:</th>
                                                <td>
                                                    {{ $stock->expiry_date->isPast() ? 
                                                       'Already expired '.$stock->expiry_date->diffForHumans() : 
                                                       'Expires in '.$stock->expiry_date->diffForHumans() }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information Section -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="m-0 font-weight-bold">Additional Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Supplier Details</h6>
                                            <ul class="list-unstyled">
                                                <li><strong>Phone:</strong> {{ $stock->supplier->phone }}</li>
                                                <li><strong>Email:</strong> {{ $stock->supplier->email }}</li>
                                                <li><strong>Address:</strong> {{ $stock->supplier->address }}</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Stock Metadata</h6>
                                            <ul class="list-unstyled">
                                                <li><strong>Created At:</strong> {{ $stock->created_at->format('M d, Y H:i') }}</li>
                                                <li><strong>Updated At:</strong> {{ $stock->updated_at->format('M d, Y H:i') }}</li>
                                                <li><strong>Added By:</strong> System</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit Stock
                                </a>
                                <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this stock record?')">
                                        <i class="fas fa-trash"></i> Delete Stock
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card-header {
        padding: 0.75rem 1.25rem;
    }
    .table-borderless td, .table-borderless th {
        border: 0;
    }
    .badge {
        font-size: 0.85rem;
        padding: 0.35rem 0.65rem;
    }
    .list-unstyled li {
        padding: 0.25rem 0;
    }
</style>
@endsection