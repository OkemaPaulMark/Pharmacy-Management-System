@extends('pharmacist.layouts.app')

@section('title', 'Edit Patient')

@section('content')
<div class="modal fade show" id="editPatientModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: block; padding-right: 17px;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Patient</h5>
                <a href="{{ route('patients.index') }}" class="close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('patients.update', $patient->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label>Full Name*</label>
                        <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $patient->full_name) }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date of Birth*</label>
                                <input type="date" name="dob" class="form-control" value="{{ old('dob', $patient->dob) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gender*</label>
                                <select name="gender" class="form-control" required>
                                    <option value="Male" {{ old('gender', $patient->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender', $patient->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('gender', $patient->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Phone*</label>
                        <input type="tel" name="phone" class="form-control" value="{{ old('phone', $patient->phone) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Address*</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address', $patient->address) }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Caretaker</label>
                                <input type="text" name="caretaker" class="form-control" value="{{ old('caretaker', $patient->caretaker) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Caretaker Phone</label>
                                <input type="tel" name="caretaker_phone" class="form-control" value="{{ old('caretaker_phone', $patient->caretaker_phone) }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Blood Group</label>
                        <select name="blood_group" class="form-control">
                            <option value="">-- Select --</option>
                            @php
                                $bloodGroups = ['A+', 'B+', 'O+', 'AB+', 'A-', 'B-', 'O-', 'AB-'];
                            @endphp
                            @foreach($bloodGroups as $group)
                                <option value="{{ $group }}" {{ old('blood_group', $patient->blood_group) == $group ? 'selected' : '' }}>
                                    {{ $group }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Known Allergies</label>
                        <textarea name="allergies" class="form-control" placeholder="List any known allergies">{{ old('allergies', $patient->allergies) }}</textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update Patient</button>
                        <a href="{{ route('patients.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal-backdrop fade show"></div>

@endsection