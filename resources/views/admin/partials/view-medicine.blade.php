<div class="container-fluid">
    <h4 class="mb-3 text-primary">{{ $medicine->name }}</h4>

    <div class="row">
        <div class="col-md-6">
            <p><strong>Category:</strong> {{ $medicine->category->category ?? 'N/A' }}</p>
            <p><strong>Supplier:</strong> {{ $medicine->supplier->supplier_name ?? 'N/A' }}</p>
            <p><strong>Quantity Available:</strong> {{ $medicine->quantity }}</p>
        </div>

        <div class="col-md-6">
            <p><strong>Unit Price:</strong> UGX {{ number_format($medicine->unit_price, 2) }}</p>
            <p><strong>Expiry Date:</strong> {{ \Carbon\Carbon::parse($medicine->expiry_date)->format('d/m/Y') }}</p>
        </div>
    </div>

    <div class="mt-3">
        <p><strong>Description:</strong></p>
        <p>{{ $medicine->description ?? 'No description available.' }}</p>
    </div>
</div>
