<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Appointment - ClinicAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 min-h-screen p-8 flex items-center justify-center">

    <div class="w-full max-w-2xl bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-8 py-6 border-b border-slate-200 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Schedule New Appointment</h2>
                <p class="text-sm text-slate-500">Assign a patient to a time slot.</p>
            </div>
            <a href="{{ route('appointments.index') }}" class="text-sm text-slate-400 hover:text-slate-600">Back to
                List</a>
        </div>

        <form action="{{ route('appointments.store') }}" method="POST" class="p-8 space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Select Patient</label>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Patient</label>
                    <select name="patient_id" required
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <option value="" disabled selected>Select a patient...</option>

                        @foreach($patients as $patient)
                        <option value="{{ $patient->id }}" {{ old('patient_id')==$patient->id ? 'selected' : '' }}>
                            {{ $patient->first_name }} {{ $patient->last_name }} ({{ $patient->patient_number }})
                        </option>
                        @endforeach

                    </select>
                    @error('patient_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                @error('patient_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Purpose of Visit</label>
                <input type="text" name="purpose" placeholder="e.g., General Checkup, Consultation" required
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Appointment Date</label>
                    <input type="date" name="date" min="{{ date('Y-m-d') }}" required
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Appointment Time</label>
                    <input type="time" name="time" required
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Additional Notes (Optional)</label>
                <textarea name="notes" rows="3"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none"
                    placeholder="Enter any specific details..."></textarea>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-2.5 rounded-lg transition-colors shadow-sm">
                    Confirm Appointment
                </button>
            </div>
        </form>
    </div>

</body>

</html>
