@extends('admin.layouts.app')

@section('title', 'Pharmacy M.S')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 text-gray-800">POS Terminal</h1>
    <a href="#" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Cart Items</h6>
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
                    <th>Medicine</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Paracetamol</td>
                    <td>Painkiller</td>
                    <td>$5</td>
                    <td>10</td>
                    <td>$50</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm">View</a>
                        <a href="#" class="btn btn-warning btn-sm">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Amoxicillin</td>
                    <td>Antibiotic</td>
                    <td>$8</td>
                    <td>5</td>
                    <td>$40</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm">View</a>
                        <a href="#" class="btn btn-warning btn-sm">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Cough Syrup</td>
                    <td>Cough & Cold</td>
                    <td>$12</td>
                    <td>3</td>
                    <td>$36</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm">View</a>
                        <a href="#" class="btn btn-warning btn-sm">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-right font-weight-bold">Grand Total:</td>
                        <td id="grandTotal">0.00</td>
            <!-- When someone clicks on this checkout button i want it to show a modal with the invoice detilas and then click print and pdf is downloaded -->
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
                    <div class="form-group">
                        <label for="patientSearch">Patient (Optional)</label>
                        <input type="text" id="patientSearch" class="form-control" placeholder="Search patient...">
                    </div>
                    <div class="form-group">
                        <label for="medicineSelect">Category</label>
                        <select id="medicineSelect" class="form-control" required>
                        <option value="">Select Category</option>
                        <option value="Pain Reliever">Pain Reliever</option>
                        <option value="Antibiotic">Antibiotic</option>
                        <option value="Anti-Inflammatory">Anti-Inflammatory</option>
                        <option value="Cough & Cold">Cough & Cold</option>
                        <option value="Cardiovascular">Cardiovascular</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="medicineSelect">Medicine</label>
                        <select id="medicineSelect" class="form-control" required>
                        <option value="">Select Medicine</option>
                        <option value="Paracetamol">Paracetamol</option>
                        <option value="Amoxicillin">Amoxicillin</option>
                        <option value="Ibuprofen">Ibuprofen</option>
                        <option value="Cough Syrup">Cough Syrup</option>
                        <option value="Aspirin">Aspirin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" class="form-control" min="1" value="1" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Unit Price</label>
                        <input type="text" id="price" class="form-control" readonly>
                    </div>
                    <div class="form-group" id="batchField" style="display: none;">
                        <label for="batchSelect">Batch</label>
                        <select id="batchSelect" class="form-control"></select>
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
@endsection

@push('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    
    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
@endpush


@section('page_scripts')
<script>
    // Cart array to store items
    let cart = [];
    let grandTotal = 0;
    
    // Initialize DataTable
    $(document).ready(function() {
        $('#posTable').DataTable({
            responsive: true,
            paging: false,
            searching: false,
            info: false
        });
        
        // Update price when medicine is selected
        $('#medicineSelect').change(function() {
            const selectedOption = $(this).find('option:selected');
            const price = selectedOption.data('price');
            const stock = selectedOption.data('stock');
            
            $('#price').val(price);
            $('#quantity').attr('max', stock);
            
            // Show/hide batch selection based on medicine
            if (selectedOption.data('hasBatches')) {
                $('#batchField').show();
                // Load batches via AJAX if needed
            } else {
                $('#batchField').hide();
            }
        });
        
        // Add to cart button click
        $('#addToCartBtn').click(function() {
            const medicineId = $('#medicineSelect').val();
            const medicineName = $('#medicineSelect option:selected').data('name');
            const category = $('#medicineSelect option:selected').data('category');
            const price = parseFloat($('#price').val());
            const quantity = parseInt($('#quantity').val());
            const stock = parseInt($('#medicineSelect option:selected').data('stock'));
            
            if (!medicineId) {
                alert('Please select a medicine');
                return;
            }
            
            if (quantity > stock) {
                alert(`Only ${stock} units available in stock!`);
                return;
            }
            
            // Add to cart
            const item = {
                id: medicineId,
                name: medicineName,
                category: category,
                price: price,
                quantity: quantity,
                total: price * quantity
            };
            
            cart.push(item);
            updateCartTable();
            
            // Reset form and close modal
            $('#medicineSelect').val('');
            $('#price').val('');
            $('#quantity').val(1);
            $('#batchField').hide();
            
            const modal = new Modal(document.getElementById('addMedicineModal'));
            modal.hide();
        });
        
        // Checkout button click
        $('#checkoutBtn').click(function() {
            if (cart.length === 0) {
                alert('Cart is empty!');
                return;
            }
            
            $('#checkoutTotal').val(grandTotal.toFixed(2));
            const modal = new Modal(document.getElementById('checkoutModal'));
            modal.show();
        });
        
        // Calculate change when amount tendered changes
        $('#amountTendered').on('input', function() {
            const tendered = parseFloat($(this).val()) || 0;
            const change = tendered - grandTotal;
            $('#changeAmount').val(change.toFixed(2));
        });
        
        // Complete sale button
        $('#completeSaleBtn').click(function() {
            const paymentMethod = $('#paymentMethod').val();
            const amountTendered = parseFloat($('#amountTendered').val()) || 0;
            
            if (amountTendered < grandTotal && paymentMethod === 'cash') {
                alert('Amount tendered is less than total amount!');
                return;
            }
            
            // Prepare data for AJAX request
            const saleData = {
                patient_id: $('#patientId').val(),
                items: cart,
                payment_method: paymentMethod,
                amount_tendered: amountTendered,
                total: grandTotal
            };
            
            // Send data to server
            $.ajax({
                url: '/api/sales',
                method: 'POST',
                data: saleData,
                success: function(response) {
                    alert('Sale completed successfully! Invoice #' + response.invoice_number);
                    // Reset cart
                    cart = [];
                    grandTotal = 0;
                    updateCartTable();
                    
                    // Close modal
                    const modal = new Modal(document.getElementById('checkoutModal'));
                    modal.hide();
                    
                    // Optionally print invoice
                    window.open('/invoices/' + response.id + '/print', '_blank');
                },
                error: function(xhr) {
                    alert('Error processing sale: ' + xhr.responseJSON.message);
                }
            });
        });
    });
    
    // Update cart table function
    function updateCartTable() {
        const tbody = $('#cartItems');
        tbody.empty();
        grandTotal = 0;
        
        cart.forEach((item, index) => {
            grandTotal += item.total;
            
            const row = `
                <tr>
                    <td class="px-6 py-4">${index + 1}</td>
                    <td class="px-6 py-4">${item.name}</td>
                    <td class="px-6 py-4">${item.category}</td>
                    <td class="px-6 py-4">${item.price.toFixed(2)}</td>
                    <td class="px-6 py-4">${item.quantity}</td>
                    <td class="px-6 py-4">${item.total.toFixed(2)}</td>
                    <td class="px-6 py-4">
                        <button onclick="removeFromCart(${index})" class="text-red-600 hover:text-red-800">
                            Remove
                        </button>
                    </td>
                </tr>
            `;
            
            tbody.append(row);
        });
        
        $('#grandTotal').text(grandTotal.toFixed(2));
    }
    
    // Remove item from cart
    function removeFromCart(index) {
        cart.splice(index, 1);
        updateCartTable();
    }
</script>
@endsection