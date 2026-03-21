<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard - ClinicAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-slate-50 flex h-screen overflow-hidden" x-data="{ selectedPatient: null }">

    <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col hidden md:flex">
        <div
            class="h-16 flex items-center px-6 border-b border-slate-800 font-bold text-white text-xl uppercase tracking-wider">
            ClinicAdmin
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('patients.index') }}"
                class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 hover:text-white transition-colors bg-blue-600 text-white shadow-md font-medium">
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
            <h1 class="text-xl font-semibold text-slate-800">Staff Dashboard</h1>
            <a href="{{ route('patients.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm">
                + Add New Patient
            </a>
        </header>

        <div class="p-8">
            @if(session('success'))
            <div id="flash-message"
                class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 shadow-sm flex justify-between items-center">
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            <script>
                setTimeout(() => {
                        document.getElementById('flash-message').style.display = 'none';
                    }, 3000);
            </script>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center">
                    <div
                        class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-xl font-bold mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Registered Patients</p>
                        <p class="text-2xl font-bold text-slate-800">{{ $totalPatients ?? 0 }}</p>
                    </div>
                </div>

                <div
                    class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center border-l-4 border-l-emerald-500">
                    <div
                        class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center text-xl font-bold mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Currently Active</p>
                        <p class="text-2xl font-bold text-slate-800">{{ $activePatients ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <form action="{{ route('patients.index') }}" method="GET"
                    class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex justify-between items-center">
                    <h2 class="font-semibold text-slate-800">Patient Directory</h2>
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search by name or email..."
                            class="px-3 py-1.5 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none w-64">

                        @if(request('search'))
                        <a href="{{ route('patients.index') }}"
                            class="absolute right-2 top-1.5 text-slate-400 hover:text-slate-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </a>
                        @endif
                    </div>
                </form>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white border-b border-slate-200 text-xs text-slate-500 uppercase tracking-wider">
                            <th class="p-4 font-medium">Patient ID</th>
                            <th class="p-4 font-medium">Full Name</th>
                            <th class="p-4 font-medium">Email</th>
                            <th class="p-4 font-medium">Status</th>
                            <th class="p-4 font-medium text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($patients as $patient)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="p-4 text-sm text-slate-500 font-mono">{{ $patient->patient_number }}</td>
                            <td class="p-4">
                                <button @click='selectedPatient = {
    "name": "{{ $patient->first_name }} {{ $patient->last_name }}",
    "number": "{{ $patient->patient_number }}",
    "email": "{{ $patient->email }}",
    "dob": "{{ \Carbon\Carbon::parse($patient->dob)->format("F d, Y") }}",
    "gender": "{{ $patient->gender }}",
    "status": "{{ $patient->status }}"
}' class="font-medium text-blue-600 hover:text-blue-800 text-left underline decoration-blue-100 underline-offset-4 decoration-2">
                                    {{ $patient->first_name }} {{ $patient->last_name }}
                                </button>
                            </td>
                            <td class="p-4 text-sm">{{ $patient->email }}</td>
                            <td class="p-4">
                                <span
                                    class="px-3 py-1 {{ $patient->status == 'Active' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }} rounded-full text-xs font-semibold">
                                    {{ $patient->status }}
                                </span>
                            </td>
                            <td class="p-4 text-right flex justify-end items-center space-x-4">
                                <a href="{{ route('patients.edit', $patient->id) }}"
                                    class="text-blue-600 hover:text-blue-800 text-sm font-semibold">Update</a>

                                <form action="{{ route('patients.destroy', $patient->id) }}" method="POST"
                                    onsubmit="return confirm('Remove this patient from the database?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-500 hover:text-red-700 text-sm font-semibold">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-slate-400">No patient records found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="selectedPatient"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" x-cloak
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100">

            <div class="bg-white rounded-2xl shadow-xl max-w-md w-full overflow-hidden"
                @click.away="selectedPatient = null">

                <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h3 class="text-lg font-bold text-slate-800">Patient Profile</h3>
                    <button @click="selectedPatient = null"
                        class="text-slate-400 hover:text-slate-600 text-2xl">&times;</button>
                </div>

                <div class="p-6 space-y-6">
                    <div class="flex items-center space-x-4">
                        <div
                            class="h-14 w-14 bg-blue-600 rounded-full flex items-center justify-center text-white text-xl font-bold">
                            <span x-text="selectedPatient?.name.charAt(0)"></span>
                        </div>
                        <div>
                            <p class="font-bold text-slate-900 text-xl" x-text="selectedPatient?.name"></p>
                            <p class="text-sm text-slate-500 font-mono" x-text="selectedPatient?.number"></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <p class="text-xs font-bold uppercase text-slate-400 mb-1">Email Address</p>
                            <p class="text-sm text-slate-800 font-medium" x-text="selectedPatient?.email"></p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                                <p class="text-xs font-bold uppercase text-slate-400 mb-1">Date of Birth</p>
                                <p class="text-sm text-slate-800 font-medium" x-text="selectedPatient?.dob"></p>
                            </div>
                            <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                                <p class="text-xs font-bold uppercase text-slate-400 mb-1">Gender</p>
                                <p class="text-sm text-slate-800 font-medium" x-text="selectedPatient?.gender"></p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex items-center justify-between p-3 bg-emerald-50 rounded-xl border border-emerald-100">
                        <p class="text-xs font-bold uppercase text-emerald-600">Account Status</p>
                        <span class="text-sm font-bold text-emerald-700" x-text="selectedPatient?.status"></span>
                    </div>
                </div>

                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end">
                    <button @click="selectedPatient = null"
                        class="bg-white border border-slate-300 px-6 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:bg-slate-100 transition-colors">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
