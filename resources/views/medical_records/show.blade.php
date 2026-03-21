<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Record - {{ $record->patient->last_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen p-6 md:p-12 flex justify-center">
    <div class="w-full max-w-3xl bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">
        <div class="bg-slate-900 p-8 text-white flex justify-between items-start">
            <div>
                <h2 class="text-2xl font-bold tracking-tight">Medical Examination Report</h2>
                <p class="text-slate-400 text-sm mt-1">Record ID: #MR-{{ str_pad($record->id, 5, '0', STR_PAD_LEFT) }}</p>
            </div>
            <button onclick="window.print()" class="bg-slate-800 hover:bg-slate-700 px-4 py-2 rounded-lg text-xs font-bold transition-all">
                Print Report
            </button>
        </div>

        <div class="p-10 space-y-8">
            <div class="grid grid-cols-2 gap-8 pb-8 border-b border-slate-100">
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Patient Details</label>
                    <p class="text-lg font-bold text-slate-900">{{ $record->patient->first_name }} {{ $record->patient->last_name }}</p>
                    <p class="text-sm text-slate-500">ID: {{ $record->patient->patient_number }}</p>
                </div>
                <div class="text-right">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Date of Diagnosis</label>
                    <p class="text-lg font-bold text-slate-900">{{ \Carbon\Carbon::parse($record->diagnosis_date)->format('F d, Y') }}</p>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Clinical Diagnosis</label>
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-xl">
                    <p class="text-xl font-semibold text-blue-900">{{ $record->diagnosis }}</p>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Treatment Plan & Physician Notes</label>
                <div class="text-slate-700 leading-relaxed whitespace-pre-line bg-slate-50 p-6 rounded-2xl border border-slate-100">
                    {{ $record->treatment_plan ?? 'No specific treatment plan recorded.' }}
                </div>
            </div>

            <div class="flex items-center justify-between pt-8 border-t border-slate-100">
                <a href="{{ route('medical-records.index') }}" class="text-slate-400 font-bold hover:text-slate-600 transition-colors">
                    &larr; Back to List
                </a>
                <div class="space-x-3">
                    <a href="{{ route('medical-records.edit', $record->id) }}" class="bg-slate-800 text-white font-bold px-6 py-2.5 rounded-xl hover:bg-slate-900 transition-all">
                        Edit Record
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
