@extends('admin.layouts.app')

@section('title', 'Stock Details - Pharmacy M.S')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Stock Details</h1>
        <a href="{{ route('expiryalerts.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Stock Information</h6>
        </div>
        <div class="card-body">
            <!-- Display stock details -->
            <!-- Removed Category row -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th>Medicine</th>
                        <td>{{ $stock->medicine }}</td>
                    </tr>
                    <tr>
                        <th>Supplier</th>
                        <td>{{ $stock->supplier ? $stock->supplier->supplier_name : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Quantity</th>
                        <td>{{ $stock->quantity }}</td>
                    </tr>
                    <tr>
                        <th>Expiry Date</th>
                        <td>{{ $stock->expiry_date->format('Y-m-d') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if ($stock->expiry_status == 'Expired')
                                <span class="badge badge-danger w-100 text-center d-block">Expired</span>
                            @elseif ($stock->expiry_status == 'Expiring Soon')
                                <span class="badge badge-warning w-100 text-center d-block">Expiring Soon</span>
                            @else
                                <span class="badge badge-success w-100 text-center d-block">Safe</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Unit Cost</th>
                        <td>{{ number_format($stock->unit_cost, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Purchase Date</th>
                        <td>{{ $stock->purchase_date->format('Y-m-d') }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- Action buttons -->
            <a href="{{ route('expiryalerts.edit', $stock->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('expiryalerts.destroy', $stock->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this stock?');">Delete</button>
            </form>
        </div>
    </div>
@endsection
