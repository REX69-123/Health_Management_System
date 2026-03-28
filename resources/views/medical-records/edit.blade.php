<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit Medical Record</title>
</head>

<body class="bg-slate-50 p-6 md:p-12 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-3xl bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">
        <div class="bg-amber-500 p-8 text-white">
            <h2 class="text-2xl font-bold italic tracking-tight">Edit Documentation</h2>
            <p class="text-amber-100 text-sm mt-1">Modifying record for: <strong>{{ $record->patient->first_name }} {{
                    $record->patient->last_name }}</strong></p>
        </div>

        <form action="{{ route('medical-records.update', $record->id) }}" method="POST" class="p-10 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Patient
                        (Read-Only)</label>
                    <input type="text" disabled
                        value="{{ $record->patient->first_name }} {{ $record->patient->last_name }}"
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-500 cursor-not-allowed">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Diagnosis
                        Date</label>
                    <input type="date" name="diagnosis_date"
                        value="{{ old('diagnosis_date', $record->diagnosis_date) }}" required
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Primary
                    Diagnosis</label>
                <input type="text" name="diagnosis" value="{{ old('diagnosis', $record->diagnosis) }}" required
                    class="w-full px-4 py-3 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 shadow-sm">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Treatment Plan &
                    Notes</label>
                <textarea name="treatment_plan" rows="6"
                    class="w-full px-4 py-3 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 shadow-sm">{{ old('treatment_plan', $record->treatment_plan) }}</textarea>
            </div>

            <div class="flex items-center justify-between pt-8 border-t border-slate-100">
                <a href="{{ route('medical-records.index') }}"
                    class="text-slate-400 font-bold hover:text-slate-600 transition-colors">Cancel Changes</a>
                <button type="submit"
                    class="bg-slate-800 hover:bg-slate-900 text-white font-bold px-10 py-3 rounded-xl transition-all shadow-lg active:scale-95">
                    Update Medical Record
                </button>
            </div>
        </form>
    </div>
</body>

</html>
