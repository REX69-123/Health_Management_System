<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\Consultation;

class MedicalRecordController extends Controller
{
    public function index()
    {
        // Fetch COMPLETED consultations to act as medical records
        $records = \App\Models\Consultation::with('patient')
            ->where('status', 'Completed')
            ->latest()
            ->paginate(10); // Use paginate instead of get()

        return view('medical-records.index', compact('records'));
    }
    
    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        $consultations = Consultation::where('patient_id', $id)
            ->where('status', 'Completed')
            ->latest()
            ->get();

        // Calculate basic stats for the UI
        $lastVisit = $consultations->first()?->created_at->format('M d, Y') ?? 'No visits';
        $visitCount = $consultations->count();

        return view('medical-records.show', compact('patient', 'consultations', 'lastVisit', 'visitCount'));
    }

    // CREATE form
    public function create()
    {
        $patients = Patient::all();
        return view('medical_records.create', compact('patients'));
    }

    // SAVE new record
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'diagnosis' => 'required|string',
            'diagnosis_date' => 'required|date',
            'treatment_plan' => 'nullable|string',
        ]);

        MedicalRecord::create($request->all());

        return redirect()->route('medical-records.index')->with('success', 'Medical record added.');
    }

    // EDIT form
    public function edit($id)
    {
        $record = MedicalRecord::findOrFail($id);
        $patients = Patient::all();
        return view('medical_records.edit', compact('record', 'patients'));
    }

    // UPDATE record
    public function update(Request $request, $id)
    {
        $record = MedicalRecord::findOrFail($id);
        $record->update($request->all());

        return redirect()->route('medical-records.index')->with('success', 'Record updated.');
    }

    // DELETE record
    public function destroy($id)
    {
        MedicalRecord::destroy($id);
        return redirect()->route('medical-records.index')->with('success', 'Record deleted.');
    }
}
