<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientHistory;
use App\Models\Patient;

class MedicalhistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::orderBy('full_name')->pluck('full_name', 'id');
        // Using paginate to display 10 records per page
        $histories = PatientHistory::with('patient')->latest()->paginate(3);

        return view('pharmacist.dashboard.medicalhistory.index', compact('patients', 'histories'));
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
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'blood_group' => 'nullable|string',
            'allergies' => 'nullable|string',
            'chronic_conditions' => 'nullable|string',
            'current_medications' => 'nullable|string',
            'special_notes' => 'nullable|string',
        ]);
    
        try {
            PatientHistory::create([
                'patient_id' => $request->patient_id,
                'blood_group' => $request->blood_group,
                'allergies' => $request->allergies,
                'chronic_conditions' => $request->chronic_conditions,
                'current_medications' => $request->current_medications,
                'special_notes' => $request->special_notes,
            ]);
    
            return redirect()->back()->with('success', 'Medical History Saved Successfully');
    
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
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
        $history = PatientHistory::findOrFail($id); 
        $patients = Patient::all();
    
        return view('pharmacist.dashboard.medicalhistory.edit', compact('history', 'patients'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'blood_group' => 'required',
            'allergies' => 'nullable|string',
            'chronic_conditions' => 'nullable|string',
            'current_medications' => 'nullable|string',
            'patient_id' => 'required|exists:patients,id',
        ]);
    
        $history = PatientHistory::findOrFail($id);
        $history->update($request->all());
    
        return redirect()->route('medicalhistories.index')->with('success', 'Medical history updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $history = PatientHistory::findOrFail($id);
        $history->delete();
    
        return redirect()->route('medicalhistories.index')->with('success', 'Medical history deleted successfully.');
    }
}