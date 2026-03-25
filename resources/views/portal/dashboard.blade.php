<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Portal - Health Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-[#f8fafc]">

    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center text-blue-600">
                        <i class="fa-solid fa-house-chimney-medical text-2xl mr-2"></i>
                        <span class="font-bold text-xl tracking-tight text-slate-800">Health<span
                                class="text-blue-600">Connect</span></span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="hidden md:block text-right mr-4">
                        <p class="text-sm font-semibold text-slate-700">{{ $patient->name }}</p>
                        <p class="text-xs text-slate-500">Patient ID: #{{ str_pad($patient->id, 5, '0', STR_PAD_LEFT) }}
                        </p>
                    </div>
                    <form action="{{ route('portal.logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-2 bg-slate-100 hover:bg-red-50 text-slate-600 hover:text-red-600 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-slate-800">Patient Dashboard</h1>
            <p class="text-slate-500">Manage your health records and upcoming appointments.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 transition-hover hover:shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-calendar-check text-xl"></i>
                    </div>
                    @if(isset($daysLeft))
                    <span
                        class="text-xs font-bold px-2 py-1 rounded-full {{ $daysLeft <= 1 ? 'bg-orange-100 text-orange-600' : 'bg-blue-100 text-blue-700' }}">
                        @if($daysLeft === 0) Today @elseif($daysLeft === 1) Tomorrow @else {{ $daysLeft }} Days Left
                        @endif
                    </span>
                    @endif
                </div>
                <p class="text-sm font-medium text-slate-500 mb-1">Next Appointment</p>
                <h3 class="text-xl font-bold text-slate-800">
                    {{ $nextAppointment ? \Carbon\Carbon::parse($nextAppointment->appointment_date)->format('F d, Y') :
                    'No upcoming visits' }}
                </h3>
                <p class="text-xs text-slate-400 mt-2">
                    <i class="fa-solid fa-clock mr-1"></i>
                    {{ $nextAppointment ? \Carbon\Carbon::parse($nextAppointment->appointment_time)->format('h:i A') :
                    '--:--' }}
                </p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 transition-hover hover:shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-file-medical text-xl"></i>
                    </div>
                </div>
                <p class="text-sm font-medium text-slate-500 mb-1">Medical Records</p>
                <h3 class="text-xl font-bold text-slate-800">{{ $records->count() }} Total Entries</h3>
                <p class="text-xs text-slate-400 mt-2 italic">
                    Updated: {{ $records->first() ? $records->first()->created_at->diffForHumans() : 'No records yet' }}
                </p>
            </div>

            <div class="bg-blue-600 rounded-2xl p-6 shadow-lg shadow-blue-100 flex flex-col justify-between text-white">
                <div>
                    <h3 class="font-bold text-lg mb-1">Need Help?</h3>
                    <p class="text-blue-100 text-sm">Contact the clinic for emergencies or account updates.</p>
                </div>
                <button
                    class="mt-4 bg-white text-blue-600 text-sm font-bold py-2 rounded-lg hover:bg-blue-50 transition">
                    Contact Clinic
                </button>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                <h2 class="font-bold text-slate-800 flex items-center gap-2">
                    <i class="fa-solid fa-notes-medical text-blue-500"></i>
                    Clinical History
                </h2>
                <span class="text-xs font-medium text-slate-400 italic">Official documentation from your
                    physician</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-slate-400 text-[11px] uppercase tracking-wider border-b border-slate-100">
                            <th class="px-6 py-4 font-semibold">Date</th>
                            <th class="px-6 py-4 font-semibold">Diagnosis</th>
                            <th class="px-6 py-4 font-semibold">Treatment & Doctor's Notes</th>
                            <th class="px-6 py-4 font-semibold">Verification</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($records as $record)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-6 py-5">
                                <span class="text-sm font-semibold text-slate-700 block">{{
                                    $record->created_at->format('M d, Y') }}</span>
                                <span class="text-[10px] text-slate-400 uppercase tracking-tighter">{{
                                    $record->created_at->format('h:i A') }}</span>
                            </td>
                            <td class="px-6 py-5">
                                <div
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                    {{ $record->diagnosis }}
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <p class="text-sm text-slate-600 max-w-md leading-relaxed">
                                    {{ $record->treatment ?: 'Observation. No specific treatment notes.' }}
                                </p>
                            </td>
                            <td class="px-6 py-5">
                                <span class="flex items-center gap-1.5 text-xs font-medium text-green-600">
                                    <i class="fa-solid fa-circle-check"></i>
                                    Official
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fa-solid fa-folder-open text-slate-200 text-5xl mb-4"></i>
                                    <p class="text-slate-400 font-medium italic">No medical history available yet.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <footer class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-center border-t border-slate-100 mt-10">
        <p class="text-slate-400 text-xs">© {{ date('Y') }} HealthConnect Portal. All records are securely encrypted.
        </p>
    </footer>

</body>

</html>
