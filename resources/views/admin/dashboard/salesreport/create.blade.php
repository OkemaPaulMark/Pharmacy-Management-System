@extends('admin.layouts.app')

@section('title', 'Add New Transaction - Pharmacy M.S')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Add New Transaction</h1>
        <a href="{{ route('salesreport.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">New Transaction</h6>
        </div>
        <div class="card-body">
            <!-- Form to create a new transaction -->
            <form action="{{ route('salesreport.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="medicine_id">Medicine</label>
                    <select class="form-control @error('medicine_id') is-invalid @enderror" id="medicine_id" name="medicine_id">
                        <option value="">Select Medicine</option>
                        @foreach ($medicines as $medicine)
                            <option value="{{ $medicine->id }}" {{ old('medicine_id') == $medicine->id ? 'selected' : '' }}>{{ $medicine->name }}</option>
                        @endforeach
                    </select>
                    @error('medicine_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="unit_price">Unit Price</label>
                    <input type="number" step="0.01" class="form-control @error('unit_price') is-invalid @enderror" id="unit_price" name="unit_price" value="{{ old('unit_price') }}">
                    @error('unit_price')
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
                    <label for="created_at">Transaction Date</label>
                    <input type="datetime-local" class="form-control @error('created_at') is-invalid @enderror" id="created_at" name="created_at" value="{{ old('created_at') }}">
                    @error('created_at')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Save Transaction</button>
            </form>
        </div>
    </div>
@endsection
