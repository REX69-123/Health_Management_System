<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    /**
     * 0. Show the Admin Dashboard (List all patients)
     */
    public function index()
    {
        // Fetch your patients (adjust the query as needed for your app)
        $patients = \App\Models\Patient::all();

        // Pass them to the view
        return view('patients.index', compact('patients'));
    }

    /**
     * 0.5 Show the form to add a new patient
     */
    public function create()
    {
        // Ensure you have a file at: resources/views/patients/create.blade.php
        return view('patients.create');
    }

    /**
     * 1. Save a new patient
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|unique:patients,email',
            'dob'        => 'required|date',
            'gender'     => 'required',
        ]);

        Patient::create([
            'patient_number' => 'PNT-' . strtoupper(uniqid()),
            'first_name'     => $request->first_name,
            'last_name'      => $request->last_name,
            'email'          => $request->email,
            'dob'            => $request->dob,
            'gender'         => $request->gender,
            'status'         => 'Active',
        ]);

        return redirect()->route('patients.index')->with('success', 'Patient added successfully!');
    }

    /**
     * 2. Show the edit form
     */
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    /**
     * 3. Update the patient data
     */
    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|unique:patients,email,' . $id,
            'dob'        => 'required|date',
            'gender'     => 'required',
        ]);

        $patient->update($request->all());

        return redirect()->route('patients.index')->with('success', 'Patient updated successfully!');
    }

    /**
     * 4. Delete the patient
     */
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Patient record deleted.');
    }
}
