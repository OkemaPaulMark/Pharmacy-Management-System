@extends('pharmacist.layouts.app')

@section('title', 'Pharmacy M.S - POS Terminal')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 text-gray-800">POS Terminal</h1>
    <a href="#" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addMedicineModal">
            <i class="fas fa-plus"></i> Add Medicine
        </button>
        <h6 class="m-0 font-weight-bold text-primary">Cart Items</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Medicine</th>
                        <th>Category</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Prescription</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="cartItems">
                    <!-- Cart items will be dynamically added here -->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-right font-weight-bold">Grand Total:</td>
                        <td id="grandTotal">$0.00</td>
                        <td>
                            <button id="checkoutBtn" class="btn btn-primary">Checkout</button>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Add Medicine Modal -->
<div class="modal fade" id="addMedicineModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Medicine to Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="medicineForm">
                    @csrf
                    <div class="form-group">
                        <label for="categorySelect">Category</label>
                        <select id="categorySelect" class="form-control" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" data-name="{{ $category->category }}">
                                    {{ $category->category }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="medicineSelect">Medicine</label>
                        <select id="medicineSelect" class="form-control" required>
                            <option value="">Select Medicine</option>
                            @foreach($medicines as $medicine)
                                <option value="{{ $medicine->id }}" 
                                        data-category="{{ $medicine->category_id }}"
                                        data-price="{{ $medicine->unit_price }}">
                                    {{ $medicine->name }} - ${{ number_format($medicine->unit_price, 2) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" class="form-control" min="1" value="1" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Unit Price</label>
                        <input type="number" id="price" class="form-control" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="prescription">Prescription</label>
                        <textarea id="prescription" name="prescription" class="form-control" placeholder="Enter the prescription here..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="addToCartBtn" class="btn btn-success">Add to Cart</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="invoiceContent">
                <!-- Invoice content will be generated here -->
            </div>
            <div class="modal-footer">
                <button type="button" id="printInvoiceBtn" class="btn btn-primary">
                    <i class="fas fa-print"></i> Print
                </button>
                <button type="button" id="saveDataBtn" class="btn btn-success">
                    <i class="fas fa-save"></i> Save Data
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let cart = [];
    
    // Filter medicines when category changes
    $('#categorySelect').change(function() {
        const categoryId = $(this).val();
        $('#medicineSelect option').show();
        if (categoryId) {
            $('#medicineSelect option').not('[data-category="'+categoryId+'"],:first').hide();
        }
        $('#medicineSelect').val('');
        $('#price').val('');
    });
    
    // Update price when medicine is selected
    $('#medicineSelect').change(function() {
        const price = $(this).find(':selected').data('price');
        $('#price').val(price);
    });
    
    // Add to cart functionality
    $('#addToCartBtn').click(function() {
        const medicineId = $('#medicineSelect').val();
        const medicineName = $('#medicineSelect option:selected').text().split(' - ')[0];
        const categoryId = $('#categorySelect').val();
        const categoryName = $('#categorySelect option:selected').data('name');
        const quantity = $('#quantity').val();
        const price = $('#price').val();
        const prescription = $('#prescription').val();
        const total = (price * quantity).toFixed(2);
        
        if (!medicineId || !categoryId || !quantity || !price) {
            alert('Please fill all required fields');
            return;
        }
        
        cart.push({
            medicineId,
            medicineName,
            categoryId,
            categoryName,
            quantity,
            price,
            total,
            prescription
        });
        
        updateCartDisplay();
        $('#addMedicineModal').modal('hide');
        resetForm();
    });
    
    // Checkout functionality
    $('#checkoutBtn').click(function() {
        if (cart.length === 0) {
            alert('Your cart is empty');
            return;
        }
        
        generateInvoice();
        $('#checkoutModal').modal('show');
    });
    
    // Print invoice
    $('#printInvoiceBtn').click(function() {
        window.print();
    });
    
        // Save data to database
        $('#saveDataBtn').click(function() {
            $.ajax({
                url: '{{ route("posterminal.store") }}', // Use Laravel named route
                method: 'POST',
                data: {
                    transactions: cart,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message); // Show success message
                    $('#checkoutModal').modal('hide');
                    cart = []; // Clear cart
                    updateCartDisplay(); // Update cart display
                },
                error: function(xhr) {
                    console.error(xhr.responseJSON);
                    alert('Error saving transaction: ' + (xhr.responseJSON.message || 'Unknown error'));
                }
            });
        });


        function downloadPdf() {
            // Implement your PDF generation logic here
            // This could be a route that returns a PDF download
            window.location.href = '/generate-pdf?cart=' + JSON.stringify(cart);
            
            // For now we'll just show a success message
            alert('Transactions saved to database and PDF downloaded!');
            $('#checkoutModal').modal('hide');
            cart = [];
            updateCartDisplay();
        }
    
    function updateCartDisplay() {
        const $cartItems = $('#cartItems');
        const $grandTotal = $('#grandTotal');
        let grandTotal = 0;
        
        $cartItems.empty();
        
        cart.forEach((item, index) => {
            grandTotal += parseFloat(item.total);
            
            $cartItems.append(`
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.medicineName}</td>
                    <td>${item.categoryName}</td>
                    <td>$${parseFloat(item.price).toFixed(2)}</td>
                    <td>${item.quantity}</td>
                    <td>$${item.total}</td>
                    <td>${item.prescription || 'N/A'}</td>
                    <td>
                        <button class="btn btn-danger btn-sm remove-item" data-index="${index}">
                            Remove
                        </button>
                    </td>
                </tr>
            `);
        });
        
        $grandTotal.text('$' + grandTotal.toFixed(2));
        
        // Add event listener for remove buttons
        $('.remove-item').click(function() {
            const index = $(this).data('index');
            cart.splice(index, 1);
            updateCartDisplay();
        });
    }
    
    function generateInvoice() {
        const invoiceDate = new Date().toLocaleString();
        let invoiceItems = '';
        let subtotal = 0;
        
        cart.forEach(item => {
            subtotal += parseFloat(item.total);
            invoiceItems += `
                <tr>
                    <td>${item.medicineName}</td>
                    <td>${item.quantity}</td>
                    <td>$${parseFloat(item.price).toFixed(2)}</td>
                    <td>$${item.total}</td>
                </tr>
            `;
        });
        
        const tax = subtotal * 0.1; // 10% tax
        const total = subtotal + tax;
        
        $('#invoiceContent').html(`
            <div class="invoice-header mb-4">
                <h4>Pharmacy M.S</h4>
                <p>Invoice Date: ${invoiceDate}</p>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Medicine</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    ${invoiceItems}
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right">Subtotal:</td>
                        <td>$${subtotal.toFixed(2)}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">Tax (10%):</td>
                        <td>$${tax.toFixed(2)}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right font-weight-bold">Total:</td>
                        <td class="font-weight-bold">$${total.toFixed(2)}</td>
                    </tr>
                </tfoot>
            </table>
            <div class="prescription-notes mt-4">
                <h5>Prescription Notes:</h5>
                ${cart[0].prescription ? `<p>${cart[0].prescription}</p>` : '<p>No prescription notes</p>'}
            </div>
        `);
    }
    
    function resetForm() {
        $('#medicineForm')[0].reset();
        $('#price').val('');
    }
});
</script>
@endpush