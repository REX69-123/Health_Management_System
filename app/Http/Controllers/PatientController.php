<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        // 1. Start the main table query
        $query = \App\Models\Patient::query();

        // 2. SEARCH LOGIC
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('patient_number', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // 3. FILTER LOGIC
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 4. SORT LOGIC
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $query->orderBy('first_name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('first_name', 'desc');
                    break;
                case 'oldest':
                    $query->oldest();
                    break;
                case 'newest':
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        $patients = $query->get();

        // --- NEW: Calculate Dashboard Stats ---
        $totalPatients = \App\Models\Patient::count();
        $activePatients = \App\Models\Patient::where('status', 'Active')->count();

        // Pass everything to the view
        return view('patients.index', compact('patients', 'totalPatients', 'activePatients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    /**
     * STEP 1: Save the Medical Profile, then redirect to Account Creation
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

        $patient = Patient::create([
            'patient_number' => 'PNT-' . strtoupper(Str::random(6)),
            'first_name'     => $request->first_name,
            'last_name'      => $request->last_name,
            'email'          => $request->email,
            'dob'            => $request->dob,
            'gender'         => $request->gender,
            'status'         => 'Active',
        ]);

        // Redirect Admin to Step 2 with the newly created Patient ID
        return redirect()->route('patients.account.create', $patient->id);
    }

    /**
     * STEP 2 (VIEW): Show the Portal Login creation form
     */
    public function createAccount($id)
    {
        $patient = Patient::findOrFail($id);
        // Assumes you created the resources/views/patients/create_account.blade.php file!
        return view('patients.create_account', compact('patient'));
    }

    /**
     * STEP 2 (PROCESS): Save the User Login credentials
     */
    public function storeAccount(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $request->validate([
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'     => $patient->first_name . ' ' . $patient->last_name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'patient',
        ]);

        return redirect()->route('patients.index')->with('success', 'Patient profile and portal login created successfully!');
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
            'password'   => 'nullable|min:6', // Validate password only if provided
        ]);

        // Update Patient Model
        $patient->update($request->except('password'));

        // If a password was typed in, update the related Portal User account
        if ($request->filled('password')) {
            $user = \App\Models\User::where('email', $patient->email)->first();
            if ($user) {
                $user->update([
                    'password' => bcrypt($request->password)
                ]);
            }
        }

        return redirect()->route('patients.index')->with('success', 'Patient updated successfully!');
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);

        // Also delete their User account if it exists
        $user = User::where('email', $patient->email)->first();
        if ($user) {
            $user->delete();
        }

        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Patient record deleted.');
    }
}
