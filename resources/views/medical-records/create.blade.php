<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>New Medical Record</title>
</head>

<body class="bg-slate-50 p-6 md:p-12 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-3xl bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">
        <div class="bg-slate-900 p-8 text-white">
            <h2 class="text-2xl font-bold italic tracking-tight">Clinical Documentation</h2>
            <p class="text-slate-400 text-sm mt-1">Select a patient and provide the clinical diagnosis.</p>
        </div>

        <form action="{{ route('medical-records.store') }}" method="POST" class="p-10 space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Patient
                        Name</label>
                    <select name="patient_id" required
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <option value="">Choose a patient...</option>
                        @foreach($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->last_name }} ({{
                            $patient->patient_number }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Diagnosis
                        Date</label>
                    <input type="date" name="diagnosis_date" value="{{ date('Y-m-d') }}" required
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Primary
                    Diagnosis</label>
                <input type="text" name="diagnosis" placeholder="e.g. Acute Bronchitis" required
                    class="w-full px-4 py-3 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 shadow-sm">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Treatment Plan /
                    Notes</label>
                <textarea name="treatment_plan" rows="5"
                    placeholder="Prescriptions, recommended tests, follow-up instructions..."
                    class="w-full px-4 py-3 border border-slate-300 rounded-xl outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"></textarea>
            </div>

            <div class="flex items-center justify-between pt-8 border-t border-slate-100">
                <a href="{{ route('medical-records.index') }}"
                    class="text-slate-400 font-bold hover:text-slate-600 transition-colors">Discard</a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-10 py-3 rounded-xl transition-all shadow-lg shadow-blue-200 active:scale-95">
                    Save Record
                </button>
            </div>
        </form>
    </div>
</body>

</html>
