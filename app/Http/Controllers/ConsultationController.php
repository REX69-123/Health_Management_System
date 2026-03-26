<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Patient;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    // READ: Show the table of all consultations
    public function index()
    {
        // Fetch all consultations with the related patient data
        $consultations = Consultation::with('patient')->latest()->get();
        return view('consultations.index', compact('consultations'));
    }

    // CREATE: Show the form
    public function create()
    {
        $patients = Patient::orderBy('last_name')->get(); // Get patients for the dropdown
        return view('consultations.create', compact('patients'));
    }

    // STORE: Save to database
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'chief_complaint' => 'required|string',
            'status' => 'required|in:Pending Doctor Review,Completed',
        ]);

        Consultation::create([
            'patient_id' => $request->patient_id,
            'admin_id' => $request->user()->id,
            'blood_pressure' => $request->blood_pressure,
            'heart_rate' => $request->heart_rate,
            'temperature' => $request->temperature,
            'weight_kg' => $request->weight_kg,
            'chief_complaint' => $request->chief_complaint,
            'assessment' => $request->assessment,
            'diagnosis' => $request->diagnosis,
            'prescription' => $request->prescription,
            'status' => $request->status,
        ]);

        return redirect()->route('consultations.index')->with('success', 'Consultation logged successfully.');
    }

    // READ: View a single consultation record
    public function show(Consultation $consultation)
    {
        return view('consultations.show', compact('consultation'));
    }

    // UPDATE: Show the edit form
    public function edit(Consultation $consultation)
    {
        $patients = Patient::orderBy('last_name')->get();
        return view('consultations.edit', compact('consultation', 'patients'));
    }

    // UPDATE: Save the edited changes
    public function update(Request $request, Consultation $consultation)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'chief_complaint' => 'required|string',
            'status' => 'required|in:Pending Doctor Review,Completed',
        ]);

        $consultation->update([
            'patient_id' => $request->patient_id,
            'blood_pressure' => $request->blood_pressure,
            'heart_rate' => $request->heart_rate,
            'temperature' => $request->temperature,
            'weight_kg' => $request->weight_kg,
            'chief_complaint' => $request->chief_complaint,
            'assessment' => $request->assessment,
            'diagnosis' => $request->diagnosis,
            'prescription' => $request->prescription,
            'status' => $request->status,
        ]);

        if ($request->status === 'Completed' && $request->diagnosis) {
            $patient = $consultation->patient;

            // Check if the diagnosis isn't already in their notes to avoid duplicates
            if (!str_contains($patient->chronic_conditions ?? '', $request->diagnosis)) {
                $newConditions = $patient->chronic_conditions
                    ? $patient->chronic_conditions . ', ' . $request->diagnosis
                    : $request->diagnosis;

                $patient->update(['chronic_conditions' => $newConditions]);
            }
        }

        return redirect()->route('consultations.index')->with('success', 'Consultation updated successfully.');
    }

    // DELETE: Remove the record
    public function destroy(Consultation $consultation)
    {
        $consultation->delete();
        return redirect()->route('consultations.index')->with('success', 'Consultation record deleted.');
    }
}
