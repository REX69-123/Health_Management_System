<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class PatientPortalController extends Controller
{
    public function dashboard()
    {
        $userEmail = Auth::user()->email;

        // This query is what caused the error because 'email' was missing in SQL
        $appointments = Appointment::where('email', $userEmail)
            ->orderBy('appointment_date', 'asc')
            ->get();

        $records = MedicalRecord::where('email', $userEmail)
            ->latest()
            ->get();

        return view('portal.dashboard', compact('appointments', 'records'));
    }
}
