@extends('pharmacist.layouts.app')

@section('title', 'Edit Medical History')

@section('content')
<div class="modal fade show" id="editMedicalHistoryModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: block; padding-right: 17px;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Medical History</h5>
                <a href="{{ route('medicalhistories.index') }}" class="close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
            <form action="{{ route('medicalhistories.update', $history->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Patient*</label>
                    <select name="patient_id" class="form-control" required>
                        <option value="">-- Select Patient --</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{ old('patient_id', $history->patient_id) == $patient->id ? 'selected' : '' }}>
                                {{ $patient->full_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Blood Group*</label>
                    <input type="text" name="blood_group" class="form-control" value="{{ old('blood_group', $history->blood_group) }}" required>
                </div>

                <div class="form-group">
                    <label>Allergies*</label>
                    <textarea name="allergies" class="form-control" required>{{ old('allergies', $history->allergies) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Chronic Conditions</label>
                    <textarea name="chronic_conditions" class="form-control">{{ old('chronic_conditions', $history->chronic_conditions) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Current Medications</label>
                    <textarea name="current_medications" class="form-control">{{ old('current_medications', $history->current_medications) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Special Notes</label>
                    <textarea name="special_notes" class="form-control">{{ old('special_notes', $history->special_notes) }}</textarea>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update Record</button>
                    <a href="{{ route('medicalhistories.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>

            </div>
        </div>
    </div>
</div>

<div class="modal-backdrop fade show"></div>
@endsection
