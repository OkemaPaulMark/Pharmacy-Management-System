@extends('admin.layouts.app')

@section('title', 'Pharmacy M.S')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 text-gray-800">Medicines</h1>
    <!-- <a href="#" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
    </a> -->
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
    <div class="card-header py-3 d-flex justify-content-between">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addMedicineModal">
            <i class="fas fa-plus"></i> Add Medicine
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Medicine Name</th>
                        <th>Category</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Supplier</th>
                        <th>Expiry Date</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($medicines as $medicine)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $medicine->name }}</td>
                        <td>{{ $medicine->category->category ?? $medicine->category ?? 'N/A' }}</td>
                        <td>{{ number_format($medicine->unit_price, 2) }}</td>
                        <td>{{ $medicine->quantity }}</td>
                        <td>{{ $medicine->supplier->supplier_name ?? $medicine->supplier ?? 'N/A' }}</td>
                        <td>{{ $medicine->expiry_date->format('d/m/Y') }}</td>
                        <td>{{ Str::limit($medicine->description, 30) }}</td>
                        <td>
                            <a href="{{ route('medicines.show', $medicine->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('medicines.edit', $medicine->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete {{ $medicine->name }}? This action cannot be undone!')">
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
                    {{ $medicines->links('pagination::bootstrap-4') }}
                </div>

        </div>
    </div>
</div>

<!-- Add Medicine Modal -->
<div class="modal fade" id="addMedicineModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Medicine</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="medicineForm" action="{{ route('medicines.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Medicine Name -->
                    <div class="form-group">
                        <label for="medicine_id">Medicine*</label>
                        <select id="medicine_id" name="medicine_id" class="form-control" required>
                            <option value="">Select Medicine</option>
                            @foreach($stocks as $stock)
                                <option value="{{ $stock->id }}">{{ $stock->medicine }}</option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Category -->
                    <div class="form-group">
                        <label for="category">Category*</label>
                        <select id="category" name="category" class="form-control" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pricing and Quantity -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="unit_price">Unit Price (UGX)*</label>
                                <input type="number" id="unit_price" name="unit_price" class="form-control" min="0" step="0.01" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quantity">Quantity*</label>
                                <input type="number" id="quantity" name="quantity" class="form-control" min="1" required>
                            </div>
                        </div>
                    </div>

                    <!-- Supplier -->
                    <div class="form-group">
                        <label for="supplier">Supplier*</label>
                        <select id="supplier" name="supplier" class="form-control" required>
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Expiry Date -->
                    <div class="form-group">
                        <label for="expiry_date">Expiry Date*</label>
                        <input type="date" id="expiry_date" name="expiry_date" class="form-control" required>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter your description here..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Medicine</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
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