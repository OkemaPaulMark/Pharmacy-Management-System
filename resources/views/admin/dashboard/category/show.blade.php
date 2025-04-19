@extends('admin.layouts.app')

@section('title', 'Category Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Category Details</h6>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Category Information -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="m-0 font-weight-bold">Category Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th width="40%">Category ID:</th>
                                                <td>#{{ $category->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Name:</th>
                                                <td>{{ $category->category }}</td>
                                            </tr>
                                            <tr>
                                                <th>Created At:</th>
                                                <td>{{ $category->created_at->format('M d, Y H:i') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Last Updated:</th>
                                                <td>{{ $category->updated_at->format('M d, Y H:i') }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Statistics -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="m-0 font-weight-bold">Statistics</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th width="40%">Total Medicines:</th>
                                                <td>{{ $category->medicines->count() }}</td>
                                            </tr>
                                            <tr>
                                                <th>Active Medicines:</th>
                                                <td>
                                                    {{ $category->medicines->where('expiry_date', '>', now())->count() }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Expired Medicines:</th>
                                                <td>
                                                    {{ $category->medicines->where('expiry_date', '<=', now())->count() }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description Section -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="m-0 font-weight-bold">Description</h6>
                                </div>
                                <div class="card-body">
                                    <div class="p-3">
                                        {{ $category->description ?? 'No description available' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Medicines Section -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-primary text-white">
                                    <h6 class="m-0 font-weight-bold">Recent Medicines in This Category</h6>
                                </div>
                                <div class="card-body">
                                    @if($category->medicines->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Medicine</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Supplier</th>
                                                        <th>Expiry Date</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($category->medicines as $medicine)
                                                    <tr>
                                                        <td>{{ $medicine->name }}</td>
                                                        <td>{{ number_format($medicine->unit_price, 2) }}</td>
                                                        <td>{{ $medicine->quantity }}</td>
                                                        <td>{{ $medicine->supplier->supplier_name ?? 'N/A' }}</td>
                                                        <td class="{{ $medicine->expiry_date->isPast() ? 'text-danger' : '' }}">
                                                            {{ $medicine->expiry_date->format('M d, Y') }}
                                                        </td>
                                                        <td>
                                                            @if($medicine->expiry_date->isPast())
                                                                <span class="badge badge-danger">Expired</span>
                                                            @else
                                                                <span class="badge badge-success">Active</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-center mt-3">
                                            <a href="{{ route('medicines.index', ['category_id' => $category->id]) }}" 
                                               class="btn btn-primary btn-sm">
                                                View All Medicines in This Category
                                            </a>
                                        </div>
                                    @else
                                        <div class="alert alert-info">
                                            No medicines found in this category.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit Category
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this category?')">
                                        <i class="fas fa-trash"></i> Delete Category
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
</style>
@endsection