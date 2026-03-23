<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display the Appointment Dashboard with 5 Stats Cards
     */
    public function index(Request $request)
    {
        $query = Appointment::with('patient');

        // 1. Handle Search
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->whereHas('patient', function ($patientQuery) use ($searchTerm) {
                    $patientQuery->where('name', 'like', "%{$searchTerm}%")
                        ->orWhere('first_name', 'like', "%{$searchTerm}%")
                        ->orWhere('last_name', 'like', "%{$searchTerm}%");
                })->orWhere('purpose', 'like', "%{$searchTerm}%");
            });
        }

        // 2. Handle Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 3. Handle Sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'date_asc':
                    $query->orderBy('appointment_date', 'asc')->orderBy('appointment_time', 'asc');
                    break;
                case 'date_desc':
                    $query->orderBy('appointment_date', 'desc')->orderBy('appointment_time', 'desc');
                    break;
                case 'newest':
                    $query->latest();
                    break;
            }
        } else {
            $query->orderBy('appointment_date', 'asc')->orderBy('appointment_time', 'asc');
        }

        $appointments = $query->get();

        // --- Stats Calculation ---
        $today = Carbon::today()->toDateString();

        $totalCount = Appointment::count();
        $todayCount = Appointment::whereDate('appointment_date', $today)->count();
        $upcomingCount = Appointment::whereDate('appointment_date', '>=', $today)
            ->whereIn('status', ['Pending', 'Confirmed'])
            ->count();
        $rescheduledCount = Appointment::where('status', 'Rescheduled')->count();
        $completedCount = Appointment::where('status', 'Completed')->count(); // Added this!

        return view('appointments.index', compact(
            'appointments',
            'totalCount',
            'todayCount',
            'upcomingCount',
            'rescheduledCount',
            'completedCount'
        ));
    }

    // ... (rest of the controller methods remain the same)

    public function create()
    {
        $patients = Patient::where('status', 'Active')->orderBy('first_name')->get();
        return view('appointments.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date'       => 'required|date|after_or_equal:today',
            'time'       => 'required',
            'notes'      => 'nullable|string',
        ]);

        $patient = Patient::findOrFail($request->patient_id);

        Appointment::create([
            'patient_id'       => $request->patient_id,
            'email'            => $patient->email,
            'appointment_date' => $request->date,
            'appointment_time' => $request->time,
            'purpose'          => $request->purpose ?? 'Checkup',
            'notes'            => $request->notes,
            'status'           => 'Pending',
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment scheduled successfully!');
    }

    public function edit($id)
    {
        $appointment = Appointment::with('patient')->findOrFail($id);
        $patients = Patient::all();
        return view('appointments.edit', compact('appointment', 'patients'));
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $request->validate(['date' => 'required|date', 'time' => 'required', 'status' => 'required']);

        $appointment->update([
            'appointment_date' => $request->date,
            'appointment_time' => $request->time,
            'status'           => $request->status,
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully!');
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}
