<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PatientPortalController extends Controller
{
    public function dashboard()
    {
        // 1. Force the guard to 'patient' to get the logged-in patient's data
        $patient = Auth::guard('patient')->user();

        // 2. If no one is logged in, send them back to login
        if (!$patient) {
            return redirect()->route('portal.login');
        }

        // 3. Get their records
        $consultations = \App\Models\Consultation::where('patient_id', $patient->id)
            ->where('status', 'Completed')
            ->latest()
            ->get();

        // 4. CRITICAL: You must include 'patient' in the compact() call
        return view('portal.dashboard', compact('patient', 'consultations'));
    }
}
