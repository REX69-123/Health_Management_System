<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Consultation | Health Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 flex h-screen overflow-hidden text-slate-800">

    <main class="flex-1 overflow-y-auto">
        <div class="p-8 max-w-4xl mx-auto">

            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Log New Consultation</h1>
                    <p class="text-slate-500 text-sm mt-1">Record vitals, complaints, and medical assessments.</p>
                </div>
                <a href="{{ route('consultations.index') }}" class="text-sm font-medium text-slate-500 hover:text-slate-800">← Back to Records</a>
            </div>

            <form action="{{ route('consultations.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex gap-4">
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Select Patient <span class="text-red-500">*</span></label>
                        <select name="patient_id" required class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="">-- Choose a registered patient --</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-1/3">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Workflow Status</label>
                        <select name="status" class="w-full px-4 py-2 border border-slate-200 rounded-lg text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none font-semibold">
                            <option value="Completed" class="text-emerald-600">Completed</option>
                            <option value="Pending Doctor Review" class="text-amber-600">Pending Doctor Review</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                        <h3 class="text-sm font-bold text-blue-600 uppercase tracking-wider mb-4 border-b pb-2">1. Vitals & Complaint</h3>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Blood Pressure</label>
                                <input type="text" name="blood_pressure" placeholder="120/80" class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:border-blue-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Heart Rate (bpm)</label>
                                <input type="number" name="heart_rate" placeholder="72" class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:border-blue-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Temp (°C)</label>
                                <input type="number" step="0.1" name="temperature" placeholder="36.5" class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:border-blue-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Weight (kg)</label>
                                <input type="number" step="0.1" name="weight_kg" placeholder="65.0" class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:border-blue-500 outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-600 mb-1">Chief Complaint <span class="text-red-500">*</span></label>
                            <textarea name="chief_complaint" rows="3" required placeholder="e.g. 'Stomach ache', 'Sprained ankle during PE'" class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:border-blue-500 outline-none bg-slate-50 focus:bg-white"></textarea>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                        <h3 class="text-sm font-bold text-emerald-600 uppercase tracking-wider mb-4 border-b pb-2">2. Doctor's Assessment</h3>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Clinical Assessment</label>
                                <textarea name="assessment" rows="2" placeholder="Doctor's findings based on observation..." class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:border-emerald-500 outline-none"></textarea>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Final Diagnosis</label>
                                <input type="text" name="diagnosis" placeholder="Medical conclusion (e.g. Acute Gastritis)" class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:border-emerald-500 outline-none font-medium">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Treatment & Prescription</label>
                                <textarea name="prescription" rows="2" placeholder="Medications given or first aid applied today..." class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:border-emerald-500 outline-none bg-slate-50 focus:bg-white"></textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-8 py-3 bg-slate-900 text-white font-bold rounded-xl text-sm hover:bg-slate-800 transition-colors shadow-lg">
                        Save Consultation Record
                    </button>
                </div>

            </form>
        </div>
    </main>
</body>
</html>
