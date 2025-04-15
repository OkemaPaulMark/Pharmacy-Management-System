@extends('admin.layouts.app')

@section('title', 'Transaction Details - Pharmacy M.S')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Transaction Details</h1>
        <a href="{{ route('salesreport.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transaction Information</h6>
        </div>
        <div class="card-body">
            <!-- Display transaction details -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th>Medicine</th>
                        <td>{{ $transaction->medicine->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Unit Price</th>
                        <td>${{ number_format($transaction->unit_price, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Quantity</th>
                        <td>{{ $transaction->quantity }}</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td>${{ number_format($transaction->total, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{{ $transaction->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- Action buttons -->
            <a href="{{ route('salesreport.edit', $transaction->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('salesreport.destroy', $transaction->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this transaction?');">Delete</button>
            </form>
        </div>
    </div>
@endsection
