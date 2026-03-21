<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reschedule Appointment - ClinicAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen p-8 flex items-center justify-center">

    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-8 py-6 border-b border-slate-200 bg-slate-50/50 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Reschedule Appointment</h2>
                <p class="text-sm text-slate-500">Updating schedule for <span class="font-semibold text-blue-600">{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</span></p>
            </div>
            <a href="{{ route('appointments.index') }}" class="text-sm text-slate-400 hover:text-slate-600 transition-colors">Cancel & Go Back</a>
        </div>

        <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-2 tracking-wider">New Appointment Date</label>
                    <input type="date" name="date"
                        value="{{ old('date', $appointment->appointment_date) }}"
                        min="{{ date('Y-m-d') }}" required
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-600 outline-none bg-white shadow-sm">
                    @error('date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-2 tracking-wider">New Appointment Time</label>
                    <input type="time" name="time"
                        value="{{ old('time', \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i')) }}"
                        required
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-600 outline-none bg-white shadow-sm">
                    @error('time') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-2 tracking-wider">Appointment Status</label>
                    <select name="status" required
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-600 outline-none bg-white shadow-sm appearance-none">
                        <option value="Pending" {{ $appointment->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Rescheduled" {{ $appointment->status == 'Rescheduled' ? 'selected' : '' }}>Rescheduled</option>
                        <option value="Completed" {{ $appointment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Cancelled" {{ $appointment->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-2 tracking-wider">Patient Reference</label>
                    <div class="px-4 py-2.5 bg-slate-100 border border-slate-200 rounded-xl text-slate-500 text-sm">
                        {{ $appointment->patient->patient_number }}
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-2 tracking-wider">Reason for Rescheduling / Notes</label>
                <textarea name="notes" rows="4"
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-600 outline-none shadow-sm"
                    placeholder="Briefly explain the change or add clinical notes...">{{ old('notes', $appointment->notes) }}</textarea>
            </div>

            <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                <p class="text-xs text-slate-400 italic">Last updated: {{ $appointment->updated_at->diffForHumans() }}</p>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-10 py-3 rounded-xl transition-all transform hover:scale-[1.02] shadow-lg shadow-blue-200">
                    Update Appointment
                </button>
            </div>
        </form>
    </div>

</body>
</html>
