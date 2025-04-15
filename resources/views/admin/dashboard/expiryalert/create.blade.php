@extends('admin.layouts.app')

@section('title', 'Add New Stock - Pharmacy M.S')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Add New Stock</h1>
        <a href="{{ route('expiryalerts.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">New Stock Entry</h6>
        </div>
        <div class="card-body">
            <!-- Form to create a new stock entry -->
            <!-- Removed category_id field -->
            <form action="{{ route('expiryalerts.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="medicine">Medicine Name</label>
                    <input type="text" class="form-control @error('medicine') is-invalid @enderror" id="medicine" name="medicine" value="{{ old('medicine') }}">
                    @error('medicine')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="supplier_id">Supplier</label>
                    <select class="form-control @error('supplier_id') is-invalid @enderror" id="supplier_id" name="supplier_id">
                        <option value="">Select Supplier</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->supplier_name }}</option>
                        @endforeach
                    </select>
                    @error('supplier_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity') }}">
                    @error('quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="expiry_date">Expiry Date</label>
                    <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}">
                    @error('expiry_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="unit_cost">Unit Cost</label>
                    <input type="number" step="0.01" class="form-control @error('unit_cost') is-invalid @enderror" id="unit_cost" name="unit_cost" value="{{ old('unit_cost') }}">
                    @error('unit_cost')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="purchase_date">Purchase Date</label>
                    <input type="date" class="form-control @error('purchase_date') is-invalid @enderror" id="purchase_date" name="purchase_date" value="{{ old('purchase_date') }}">
                    @error('purchase_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Save Stock</button>
            </form>
        </div>
    </div>
@endsection
