@extends('pharmacist.layouts.app')

@section('title', 'Pharmacy M.S')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 text-gray-800">Medical History</h1>
    <a href="#" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addMedicalHistoryModal">
            <i class="fas fa-plus"></i> Add Medical History
        </button>
        <h6 class="m-0 font-weight-bold text-primary">Patient Medical Records</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Patient Name</th>
                        <th>Blood Group</th>
                        <th>Allergies</th>
                        <th>Chronic Conditions</th>
                        <th>Current Meds</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($histories as $history)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $history->patient->full_name }}</td>
                            <td>{{ $history->blood_group }}</td>
                            <td>{{ $history->allergies }}</td>
                            <td>{{ $history->chronic_conditions }}</td>
                            <td>{{ $history->current_medications }}</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm">View</a>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Medical History Modal -->
<div class="modal fade" id="addMedicalHistoryModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Medical History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('medicalhistories.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="patient_id">Patient*</label>
                        <select name="patient_id" class="form-control" required id="patientSelect">
                            <option value="">Select Patient</option>
                            @foreach($patients as $id => $full_name)
                            <option value="{{ $id }}">{{ $full_name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="blood_group">Blood Group*</label>
                                <select name="blood_group" class="form-control" required>
                                    <option value="">-- Select --</option>
                                    <option value="A+">A+</option>
                                    <option value="B+">B+</option>
                                    <option value="O+">O+</option>
                                    <option value="AB+">AB+</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="allergies">Known Allergies</label>
                        <textarea name="allergies" class="form-control" placeholder="List all known allergies (e.g., Penicillin, NSAIDs)"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="chronic_conditions">Chronic Conditions</label>
                        <input type="text" name="chronic_conditions" class="form-control" placeholder="e.g., Diabetes, Hypertension">
                    </div>

                    <div class="form-group">
                        <label for="current_meds">Current Medications</label>
                        <textarea name="current_medications" class="form-control" placeholder="List current medications with dosages"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="special_notes">Special Notes</label>
                        <textarea name="special_notes" class="form-control" placeholder="Any additional medical notes"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Record</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
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

    <script>
        // You can add medical history specific scripts here
        $(document).ready(function() {
            // Initialize any select2 dropdowns if needed
            $('#patientSelect').select2({
                placeholder: "Search for a patient",
                allowClear: true
            });
        });
    </script>
@endpush
