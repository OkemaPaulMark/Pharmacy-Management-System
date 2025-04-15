@extends('admin.layouts.app')

@section('title', 'Edit Stock')

@section('content')
<div class="modal fade show" id="editStockModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: block; padding-right: 17px;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Stock</h5>
                <a href="{{ route('stocks.index') }}" class="close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('stocks.update', $stock->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Medicine (Product Name) -->
                    <div class="form-group">
                        <label for="medicine">Medicine</label>
                        <input type="text" name="medicine" class="form-control" id="medicine" value="{{ old('medicine', $stock->medicine) }}" required>
                        @error('medicine')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Supplier -->
                    <div class="form-group">
                        <label for="supplier_id">Supplier</label>
                        <select name="supplier_id" class="form-control" id="supplier_id" required>
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id', $stock->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->supplier_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Quantity -->
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" class="form-control" id="quantity" value="{{ old('quantity', $stock->quantity) }}" required>
                        @error('quantity')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Expiry Date -->
                    <div class="form-group">
                        <label for="expiry_date">Expiry Date</label>
                        <input type="date" name="expiry_date" class="form-control" id="expiry_date" value="{{ old('expiry_date', $stock->expiry_date ? $stock->expiry_date->toDateString() : '') }}" required>
                        @error('expiry_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Unit Cost (Price) -->
                    <div class="form-group">
                        <label for="unit_cost">Unit Cost</label>
                        <input type="number" name="unit_cost" class="form-control" id="unit_cost" value="{{ old('unit_cost', $stock->unit_cost) }}" required>
                        @error('unit_cost')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Purchase Date -->
                    <div class="form-group">
                        <label for="purchase_date">Purchase Date</label>
                        <input type="date" name="purchase_date" class="form-control" id="purchase_date" value="{{ old('purchase_date', $stock->purchase_date ? $stock->purchase_date->toDateString() : '') }}" required>
                        @error('purchase_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update Stock</button>
                        <a href="{{ route('stocks.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal-backdrop fade show"></div>
@endsection
