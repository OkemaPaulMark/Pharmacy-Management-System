@extends('admin.layouts.app')

@section('title', 'Edit Supplier')

@section('content')
<div class="modal fade show" id="editSupplierModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: block; padding-right: 17px;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Supplier</h5>
                <a href="{{ route('suppliers.index') }}" class="close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="supplier_name">Supplier Name*</label>
                        <input type="text" name="supplier_name" class="form-control" id="supplier_name" value="{{ old('supplier_name', $supplier->supplier_name) }}" required>
                        @error('supplier_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="contact_person">Contact Person*</label>
                        <input type="text" name="contact_person" class="form-control" id="contact_person" value="{{ old('contact_person', $supplier->contact_person) }}" required>
                        @error('contact_person')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone*</label>
                        <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone', $supplier->phone) }}" required>
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">Address*</label>
                        <input type="text" name="address" class="form-control" id="address" value="{{ old('address', $supplier->address) }}" required>
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email*</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $supplier->email) }}" required>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="supplier_type">Supplier Type*</label>
                        <input type="text" name="supplier_type" class="form-control" id="supplier_type" value="{{ old('supplier_type', $supplier->supplier_type) }}" required>
                        @error('supplier_type')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update Supplier</button>
                        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal-backdrop fade show"></div>
@endsection
