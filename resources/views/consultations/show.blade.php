<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $consultation->patient->first_name }}'s Visit | ClinicAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 flex h-screen overflow-hidden text-slate-800">

    <main class="flex-1 overflow-y-auto p-8">
        <div class="max-w-3xl mx-auto">

            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('consultations.index') }}" class="text-sm font-medium text-slate-500 hover:text-slate-800">← Back to Records</a>
                <a href="{{ route('consultations.edit', $consultation) }}" class="px-4 py-2 bg-slate-900 text-white text-sm font-bold rounded-lg hover:bg-slate-800 transition">Edit Record</a>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="bg-slate-50 border-b border-slate-200 p-6 flex justify-between items-center">
                    <div>
                        <h1 class="text-xl font-bold text-slate-800">Consultation Receipt</h1>
                        <p class="text-sm text-slate-500">{{ $consultation->created_at->format('F d, Y h:i A') }}</p>
                    </div>
                    <span class="px-3 py-1 bg-slate-200 text-slate-700 rounded-full text-xs font-bold uppercase">{{ $consultation->status }}</span>
                </div>

                <div class="p-6 space-y-6">
                    <div class="flex justify-between p-4 bg-blue-50 rounded-xl border border-blue-100">
                        <div>
                            <p class="text-xs font-bold text-blue-500 uppercase">Patient Name</p>
                            <p class="font-bold text-slate-800 text-lg">{{ $consultation->patient->first_name ?? 'N/A' }} {{ $consultation->patient->last_name ?? '' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-bold text-blue-500 uppercase">Attending Admin ID</p>
                            <p class="font-bold text-slate-800">{{ $consultation->admin_id }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase mb-1">Chief Complaint</p>
                            <p class="text-sm text-slate-700 bg-slate-50 p-3 rounded-lg border border-slate-100">{{ $consultation->chief_complaint }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase mb-1">Vitals Logged</p>
                            <div class="bg-slate-50 p-3 rounded-lg border border-slate-100 text-sm grid grid-cols-2 gap-2 text-slate-600">
                                <span><strong>BP:</strong> {{ $consultation->blood_pressure ?? '-' }}</span>
                                <span><strong>HR:</strong> {{ $consultation->heart_rate ?? '-' }} bpm</span>
                                <span><strong>Temp:</strong> {{ $consultation->temperature ?? '-' }}°C</span>
                                <span><strong>Wt:</strong> {{ $consultation->weight_kg ?? '-' }} kg</span>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-slate-100 pt-6">
                        <p class="text-xs font-bold text-emerald-500 uppercase mb-2">Doctor's Diagnosis</p>
                        <p class="text-lg font-bold text-slate-800">{{ $consultation->diagnosis ?? 'No diagnosis recorded' }}</p>
                        <p class="text-sm text-slate-600 mt-2"><strong>Assessment:</strong> {{ $consultation->assessment ?? 'None' }}</p>

                        <div class="mt-4 p-4 bg-slate-50 rounded-lg border border-slate-200">
                            <p class="text-xs font-bold text-slate-500 uppercase mb-1">Prescription & Treatment</p>
                            <p class="text-sm font-mono text-slate-700">{{ $consultation->prescription ?? 'No treatment prescribed.' }}</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </main>
</body>
</html>
