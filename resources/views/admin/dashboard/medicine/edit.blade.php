@extends('admin.layouts.app')

@section('title', 'Edit Medicine')

@section('content')
<div class="modal fade show" id="editMedicineModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: block; padding-right: 17px;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Medicine</h5>
                <a href="{{ route('medicines.index') }}" class="close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('medicines.update', $medicine->id) }}" method="POST">
                    @csrf
                    @method('PUT')

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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="unit_price">Unit Price (USD)*</label>
                                <input type="number" id="unit_price" name="unit_price" class="form-control" 
                                       value="{{ old('unit_price', $medicine->unit_price) }}" min="0" step="0.01" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quantity">Quantity*</label>
                                <input type="number" id="quantity" name="quantity" class="form-control" 
                                       value="{{ old('quantity', $medicine->quantity) }}" min="1" required>
                            </div>
                        </div>
                    </div>

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

                    <div class="form-group">
                        <label for="expiry_date">Expiry Date*</label>
                        <input type="date" id="expiry_date" name="expiry_date" class="form-control" 
                               value="{{ old('expiry_date', $medicine->expiry_date->format('Y-m-d')) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" rows="3">{{ old('description', $medicine->description) }}</textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update Medicine</button>
                        <a href="{{ route('medicines.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal-backdrop fade show"></div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const expiryDate = document.getElementById('expiry_date');
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    expiryDate.min = tomorrow.toISOString().split('T')[0];
});
</script>
@endsection
