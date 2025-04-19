<!-- Modal: Add Medicine -->
<div class="modal fade" id="addMedicineModal" tabindex="-1" role="dialog" aria-labelledby="addMedicineModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form method="POST" action="{{ route('medicines.store') }}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addMedicineModalLabel">Add New Medicine</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Medicine Name</label>
            <input type="text" class="form-control" name="name" required>
          </div>

          <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control select2" name="category_id" required>
              <option value="">-- Select Category --</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="unit_price">Unit Price</label>
            <input type="number" class="form-control" name="unit_price" id="unit_price" required>
          </div>

          <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" name="quantity" id="quantity" required>
          </div>

          <div class="form-group">
            <label for="total_price">Total Price</label>
            <input type="text" class="form-control" id="total_price" readonly>
          </div>

          <div class="form-group">
            <label for="supplier_id">Supplier</label>
            <select class="form-control select2" name="supplier_id">
              <option value="">-- Select Supplier --</option>
              @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="expiry_date">Expiry Date</label>
            <input type="date" class="form-control" name="expiry_date" id="expiry_date" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add Medicine</button>
        </div>
      </div>
    </form>
  </div>
</div>
