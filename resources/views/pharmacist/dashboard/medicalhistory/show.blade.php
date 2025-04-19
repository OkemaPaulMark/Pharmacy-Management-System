@extends('pharmacist.layouts.app')

@section('title', 'Medical History Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Medical History Details</h6>
                    <a href="{{ route('medicalhistories.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Patient Information -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="m-0 font-weight-bold">Patient Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th width="40%">Patient ID:</th>
                                                <td>#{{ $history->patient->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Patient Name:</th>
                                                <td>{{ $history->patient->full_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Date of Birth:</th>
                                                <td>{{ \Carbon\Carbon::parse($history->patient->dob)->format('M d, Y') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Age:</th>
                                                <td>{{ \Carbon\Carbon::parse($history->patient->dob)->age }} years</td>
                                            </tr>
                                            <tr>
                                                <th>Gender:</th>
                                                <td>{{ ucfirst($history->patient->gender) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Contact:</th>
                                                <td>{{ $history->patient->phone }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="text-center mt-3">
                                        <a href="{{ route('patients.show', $history->patient->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-user"></i> View Patient Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Record Information -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="m-0 font-weight-bold">Record Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th width="40%">Record ID:</th>
                                                <td>#{{ $history->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Blood Group:</th>
                                                <td>{{ $history->blood_group }}</td>
                                            </tr>
                                            <tr>
                                                <th>Created On:</th>
                                                <td>{{ $history->created_at->format('M d, Y h:i A') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Last Updated:</th>
                                                <td>{{ $history->updated_at->format('M d, Y h:i A') }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Medical Details Section -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="m-0 font-weight-bold">Medical Details</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card mb-3">
                                                <div class="card-header bg-light">
                                                    <h6 class="m-0 font-weight-bold text-primary">Allergies</h6>
                                                </div>
                                                <div class="card-body">
                                                    @if($history->allergies)
                                                        <p>{{ $history->allergies }}</p>
                                                    @else
                                                        <p class="text-muted">No allergies recorded</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card mb-3">
                                                <div class="card-header bg-light">
                                                    <h6 class="m-0 font-weight-bold text-primary">Chronic Conditions</h6>
                                                </div>
                                                <div class="card-body">
                                                    @if($history->chronic_conditions)
                                                        <p>{{ $history->chronic_conditions }}</p>
                                                    @else
                                                        <p class="text-muted">No chronic conditions recorded</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="card mb-3">
                                                <div class="card-header bg-light">
                                                    <h6 class="m-0 font-weight-bold text-primary">Current Medications</h6>
                                                </div>
                                                <div class="card-body">
                                                    @if($history->current_medications)
                                                        <p>{{ $history->current_medications }}</p>
                                                    @else
                                                        <p class="text-muted">No current medications recorded</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="card mb-3">
                                                <div class="card-header bg-light">
                                                    <h6 class="m-0 font-weight-bold text-primary">Special Notes</h6>
                                                </div>
                                                <div class="card-body">
                                                    @if($history->special_notes)
                                                        <p>{{ $history->special_notes }}</p>
                                                    @else
                                                        <p class="text-muted">No special notes recorded</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('medicalhistories.edit', $history->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit Record
                                </a>
                                <form action="{{ route('medicalhistories.destroy', $history->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this medical history record? This action cannot be undone!')">
                                        <i class="fas fa-trash"></i> Delete Record
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card-header {
        padding: 0.75rem 1.25rem;
    }
    .table-borderless td, .table-borderless th {
        border: 0;
    }
    .card {
        border: 1px solid rgba(0, 0, 0, 0.125);
    }
    .card-body p {
        margin-bottom: 0;
    }
</style>
@endsection