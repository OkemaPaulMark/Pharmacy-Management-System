@extends('pharmacist.layouts.app')

@section('title', 'Patient Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Patient Details</h6>
                    <a href="{{ route('patients.index') }}" class="btn btn-secondary btn-sm">
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
                                                <td>#{{ $patient->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Full Name:</th>
                                                <td>{{ $patient->full_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Date of Birth:</th>
                                                <td>{{ \Carbon\Carbon::parse($patient->dob)->format('M d, Y') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Age:</th>
                                                <td>{{ \Carbon\Carbon::parse($patient->dob)->age }} years</td>
                                            </tr>
                                            <tr>
                                                <th>Gender:</th>
                                                <td>{{ ucfirst($patient->gender) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Blood Group:</th>
                                                <td>{{ $patient->blood_group ?? 'Not Specified' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="m-0 font-weight-bold">Contact Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th width="40%">Phone:</th>
                                                <td>{{ $patient->phone }}</td>
                                            </tr>
                                            <tr>
                                                <th>Address:</th>
                                                <td>{{ $patient->address }}</td>
                                            </tr>
                                            <tr>
                                                <th>Caretaker:</th>
                                                <td>{{ $patient->caretaker ?? 'None' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Caretaker Phone:</th>
                                                <td>{{ $patient->caretaker_phone ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Registered On:</th>
                                                <td>{{ $patient->created_at->format('M d, Y') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Last Updated:</th>
                                                <td>{{ $patient->updated_at->format('M d, Y') }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Medical Information Section -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="m-0 font-weight-bold">Medical Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card mb-3">
                                                <div class="card-header bg-light">
                                                    <h6 class="m-0 font-weight-bold text-primary">Known Allergies</h6>
                                                </div>
                                                <div class="card-body">
                                                    @if($patient->allergies)
                                                        <p>{{ $patient->allergies }}</p>
                                                    @else
                                                        <p class="text-muted">No known allergies recorded</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Prescriptions Section - This is a placeholder section -->
                    <!-- If you implement prescriptions in the future, you can uncomment and adapt this section -->
                    <!--
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 bg-primary text-white">
                                    <h6 class="m-0 font-weight-bold">Prescriptions</h6>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-info">
                                        Prescription functionality will be available in a future update.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    -->

                    <!-- Action Buttons -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit Patient
                                </a>
                                <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete {{ $patient->full_name }}? This action cannot be undone!')">
                                        <i class="fas fa-trash"></i> Delete Patient
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
    .badge {
        font-size: 0.85rem;
        padding: 0.35rem 0.65rem;
    }
    .timeline {
        position: relative;
        padding: 20px 0;
    }
    .timeline-item {
        position: relative;
        padding-left: 40px;
        margin-bottom: 20px;
    }
    .timeline-item:before {
        content: '';
        position: absolute;
        left: 10px;
        top: 0;
        height: 100%;
        width: 2px;
        background-color: #e3e6f0;
    }
    .timeline-item:after {
        content: '';
        position: absolute;
        left: 4px;
        top: 8px;
        height: 14px;
        width: 14px;
        border-radius: 50%;
        background-color: #4e73df;
    }
    .timeline-date {
        font-size: 0.8rem;
        color: #858796;
        margin-bottom: 5px;
    }
    .timeline-content {
        padding: 15px;
        background-color: #f8f9fc;
        border-radius: 5px;
        border-left: 3px solid #4e73df;
    }
</style>
@endsection