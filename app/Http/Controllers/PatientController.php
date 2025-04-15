<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all patients from the database
        $patients = Patient::paginate(3);

        // Return view with the patients data
        return view('pharmacist.dashboard.patient.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Debugging: Uncomment to see raw input
        // dd($request->all());
        
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'allergies' => 'nullable|string|max:255',
            'blood_group' => 'nullable|string|max:5',
            'dob' => 'required|date',
            'gender' => 'required|in:Male,Female,Other, male, female, other',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'caretaker' => 'nullable|string|max:255',
            'caretaker_phone' => 'nullable|string|max:15',
        ]);
    
        try {
            $patient = Patient::create($validated);
            
            return redirect()->route('patients.index')
                   ->with('success', 'Patient added successfully!');
                   
        } catch (\Exception $e) {
            return back()
                   ->with('error', 'Error saving patient: '.$e->getMessage())
                   ->withInput();
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('pharmacist.dashboard.patient.edit', compact('patient'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'allergies' => 'nullable|string|max:255',
        ]);
    
        $patient = Patient::findOrFail($id);
        $patient->update($request->all());
    
        return redirect()->route('patients.index')->with('success', 'Patient updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        try {
            // Get the patient name before deletion for the success message
            $patientName = $patient->full_name;
            
            // Delete the patient
            $patient->delete();
            
            // Redirect with success message
            return redirect()->route('patients.index')
                            ->with('success', "Patient '$patientName' has been deleted successfully!");
                            
        } catch (\Exception $e) {
            // Handle any errors that occur during deletion
            return redirect()->route('patients.index')
                            ->with('error', 'Error deleting patient: ' . $e->getMessage());
        }
    }
}
