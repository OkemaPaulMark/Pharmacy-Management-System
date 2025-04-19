@extends('admin.layouts.app')

@section('title', 'Edit Medicine - Pharmacy M.S')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 text-gray-800">Edit Medicine</h1>
    <a href="{{ route('medicines.index') }}" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Medicines
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Medicine Details</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('medicines.update', $medicine->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Medicine Name -->
            <div class="form-group">
                <label for="medicine_id">Medicine*</label>
                <select id="medicine_id" name="medicine_id" class="form-control" required>
                    <option value="">Select Medicine</option>
                    @foreach($stocks as $stock)
                        <option value="{{ $stock->id }}" {{ $medicine->medicine_id == $stock->id ? 'selected' : '' }}>
                            {{ $stock->medicine }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Category -->
            <div class="form-group">
                <label for="category">Category*</label>
                <select id="category" name="category" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $medicine->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->category }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Pricing and Quantity -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="unit_price">Unit Price (UGX)*</label>
                        <input type="number" id="unit_price" name="unit_price" class="form-control" 
                               min="0" step="0.01" value="{{ $medicine->unit_price }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="quantity">Quantity*</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" 
                               min="1" value="{{ $medicine->quantity }}" required>
                    </div>
                </div>
            </div>

            <!-- Supplier -->
            <div class="form-group">
                <label for="supplier">Supplier*</label>
                <select id="supplier" name="supplier" class="form-control" required>
                    <option value="">Select Supplier</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ $medicine->supplier_id == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->supplier_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Expiry Date -->
            <div class="form-group">
                <label for="expiry_date">Expiry Date*</label>
                <input type="date" id="expiry_date" name="expiry_date" class="form-control" 
                       value="{{ $medicine->expiry_date->format('Y-m-d') }}" required>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3" 
                          placeholder="Enter your description here...">{{ $medicine->description }}</textarea>
            </div>

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-success">Update Medicine</button>
                <a href="{{ route('medicines.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Set minimum date for expiry date (tomorrow)
    document.getElementById('expiry_date').min = new Date(new Date().getTime() + 86400000).toISOString().split('T')[0];

    // Auto-calculate total when unit price or quantity changes
    document.getElementById('unit_price').addEventListener('input', calculateTotal);
    document.getElementById('quantity').addEventListener('input', calculateTotal);

    function calculateTotal() {
        const unitPrice = parseFloat(document.getElementById('unit_price').value) || 0;
        const quantity = parseInt(document.getElementById('quantity').value) || 0;
        // This is just for display, the actual calculation happens in the controller
        document.getElementById('total-display').textContent = 'UGX' + (unitPrice * quantity).toFixed(2);
    }
</script>
@endsection