@extends('pharmacist.layouts.app')

@section('title', 'Pharmacy M.S')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 text-gray-800">Patients</h1>
    <a href="#" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addPatientModal">
            <i class="fas fa-plus"></i> Add Patient
        </button>
        <h6 class="m-0 font-weight-bold text-primary">Patient Records</h6>
    </div>
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
         @endif

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Allergies</th>
                        <th>Blood Group</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Caretaker</th>
                        <th>Caretaker Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patients as $patient)
                    <tr>
                        <td>{{ $patient->id }}</td>
                        <td>{{ $patient->full_name }}</td>
                        <td>{{ $patient->allergies }}</td>
                        <td>{{ $patient->blood_group }}</td>
                        <td>{{ $patient->dob }}</td>
                        <td>{{ ucfirst($patient->gender) }}</td>
                        <td>{{ $patient->phone }}</td>
                        <td>{{ $patient->address }}</td>
                        <td>{{ $patient->caretaker }}</td>
                        <td>{{ $patient->caretaker_phone }}</td>
                        <td>
                        <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" 
                                    onclick="return confirm('Are you sure you want to delete {{ $patient->full_name }}? This action cannot be undone!')">
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
            {{ $patients->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<!-- Add Patient Modal -->
<div class="modal fade" id="addPatientModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Patient Registration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('patients.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label>Full Name*</label>
                        <input type="text" name="full_name" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date of Birth*</label>
                                <input type="date" name="dob" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gender*</label>
                                <select name="gender" class="form-control" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                                
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Phone*</label>
                        <input type="tel" name="phone" class="form-control" required>
                    </div>



                    <div class="form-group">
                        <label>Address*</label>
                        <input type="text" name="address" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Caretaker</label>
                                <input type="text" name="caretaker" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Caretaker Phone</label>
                                <input type="tel" name="caretaker_phone" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Blood Group</label>
                        <select name="blood_group" class="form-control">
                            <option value="">-- Select --</option>
                            <option value="A+">A+</option>
                            <option value="B+">B+</option>
                            <option value="O+">O+</option>
                            <option value="AB+">AB+</option>
                            <option value="A-">A-</option>
                            <option value="B-">B-</option>
                            <option value="O-">O-</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Known Allergies</label>
                        <textarea name="allergies" class="form-control" placeholder="List any known allergies"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Patient</button>
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
@endpush
