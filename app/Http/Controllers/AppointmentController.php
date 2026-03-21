<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display the Appointment Dashboard with Stats
     */
    public function index()
    {
        $todayCount = Appointment::whereDate('appointment_date', \Carbon\Carbon::today())->count();
        $upcomingCount = Appointment::whereDate('appointment_date', '>', \Carbon\Carbon::today())->count();
        $rescheduledCount = Appointment::where('status', 'Rescheduled')->count();

        // This defines the variable causing the error
        $appointments = Appointment::with('patient')->latest()->paginate(10);

        return view('appointments.index', compact(
            'todayCount',
            'upcomingCount',
            'rescheduledCount',
            'appointments'
        ));
    }

    /**
     * Show the form to create a new appointment
     */
    public function create()
    {
        // Get all patients so we can select them in the dropdown
        $patients = \App\Models\Patient::orderBy('last_name', 'asc')->get();
        return view('appointments.create', compact('patients'));
    }

    /**
     * Store a new appointment
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'purpose'    => 'required|string|max:255',
            'date'       => 'required|date|after_or_equal:today',
            'time'       => 'required',
            'notes'      => 'nullable|string',
        ]);

        \App\Models\Appointment::create([
            'patient_id'       => $request->patient_id,
            'appointment_date' => $request->date,
            'appointment_time' => $request->time,
            'purpose'          => $request->purpose,
            'notes'            => $request->notes,
            'status'           => 'Pending',
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment scheduled!');
    }

    /**
     * Show the form for rescheduling
     */
    public function edit($id)
    {
        $appointment = Appointment::with('patient')->findOrFail($id);
        // Optional: Only if you want to allow changing the patient
        $patients = Patient::all();

        return view('appointments.edit', compact('appointment', 'patients'));
    }

    /**
     * Update the appointment (Reschedule)
     */
    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $request->validate([
            'date'   => 'required|date|after_or_equal:today',
            'time'   => 'required',
            'status' => 'required'
        ]);

        $appointment->update([
            'appointment_date' => $request->date,
            'appointment_time' => $request->time,
            'status'           => $request->status, // Use 'Rescheduled' from the form
            'notes'            => $request->notes,
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully!');
    }

    /**
     * Cancel/Delete an appointment
     */
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Appointment cancelled.');
    }
}
