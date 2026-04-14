<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    public function index()
    {
        $consultations = Consultation::with('patient')->latest()->get();
        return view('consultations.index', compact('consultations'));
    }

    public function create()
    {
        $patients = Patient::orderBy('last_name')->get();
        return view('consultations.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'chief_complaint' => 'required|string',
            'status' => 'required|in:Pending Doctor Review,Completed',
        ]);

        $consultation = Consultation::create([
            'patient_id'      => $request->patient_id,
            'admin_id'        => Auth::id(),
            'blood_pressure'  => $request->blood_pressure,
            'heart_rate'      => $request->heart_rate,
            'temperature'     => $request->temperature,
            'weight_kg'       => $request->weight_kg,
            'chief_complaint' => $request->chief_complaint,
            'assessment'      => $request->assessment,
            'diagnosis'       => $request->diagnosis,
            'prescription'    => $request->prescription,
            'status'          => $request->status,
        ]);

        if ($consultation->status === 'Completed') {
            return redirect()->route('medical-records.index')
                ->with('success', 'Consultation finalized and added to Medical Records table.');
        }

        return redirect()->route('consultations.index')
            ->with('success', 'Consultation saved as pending.');
    }

    public function update(Request $request, Consultation $consultation)
    {
        $request->validate([
            'chief_complaint' => 'required|string',
            'status'          => 'required|in:Pending Doctor Review,Completed',
        ]);

        $consultation->update($request->all());

        if ($consultation->status === 'Completed') {
            return redirect()->route('medical-records.index')
                ->with('success', 'Record updated and moved to Medical Records table.');
        }

        return redirect()->route('consultations.index')
            ->with('success', 'Consultation updated successfully.');
    }

    public function show(Consultation $consultation)
    {
        return view('consultations.show', compact('consultation'));
    }

    public function edit(Consultation $consultation)
    {
        $patients = Patient::orderBy('last_name')->get();
        return view('consultations.edit', compact('consultation', 'patients'));
    }

    public function destroy(Consultation $consultation)
    {
        $consultation->delete();
        return redirect()->route('consultations.index')->with('success', 'Consultation record deleted.');
    }
}
