@extends('admin.layouts.app')

@section('title', 'Pharmacy M.S - Record New Sale')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Record New Sale</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sale Information</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('salesreports.store') }}" method="POST">
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="medicine_id">Medicine</label>
                        <select class="form-control" id="medicine_id" name="medicine_id" required>
                            <option value="">Select Medicine</option>
                            @foreach($medicines as $medicine)
                                <option value="{{ $medicine->id }}" data-price="{{ $medicine->price }}" data-category="{{ $medicine->category_id }}">
                                    {{ $medicine->name }} ({{ $medicine->batch_number }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="category_id">Category</label>
                        <input type="text" class="form-control" id="category_id_display" readonly>
                        <input type="hidden" id="category_id" name="category_id">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="unit_price">Unit Price</label>
                        <input type="number" step="0.01" class="form-control" id="unit_price" name="unit_price" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="total">Total Amount</label>
                        <input type="number" step="0.01" class="form-control" id="total" name="total" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label for="prescription">Prescription Notes (Optional)</label>
                    <textarea class="form-control" id="prescription" name="prescription" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Record Sale</button>
                <a href="{{ route('salesreports.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Auto-fill category and price when medicine is selected
            $('#medicine_id').change(function() {
                var selectedOption = $(this).find('option:selected');
                var price = selectedOption.data('price');
                var categoryId = selectedOption.data('category');
                var categoryName = selectedOption.text().match(/\(([^)]+)\)/)[1];

                $('#unit_price').val(price);
                $('#category_id').val(categoryId);
                $('#category_id_display').val(categoryName);

                calculateTotal();
            });

            // Calculate total when quantity changes
            $('#quantity').on('input', calculateTotal);
            $('#unit_price').on('input', calculateTotal);

            function calculateTotal() {
                var quantity = parseFloat($('#quantity').val()) || 0;
                var unitPrice = parseFloat($('#unit_price').val()) || 0;
                var total = quantity * unitPrice;

                $('#total').val(total.toFixed(2));
            }
        });
    </script>
@endpush
