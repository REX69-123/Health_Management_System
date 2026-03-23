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

<body class="bg-slate-50 flex h-screen overflow-hidden" x-data="{ selectedAppointment: null }">

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
                class="flex items-center px-4 py-3 rounded-lg bg-blue-600 text-white shadow-md font-medium transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                Appointments
            </a>
            <a href="{{ route('medical-records.index') }}"
                class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 hover:text-white transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                Medical Records
            </a>
            <a href="{{ route('profile.edit') }}"
                class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 hover:text-white transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                My Profile
            </a>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <header
            class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 shadow-sm shrink-0">
            <h1 class="text-xl font-semibold text-slate-800">Appointments Management</h1>
            <a href="{{ route('appointments.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm">
                + Book Appointment
            </a>
        </header>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-8">

                <div
                    class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center border-l-4 border-l-slate-800">
                    <div
                        class="w-10 h-10 rounded-full bg-slate-100 text-slate-800 flex items-center justify-center mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500">Total</p>
                        <p class="text-xl font-bold text-slate-800">{{ $totalCount ?? 0 }}</p>
                    </div>
                </div>

                <div
                    class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center border-l-4 border-l-blue-500">
                    <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500">Today</p>
                        <p class="text-xl font-bold text-slate-800">{{ $todayCount ?? 0 }}</p>
                    </div>
                </div>

                <div
                    class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center border-l-4 border-l-purple-500">
                    <div
                        class="w-10 h-10 rounded-full bg-purple-50 text-purple-500 flex items-center justify-center mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500">Upcoming</p>
                        <p class="text-xl font-bold text-slate-800">{{ $upcomingCount ?? 0 }}</p>
                    </div>
                </div>

                <div
                    class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center border-l-4 border-l-orange-500">
                    <div
                        class="w-10 h-10 rounded-full bg-orange-50 text-orange-500 flex items-center justify-center mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500">Rescheduled</p>
                        <p class="text-xl font-bold text-slate-800">{{ $rescheduledCount ?? 0 }}</p>
                    </div>
                </div>

                <div
                    class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center border-l-4 border-l-emerald-500">
                    <div
                        class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500">Completed</p>
                        <p class="text-xl font-bold text-slate-800">{{ $completedCount ?? 0 }}</p>
                    </div>
                </div>

            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h2 class="font-semibold text-slate-800">Appointment Schedule</h2>
                </div>

                <form action="{{ route('appointments.index') }}" method="GET"
                    class="p-4 border-b border-slate-200 flex flex-col md:flex-row gap-4 items-center justify-between">
                    <div class="relative w-full md:w-1/3">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search patient or purpose..."
                            class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                    </div>

                    <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto items-center">
                        <select name="status" onchange="this.form.submit()"
                            class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm bg-slate-50 text-slate-700 cursor-pointer">
                            <option value="">All Statuses</option>
                            <option value="Pending" {{ request('status')=='Pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="Confirmed" {{ request('status')=='Confirmed' ? 'selected' : '' }}>Confirmed
                            </option>
                            <option value="Rescheduled" {{ request('status')=='Rescheduled' ? 'selected' : '' }}>
                                Rescheduled</option>
                            <option value="Completed" {{ request('status')=='Completed' ? 'selected' : '' }}>Completed
                            </option>
                            <option value="Cancelled" {{ request('status')=='Cancelled' ? 'selected' : '' }}>Cancelled
                            </option>
                        </select>

                        <select name="sort" onchange="this.form.submit()"
                            class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm bg-slate-50 text-slate-700 cursor-pointer">
                            <option value="date_asc" {{ request('sort')=='date_asc' ? 'selected' : '' }}>Date (Upcoming
                                First)</option>
                            <option value="date_desc" {{ request('sort')=='date_desc' ? 'selected' : '' }}>Date (Oldest
                                First)</option>
                            <option value="newest" {{ request('sort')=='newest' ? 'selected' : '' }}>Recently Booked
                            </option>
                        </select>

                        @if(request()->anyFilled(['search', 'status', 'sort']))
                        <a href="{{ route('appointments.index') }}"
                            class="text-sm font-semibold text-red-500 hover:text-red-700 px-2">Clear</a>
                        @endif
                        <button type="submit"
                            class="px-4 py-2 bg-slate-900 text-white text-sm font-bold rounded-lg hover:bg-slate-800 transition-colors hidden md:block">Filter</button>
                    </div>
                </form>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white border-b border-slate-200 text-xs text-slate-500 uppercase tracking-wider">
                            <th class="p-4 font-medium w-1/4">Patient Name</th>
                            <th class="p-4 font-medium w-1/4">Date & Time</th>
                            <th class="p-4 font-medium w-1/4">Purpose</th>
                            <th class="p-4 font-medium w-1/6">Status</th>
                            <th class="p-4 font-medium w-1/6 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($appointments as $appointment)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="p-4">
                                @php
                                $apptData = [
                                'patient_name' => $appointment->patient ? ($appointment->patient->first_name . ' ' .
                                $appointment->patient->last_name) : 'Unknown',
                                'date' => \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y'),
                                'time' => \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A'),
                                'purpose' => $appointment->purpose,
                                'notes' => $appointment->notes ?? 'No notes provided.',
                                'status' => $appointment->status,
                                'edit_url' => route('appointments.edit', $appointment->id)
                                ];
                                @endphp
                                <button @click='selectedAppointment = @json($apptData)'
                                    class="font-medium text-blue-600 hover:text-blue-800 text-left underline decoration-blue-100 underline-offset-4 decoration-2">
                                    {{ $appointment->patient ? $appointment->patient->first_name . ' ' .
                                    $appointment->patient->last_name : 'Unknown Patient' }}
                                </button>
                            </td>
                            <td class="p-4 text-sm font-medium">
                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}<br>
                                <span class="text-slate-400 text-xs">{{
                                    \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</span>
                            </td>
                            <td class="p-4 text-sm">{{ Str::limit($appointment->purpose, 30) }}</td>
                            <td class="p-4">
                                @php
                                $statusColors = [
                                'Pending' => 'bg-yellow-100 text-yellow-700',
                                'Confirmed' => 'bg-blue-100 text-blue-700',
                                'Rescheduled' => 'bg-orange-100 text-orange-700',
                                'Completed' => 'bg-emerald-100 text-emerald-700',
                                'Cancelled' => 'bg-red-100 text-red-700',
                                ];
                                $colorClass = $statusColors[$appointment->status] ?? 'bg-slate-100 text-slate-600';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $colorClass }}">
                                    {{ $appointment->status }}
                                </span>
                            </td>
                            <td class="p-4 text-right space-x-3 whitespace-nowrap">
                                <a href="{{ route('appointments.edit', $appointment->id) }}"
                                    class="text-blue-600 hover:text-blue-800 text-sm font-semibold">Update</a>
                                <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Are you sure?');">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="text-red-500 hover:text-red-700 text-sm font-semibold ml-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-slate-400">No appointments found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="selectedAppointment" style="display: none;"
            class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4" x-cloak>
            <div @click.outside="selectedAppointment = null"
                class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden flex flex-col">
                <div class="px-6 py-4 border-b flex justify-between items-center transition-colors" :class="{
                        'bg-yellow-50 border-yellow-100': selectedAppointment?.status === 'Pending',
                        'bg-blue-50 border-blue-100': selectedAppointment?.status === 'Confirmed',
                        'bg-orange-50 border-orange-100': selectedAppointment?.status === 'Rescheduled',
                        'bg-emerald-50 border-emerald-100': selectedAppointment?.status === 'Completed',
                        'bg-red-50 border-red-100': selectedAppointment?.status === 'Cancelled'
                     }">
                    <h3 class="font-bold text-lg text-slate-800" x-text="selectedAppointment?.patient_name"></h3>
                    <span class="text-xs font-bold px-3 py-1 rounded-full bg-white shadow-sm" :class="{
                            'text-yellow-700': selectedAppointment?.status === 'Pending',
                            'text-blue-700': selectedAppointment?.status === 'Confirmed',
                            'text-orange-700': selectedAppointment?.status === 'Rescheduled',
                            'text-emerald-700': selectedAppointment?.status === 'Completed',
                            'text-red-700': selectedAppointment?.status === 'Cancelled'
                          }" x-text="selectedAppointment?.status"></span>
                </div>

                <div class="p-6 space-y-4">
                    <template x-if="selectedAppointment?.status === 'Rescheduled'">
                        <div @click="window.location.href = selectedAppointment?.edit_url"
                            class="p-4 bg-orange-50 border border-orange-200 rounded-xl cursor-pointer hover:bg-orange-100 transition-colors flex items-center justify-between group">
                            <div>
                                <p class="text-xs font-bold uppercase text-orange-600 mb-1">Attention Required</p>
                                <p class="text-sm text-orange-800 font-medium">Click here to manage or confirm
                                    rescheduled details.</p>
                            </div>
                            <svg class="w-5 h-5 text-orange-400 group-hover:text-orange-600" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </div>
                    </template>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <p class="text-xs font-bold uppercase text-slate-400 mb-1">Date</p>
                            <p class="text-sm text-slate-800 font-medium" x-text="selectedAppointment?.date"></p>
                        </div>
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <p class="text-xs font-bold uppercase text-slate-400 mb-1">Time</p>
                            <p class="text-sm text-slate-800 font-medium" x-text="selectedAppointment?.time"></p>
                        </div>
                    </div>

                    <div class="p-4 bg-blue-50 rounded-xl border border-blue-100">
                        <p class="text-xs font-bold uppercase text-blue-600 mb-1">Purpose of Visit</p>
                        <p class="text-sm text-slate-800 font-medium" x-text="selectedAppointment?.purpose"></p>
                    </div>

                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                        <p class="text-xs font-bold uppercase text-slate-500 mb-1">Additional Notes</p>
                        <p class="text-sm text-slate-700 italic" x-text="selectedAppointment?.notes"></p>
                    </div>
                </div>

                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-between items-center">
                    <a :href="selectedAppointment?.edit_url"
                        class="text-sm font-bold text-blue-600 hover:text-blue-800">Edit Appointment</a>
                    <button @click="selectedAppointment = null"
                        class="bg-white border border-slate-300 px-6 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:bg-slate-100">Close</button>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
