<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments - ClinicAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-slate-50 flex h-screen overflow-hidden" x-data="{ selectedAppt: null }">

    <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col hidden md:flex">
        <div
            class="h-16 flex items-center px-6 border-b border-slate-800 font-bold text-white text-xl uppercase tracking-wider">
            ClinicAdmin
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('patients.index') }}"
                class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 hover:text-white transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
                Patients
            </a>
            <a href="{{ route('appointments.index') }}"
                class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 hover:text-white transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                Appointments
            </a>
            <a href="{{ route('medical-records.index') }}"
                class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 hover:text-white transition-colors {{ request()->routeIs('medical-records.*') ? 'bg-blue-600 text-white' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                Medical Records
            </a>
            <a href="{{ route('profile.edit') }}"
                class="flex items-center px-4 py-3 rounded-lg bg-blue-600 text-white shadow-md font-medium">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                My Profile
            </a>
        </nav>
        <div class="p-4 border-t border-slate-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full text-left px-4 py-2 text-sm text-slate-400 hover:text-white flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <header
            class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 shadow-sm shrink-0">
            <h1 class="text-xl font-semibold text-slate-800">Appointment Management</h1>
            <a href="{{ route('appointments.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm">
                + Schedule Appointment
            </a>
        </header>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm border-l-4 border-l-blue-500">
                    <p class="text-sm font-medium text-slate-500 uppercase">Scheduled Today</p>
                    <p class="text-3xl font-bold text-slate-800">{{ $todayCount ?? 0 }}</p>
                </div>

                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm border-l-4 border-l-emerald-500">
                    <p class="text-sm font-medium text-slate-500 uppercase">Upcoming</p>
                    <p class="text-3xl font-bold text-slate-800">{{ $upcomingCount ?? 0 }}</p>
                </div>

                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm border-l-4 border-l-amber-500">
                    <p class="text-sm font-medium text-slate-500 uppercase">Rescheduled</p>
                    <p class="text-3xl font-bold text-slate-800">{{ $rescheduledCount ?? 0 }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h2 class="font-semibold text-slate-800">Appointment List</h2>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white border-b border-slate-200 text-xs text-slate-500 uppercase">
                            <th class="p-4 font-medium">Patient</th>
                            <th class="p-4 font-medium">Date & Time</th>
                            <th class="p-4 font-medium">Status</th>
                            <th class="p-4 font-medium text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($appointments as $appointment)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="p-4">
                                <button @click="selectedAppt = {{ json_encode([
                                            'name' => $appointment->patient->first_name . ' ' . $appointment->patient->last_name,
                                            'id' => $appointment->patient->patient_number,
                                            'purpose' => $appointment->purpose,
                                            'notes' => $appointment->notes ?? 'No additional notes.',
                                            'date' => \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y'),
                                            'time' => \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A')
                                        ]) }}"
                                    class="font-medium text-blue-600 hover:text-blue-800 text-left underline decoration-blue-200 underline-offset-4">
                                    {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}
                                </button>
                                <div class="text-xs text-slate-400 mt-1">{{ $appointment->patient->patient_number }}
                                </div>
                            </td>
                            <td class="p-4 text-sm">
                                <span class="font-medium">{{
                                    \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y')
                                    }}</span><br>
                                <span class="text-slate-400">{{
                                    \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</span>
                            </td>
                            <td class="p-4">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $appointment->status == 'Rescheduled' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ $appointment->status }}
                                </span>
                            </td>
                            <td class="p-4 text-right space-x-3">
                                <a href="{{ route('appointments.edit', $appointment->id) }}"
                                    class="text-blue-600 hover:text-blue-800 text-sm font-semibold">Reschedule</a>

                                <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST"
                                    class="inline" onsubmit="return confirm('Cancel this appointment?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-500 hover:text-red-700 text-sm font-semibold">Cancel</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-12 text-center text-slate-400">No appointments scheduled.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="selectedAppt"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" x-cloak
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100">

            <div class="bg-white rounded-2xl shadow-xl max-w-md w-full overflow-hidden"
                @click.away="selectedAppt = null">

                <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h3 class="text-lg font-bold text-slate-800">Appointment Details</h3>
                    <button @click="selectedAppt = null"
                        class="text-slate-400 hover:text-slate-600 text-2xl">&times;</button>
                </div>

                <div class="p-6 space-y-6">
                    <div class="flex items-center space-x-4">
                        <div
                            class="h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold">
                            <span x-text="selectedAppt?.name.charAt(0)"></span>
                        </div>
                        <div>
                            <p class="font-bold text-slate-900 text-lg" x-text="selectedAppt?.name"></p>
                            <p class="text-sm text-slate-500" x-text="selectedAppt?.id"></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 py-4 border-y border-slate-100">
                        <div>
                            <p class="text-xs font-bold uppercase text-slate-400 mb-1">Date</p>
                            <p class="text-sm font-medium text-slate-800" x-text="selectedAppt?.date"></p>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase text-slate-400 mb-1">Time</p>
                            <p class="text-sm font-medium text-slate-800" x-text="selectedAppt?.time"></p>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase text-slate-400 mb-1">Purpose of Visit</p>
                        <p class="text-slate-800 font-medium" x-text="selectedAppt?.purpose"></p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase text-slate-400 mb-1">Clinical Notes</p>
                        <div class="bg-slate-50 border border-slate-100 p-3 rounded-xl text-sm text-slate-600 italic"
                            x-text="selectedAppt?.notes"></div>
                    </div>
                </div>

                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end">
                    <button @click="selectedAppt = null"
                        class="bg-white border border-slate-300 px-4 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:bg-slate-100 transition-colors">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
