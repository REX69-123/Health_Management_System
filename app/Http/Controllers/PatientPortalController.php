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
        $patient = Auth::guard('patient')->user();

        // Check if the appointments table uses 'patient_id' (integer)
        // or a string identifier like the one seen in your screenshot
        $nextAppointment = Appointment::where('patient_id', $patient->id)
            ->where('appointment_date', '>=', now()->toDateString())
            ->orderBy('appointment_date', 'asc')
            ->first();

        // Do the same for Medical Records
        $records = MedicalRecord::where('patient_id', $patient->id)
            ->latest()
            ->get();

        // Calculate days left (same logic as before)
        $daysLeft = null;
        if ($nextAppointment) {
            $daysLeft = (int) now()->startOfDay()->diffInDays(\Carbon\Carbon::parse($nextAppointment->appointment_date), false);
        }

        return view('portal.dashboard', compact('patient', 'nextAppointment', 'daysLeft', 'records'));
    }
}
