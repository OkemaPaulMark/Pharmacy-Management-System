@extends('admin.layouts.app')

@section('title', 'Pharmacy M.S')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 text-gray-800">Stocks</h1>
    <a href="#" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addMedicineModal">
            <i class="fas fa-plus"></i> Add Stock
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Medicine</th>
                        <th>Supplier</th>
                        <th>Quantity</th>
                        <th>Expiry Date</th>
                        <th>Unit Cost</th>
                        <th>Purchase Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stocks as $stock)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $stock->medicine }}</td>
                        <td>{{ $stock->supplier->supplier_name }}</td>
                        <td>{{ $stock->quantity }}</td>
                        <td>{{ $stock->expiry_date->format('d/m/Y') }}</td>
                        <td>${{ number_format($stock->unit_cost, 2) }}</td>
                        <td>{{ $stock->purchase_date->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('stocks.show', $stock->id) }}" class="btn btn-info btn-sm">View</a>

                            <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete the stock {{ $stock->stock }}? This action cannot be undone!')">
                                    Delete
                                </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
                            <!-- Pagination Controls -->
                <div class="d-flex justify-content-between">
                    {{ $stocks->links('pagination::bootstrap-4') }}
                </div>
        </div>
    </div>
</div>

<!-- Add Medicine Modal -->
<div class="modal fade" id="addMedicineModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('stocks.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="medicine">Medicine</label>
                        <input type="text" id="medicine" name="medicine" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="supplier_id">Supplier</label>
                        <select id="supplier_id" name="supplier_id" class="form-control" required>
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="expiry_date">Expiry Date</label>
                        <input type="date" id="expiry_date" name="expiry_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="unit_cost">Unit Cost</label>
                        <input type="number" id="unit_cost" name="unit_cost" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="purchase_date">Purchase Date</label>
                        <input type="date" id="purchase_date" name="purchase_date" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Add Stock</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
