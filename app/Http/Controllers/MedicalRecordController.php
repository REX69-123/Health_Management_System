<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\Consultation;

class MedicalRecordController extends Controller
{
    // READ (with Filter & Sort)
    public function index(Request $request)
    {
        $query = MedicalRecord::with('patient');

        // Filter by Patient Name
        if ($request->filled('search')) {
            $query->whereHas('patient', function($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->search . '%')
                  ->orWhere('last_name', 'like', '%' . $request->search . '%');
            });
        }

        // Sort by Diagnosis Date
        $sort = $request->get('sort', 'desc');
        $query->orderBy('diagnosis_date', $sort);

        $records = $query->paginate(10);

        return view('medical_records.index', compact('records'));
    }

    public function show(Patient $patient)
{
    // 1. Fetch ONLY the completed consultations for this specific patient
    // latest() sorts them so the newest visit is at the top of the timeline
    $consultations = Consultation::where('patient_id', $patient->id)
                        ->where('status', 'Completed')
                        ->latest()
                        ->get();

    // 2. Pass both the patient AND the consultations to the view
    return view('medical-records.show', compact('patient', 'consultations'));
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
