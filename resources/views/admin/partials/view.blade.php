<div class="modal-header bg-primary text-white">
    <h5 class="modal-title" id="viewMedicineModalLabel">
        <i class="fas fa-pills mr-2"></i>{{ $medicine->name }} - Details
    </h5>
    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4 border-left-primary">
                <div class="card-body">
                    <h6 class="card-title text-primary font-weight-bold">
                        <i class="fas fa-info-circle mr-2"></i>Basic Information
                    </h6>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-sm-5 font-weight-bold">Category:</div>
                        <div class="col-sm-7">
                            <span class="badge badge-info">
                                {{ $medicine->category->category ?? 'N/A' }}
                            </span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-5 font-weight-bold">Unit Price:</div>
                        <div class="col-sm-7">
                            UGX {{ number_format($medicine->unit_price, 2) }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-5 font-weight-bold">Current Stock:</div>
                        <div class="col-sm-7">
                            <span class="{{ $medicine->quantity < 10 ? 'text-danger font-weight-bold' : 'text-success' }}">
                                {{ $medicine->quantity }} units
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card mb-4 border-left-info">
                <div class="card-body">
                    <h6 class="card-title text-info font-weight-bold">
                        <i class="fas fa-truck mr-2"></i>Supplier Information
                    </h6>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-sm-5 font-weight-bold">Supplier:</div>
                        <div class="col-sm-7">{{ $medicine->supplier->supplier_name ?? 'N/A' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-5 font-weight-bold">Expiry Date:</div>
                        <div class="col-sm-7">
                            <span class="{{ $medicine->expiry_date->isPast() ? 'text-danger' : '' }}">
                                {{ $medicine->expiry_date->format('d M Y') }}
                                @if($medicine->expiry_date->isPast())
                                    <span class="badge badge-danger ml-2">EXPIRED</span>
                                @elseif($medicine->expiry_date->diffInDays(now()) < 30)
                                    <span class="badge badge-warning ml-2">EXPIRING SOON</span>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-5 font-weight-bold">Days Remaining:</div>
                        <div class="col-sm-7">
                            @if($medicine->expiry_date->isPast())
                                <span class="text-danger">Expired {{ $medicine->expiry_date->diffForHumans() }}</span>
                            @else
                                {{ $medicine->expiry_date->diffForHumans() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card border-left-secondary">
        <div class="card-body">
            <h6 class="card-title text-secondary font-weight-bold">
                <i class="fas fa-align-left mr-2"></i>Description
            </h6>
            <hr>
            <p>{{ $medicine->description ?? 'No description available' }}</p>
        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="text-muted small">
                <i class="fas fa-calendar-plus mr-1"></i>
                Added: {{ $medicine->created_at->format('d M Y h:i A') }}
            </div>
        </div>
        <div class="col-md-6 text-right">
            <div class="text-muted small">
                <i class="fas fa-calendar-edit mr-1"></i>
                Last Updated: {{ $medicine->updated_at->format('d M Y h:i A') }}
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">
        <i class="fas fa-times mr-2"></i>Close
    </button>
    <a href="{{ route('medicines.edit', $medicine->id) }}" class="btn btn-primary">
        <i class="fas fa-edit mr-2"></i>Edit Medicine
    </a>
</div>