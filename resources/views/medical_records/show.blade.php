<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $patient->first_name }}'s Medical Record</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* A little custom CSS to make the timeline line connect */
        .timeline-container::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 1.25rem; /* Aligns with the dots */
            width: 2px;
            background-color: #e2e8f0; /* slate-200 */
            z-index: 0;
        }
    </style>
</head>
<body class="bg-slate-50 flex h-screen overflow-hidden text-slate-800">

    <main class="flex-1 overflow-y-auto p-8 relative">
        <div class="max-w-4xl mx-auto relative z-10">

            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Comprehensive Medical Record</h1>
                    <p class="text-slate-500 text-sm mt-1">File: PT-{{ str_pad($patient->id, 5, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div class="flex gap-3">
                    <button onclick="window.print()" class="px-4 py-2 bg-slate-200 text-slate-700 text-sm font-bold rounded-lg hover:bg-slate-300 transition">Print Record</button>
                    <a href="{{ route('medical-records.index') }}" class="px-4 py-2 bg-slate-900 text-white text-sm font-bold rounded-lg hover:bg-slate-800 transition">Back to Directory</a>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 mb-8 flex flex-col md:flex-row gap-6">
                <div class="flex-1">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Patient Name</label>
                    <p class="text-xl font-bold text-slate-900">{{ $patient->first_name }} {{ $patient->last_name }}</p>
                </div>
                <div class="flex-1 md:border-l border-slate-100 md:pl-6">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Known Chronic Conditions</label>
                    <div class="text-sm font-medium text-red-600 bg-red-50 px-3 py-2 rounded-lg inline-block border border-red-100">
                        {{ $patient->chronic_conditions ?? 'None recorded.' }}
                    </div>
                </div>
            </div>

            <h3 class="text-lg font-bold text-slate-800 mb-6">Completed Consultations History</h3>

            <div class="relative timeline-container pl-10 space-y-6 pb-12">
                @forelse($consultations as $visit)
                    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm relative">
                        <div class="absolute -left-12 top-6 w-5 h-5 bg-blue-500 border-4 border-slate-50 rounded-full z-10 shadow-sm"></div>

                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="text-sm font-bold text-slate-500">{{ $visit->created_at->format('F d, Y - h:i A') }}</p>
                                <h4 class="text-lg font-bold text-blue-900">{{ $visit->diagnosis ?? 'Routine Checkup' }}</h4>
                            </div>
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full border border-emerald-200">Completed</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 bg-slate-50 p-4 rounded-lg border border-slate-100">
                            <div>
                                <p class="text-xs font-bold text-slate-400 uppercase mb-1">Chief Complaint</p>
                                <p class="text-sm text-slate-700">{{ $visit->chief_complaint }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-400 uppercase mb-1">Treatment / Prescription</p>
                                <p class="text-sm text-slate-700">{{ $visit->prescription ?? 'None prescribed' }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-slate-50 p-8 rounded-xl border border-slate-200 text-center relative z-10 ml-[-2.5rem]">
                        <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <p class="text-slate-500 text-sm font-medium">No completed consultations on record for this patient yet.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </main>
</body>
</html>
