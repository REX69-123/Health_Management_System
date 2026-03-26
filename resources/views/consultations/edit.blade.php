<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Consultation | Health Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 flex h-screen overflow-hidden text-slate-800">

    <main class="flex-1 overflow-y-auto p-8">
        <div class="max-w-4xl mx-auto">

            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Edit Consultation File</h1>
                    <p class="text-slate-500 text-sm mt-1">Update medical details for this visit.</p>
                </div>
                <a href="{{ route('consultations.index') }}" class="text-sm font-medium text-slate-500 hover:text-slate-800">← Back</a>
            </div>

            <form action="{{ route('consultations.update', $consultation) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex gap-4">
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Patient</label>
                        <select name="patient_id" required class="w-full px-4 py-2 border rounded-lg text-sm bg-slate-50">
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}" {{ $consultation->patient_id == $patient->id ? 'selected' : '' }}>
                                    {{ $patient->first_name }} {{ $patient->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-1/3">
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Status</label>
                        <select name="status" class="w-full px-4 py-2 border rounded-lg text-sm bg-slate-50 font-semibold">
                            <option value="Completed" {{ $consultation->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Pending Doctor Review" {{ $consultation->status == 'Pending Doctor Review' ? 'selected' : '' }}>Pending Doctor Review</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                        <h3 class="text-sm font-bold text-blue-600 uppercase mb-4 border-b pb-2">1. Vitals & Complaint</h3>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div><label class="text-xs font-semibold">BP</label><input type="text" name="blood_pressure" value="{{ $consultation->blood_pressure }}" class="w-full px-3 py-2 border rounded-lg text-sm"></div>
                            <div><label class="text-xs font-semibold">HR (bpm)</label><input type="number" name="heart_rate" value="{{ $consultation->heart_rate }}" class="w-full px-3 py-2 border rounded-lg text-sm"></div>
                            <div><label class="text-xs font-semibold">Temp (°C)</label><input type="number" step="0.1" name="temperature" value="{{ $consultation->temperature }}" class="w-full px-3 py-2 border rounded-lg text-sm"></div>
                            <div><label class="text-xs font-semibold">Weight (kg)</label><input type="number" step="0.1" name="weight_kg" value="{{ $consultation->weight_kg }}" class="w-full px-3 py-2 border rounded-lg text-sm"></div>
                        </div>
                        <div>
                            <label class="text-xs font-bold">Chief Complaint *</label>
                            <textarea name="chief_complaint" rows="3" required class="w-full px-3 py-2 border rounded-lg text-sm">{{ $consultation->chief_complaint }}</textarea>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                        <h3 class="text-sm font-bold text-emerald-600 uppercase mb-4 border-b pb-2">2. Assessment</h3>
                        <div class="space-y-4">
                            <div><label class="text-xs font-semibold">Clinical Assessment</label><textarea name="assessment" rows="2" class="w-full px-3 py-2 border rounded-lg text-sm">{{ $consultation->assessment }}</textarea></div>
                            <div><label class="text-xs font-semibold">Final Diagnosis</label><input type="text" name="diagnosis" value="{{ $consultation->diagnosis }}" class="w-full px-3 py-2 border rounded-lg text-sm"></div>
                            <div><label class="text-xs font-semibold">Prescription</label><textarea name="prescription" rows="2" class="w-full px-3 py-2 border rounded-lg text-sm">{{ $consultation->prescription }}</textarea></div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('consultations.index') }}" class="px-6 py-3 bg-slate-200 text-slate-700 font-bold rounded-xl text-sm">Cancel</a>
                    <button type="submit" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-xl text-sm">Save Changes</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
