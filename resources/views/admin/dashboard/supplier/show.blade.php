@extends('admin.layouts.app')

@section('title', 'Supplier Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Supplier Details</h6>
                    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Supplier Information -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="m-0 font-weight-bold">Basic Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th width="40%">Supplier ID:</th>
                                                <td>#{{ $supplier->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Supplier Name:</th>
                                                <td>{{ $supplier->supplier_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Contact Person:</th>
                                                <td>{{ $supplier->contact_person }}</td>
                                            </tr>
                                            <tr>
                                                <th>Supplier Type:</th>
                                                <td>
                                                    <span class="badge badge-info">
                                                        {{ ucfirst($supplier->supplier_type) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="m-0 font-weight-bold">Contact Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th width="40%">Phone:</th>
                                                <td>
                                                    <a href="tel:{{ $supplier->phone }}">
                                                        {{ $supplier->phone }}
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Email:</th>
                                                <td>
                                                    <a href="mailto:{{ $supplier->email }}">
                                                        {{ $supplier->email }}
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Address:</th>
                                                <td>{{ $supplier->address }}</td>
                                            </tr>
                                            <tr>
                                                <th>Registered On:</th>
                                                <td>{{ $supplier->created_at->format('M d, Y') }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Related Data Tabs -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <ul class="nav nav-tabs card-header-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="stocks-tab" data-toggle="tab" href="#stocks">
                                                Stock Supplied
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="medicines-tab" data-toggle="tab" href="#medicines">
                                                Medicines Supplied
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <!-- Stocks Tab -->
                                        <div class="tab-pane fade show active" id="stocks">
                                            @if($supplier->stocks->count() > 0)
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Stock ID</th>
                                                                <th>Medicine</th>
                                                                <th>Quantity</th>
                                                                <th>Batch No</th>
                                                                <th>Expiry Date</th>
                                                                <th>Date Supplied</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($supplier->stocks as $stock)
                                                                <tr>
                                                                    <td>#{{ $stock->id }}</td>
                                                                    <td>{{ $stock->medicine->name ?? 'N/A' }}</td>
                                                                    <td>{{ $stock->quantity }}</td>
                                                                    <td>{{ $stock->batch_number }}</td>
                                                                    <td>{{ $stock->expiry_date->format('M d, Y') }}</td>
                                                                    <td>{{ $stock->created_at->format('M d, Y') }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                <div class="alert alert-info">No stock records found for this supplier.</div>
                                            @endif
                                        </div>

                                        <!-- Medicines Tab -->
                                        <div class="tab-pane fade" id="medicines">
                                            @if($supplier->medicines->count() > 0)
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Medicine ID</th>
                                                                <th>Name</th>
                                                                <th>Category</th>
                                                                <th>Price</th>
                                                                <th>Quantity</th>
                                                                <th>Added On</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($supplier->medicines as $medicine)
                                                                <tr>
                                                                    <td>#{{ $medicine->id }}</td>
                                                                    <td>{{ $medicine->name }}</td>
                                                                    <td>{{ $medicine->category->name ?? 'N/A' }}</td>
                                                                    <td>{{ number_format($medicine->price, 2) }}</td>
                                                                    <td>{{ $medicine->quantity }}</td>
                                                                    <td>{{ $medicine->created_at->format('M d, Y') }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                <div class="alert alert-info">No medicine records found for this supplier.</div>
                                            @endif
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
                                <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit Supplier
                                </a>
                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this supplier?')">
                                        <i class="fas fa-trash"></i> Delete Supplier
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
    .nav-tabs .nav-link {
        border: none;
        color: #6c757d;
    }
    .nav-tabs .nav-link.active {
        color: #4e73df;
        font-weight: bold;
        border-bottom: 2px solid #4e73df;
    }
</style>
@endsection