@extends('admin.layouts.app')

@section('title', 'Pharmacy M.S - Sale Details')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Sale Details</h1>
        <div>
            <a href="{{ route('salesreports.edit', $sale->id) }}" class="btn btn-sm btn-warning shadow-sm">
                <i class="fas fa-edit fa-sm text-white-50"></i> Edit
            </a>
            <a href="{{ route('salesreports.index') }}" class="btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sale #{{ $sale->id }}</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Medicine Information</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Medicine Name</th>
                            <td>{{ $sale->medicine->name }}</td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>{{ $sale->category->name }}</td>
                        </tr>
                        <tr>
                            <th>Batch Number</th>
                            <td>{{ $sale->medicine->batch_number }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h5>Sale Details</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Date</th>
                            <td>{{ $sale->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Unit Price</th>
                            <td>${{ number_format($sale->unit_price, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Quantity</th>
                            <td>{{ $sale->quantity }}</td>
                        </tr>
                        <tr>
                            <th>Total Amount</th>
                            <td>${{ number_format($sale->total, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Recorded By</th>
                            <td>{{ $sale->user->name }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            @if($sale->prescription)
                <div class="row mt-4">
                    <div class="col-12">
                        <h5>Prescription Notes</h5>
                        <div class="card">
                            <div class="card-body">
                                {{ $sale->prescription }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
