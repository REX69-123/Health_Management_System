<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
// Remove App\Models\User if patients shouldn't be in the admin table
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::query();

        // SEARCH LOGIC
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('patient_number', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // FILTER LOGIC
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // SORT LOGIC
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'name_asc':
                $query->orderBy('first_name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('first_name', 'desc');
                break;
            case 'oldest':
                $query->oldest();
                break;
            default:
                $query->latest();
                break;
        }

        $patients = $query->paginate(10); // Use paginate for industry-level performance

        $totalPatients = Patient::count();
        $activePatients = Patient::where('status', 'Active')->count();

        return view('patients.index', compact('patients', 'totalPatients', 'activePatients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:patients,email',
            'dob'        => 'required|date',
            'gender'     => 'required|in:Male,Female,Other',
        ]);

        $patient = Patient::create([
            'patient_number' => 'PNT-' . strtoupper(Str::random(6)),
            'first_name'     => $request->first_name,
            'last_name'      => $request->last_name,
            'email'          => $request->email,
            'dob'  => $request->dob, // Fixed column name mismatch (dob vs date_of_birth)
            'gender'         => $request->gender,
            'status'         => 'Active',
        ]);

        return redirect()->route('patients.account.create', $patient->id);
    }

    public function createAccount($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.create_account', compact('patient'));
    }

    /**
     * FIX: Save credentials to the PATIENT table, not the USER table.
     */
    public function storeAccount(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $request->validate([
            // REMOVE 'confirmed' from here:
            'password' => 'nullable|min:6',
        ]);

        // Save to the patient's record
        $patient->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('patients.index')->with('success', 'Patient portal access granted!');
    }
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|unique:patients,email,' . $id,
            'dob'        => 'required|date',
            'gender'     => 'required',
            'password' => 'nullable|min:6', // Now it only expects one password field,
        ]);

        $data = $request->except('password', 'password_confirmation');
        $data['date_of_birth'] = $request->dob; // Sync naming

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $patient->update($data);

        return redirect()->route('patients.index')->with('success', 'Patient updated successfully!');
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Patient record deleted.');
    }
}
