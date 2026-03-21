<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Portal | PulsePortal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f9fafb; }
        .sos-btn { transition: all 0.3s ease; border: 2px solid #fee2e2; }
        .sos-btn:hover { background-color: #dc2626; color: white; transform: translateY(-2px); }
    </style>
</head>
<body class="min-h-screen">

    <nav class="bg-white border-b border-slate-200 px-8 py-4 flex justify-between items-center sticky top-0 z-50">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <span class="text-xl font-bold text-slate-900">Pulse<span class="text-indigo-600">Portal</span></span>
        </div>

        <div class="flex items-center gap-6">
            <form action="{{ route('portal.emergency') }}" method="POST">
                @csrf
                <button type="submit" class="sos-btn bg-red-50 text-red-600 px-6 py-2 rounded-full text-xs font-bold tracking-wider">
                    EMERGENCY SOS
                </button>
            </form>
            <form action="{{ route('portal.logout') }}" method="POST">
                @csrf
                <button class="text-xs font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest">Logout</button>
            </form>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto p-8">
        <header class="mb-10">
            <h1 class="text-3xl font-bold text-slate-900">Welcome, {{ Auth::user()->name }}</h1>
            <p class="text-slate-500 text-sm">Patient ID: {{ $clinicalProfile->patient_number ?? 'Pending' }}</p>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2">
                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                        <h3 class="font-bold text-slate-800 uppercase text-xs tracking-widest">Appointment Schedule</h3>
                        <span class="bg-indigo-50 text-indigo-600 px-3 py-1 rounded-full text-[10px] font-bold">{{ $appointments->count() }} Total</span>
                    </div>
                    <div class="p-0">
                        @forelse($appointments as $app)
                        <div class="p-6 flex items-center gap-6 border-b border-slate-50 hover:bg-slate-50 transition-colors">
                            <div class="text-center min-w-[60px]">
                                <p class="text-[10px] font-bold text-slate-400 uppercase">{{ \Carbon\Carbon::parse($app->appointment_date)->format('M') }}</p>
                                <p class="text-2xl font-black text-slate-800">{{ \Carbon\Carbon::parse($app->appointment_date)->format('d') }}</p>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-slate-900">{{ $app->reason ?? 'General Consultation' }}</h4>
                                <p class="text-xs text-slate-500">Scheduled for {{ $app->appointment_time ?? '09:00 AM' }}</p>
                            </div>
                            <div class="text-right">
                                <span class="px-3 py-1 bg-green-50 text-green-600 text-[10px] font-bold rounded-full uppercase tracking-tighter">Confirmed</span>
                            </div>
                        </div>
                        @empty
                        <div class="p-20 text-center">
                            <p class="text-slate-400 text-sm italic">No appointments found in your clinical record.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-slate-900 rounded-[2rem] p-8 text-white min-h-[400px]">
                    <h3 class="font-bold uppercase text-[10px] tracking-[0.2em] text-slate-400 mb-8">Clinical Records</h3>

                    <div class="space-y-6">
                        @forelse($records as $record)
                        <div class="group cursor-pointer">
                            <div class="flex items-start justify-between mb-1">
                                <h4 class="font-bold text-sm group-hover:text-indigo-400 transition-colors">{{ $record->title ?? 'Lab Result' }}</h4>
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            </div>
                            <p class="text-[10px] text-slate-500 uppercase font-bold">{{ $record->created_at->format('M d, Y') }}</p>
                        </div>
                        @empty
                        <div class="py-10">
                            <p class="text-slate-500 text-xs italic leading-loose">Medical summaries and lab results will appear here once released by the clinical staff.</p>
                        </div>
                        @endforelse
                    </div>

                    <div class="mt-12 pt-8 border-t border-slate-800">
                        <div class="flex items-center gap-3 bg-slate-800/50 p-4 rounded-2xl border border-slate-800">
                            <div class="w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></div>
                            <span class="text-[10px] font-bold text-slate-300">Vault Securely Encrypted</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
</body>
</html>
