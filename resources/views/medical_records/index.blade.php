<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Records - ClinicAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 flex h-screen overflow-hidden">

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
            <h1 class="text-xl font-semibold text-slate-800">Medical History</h1>
            <a href="{{ route('medical-records.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-bold transition-all active:scale-95 shadow-lg shadow-blue-100">
                + New Medical Entry
            </a>
        </header>

        <div class="p-8 w-full max-w-6xl mx-auto">
            <form action="{{ route('medical-records.index') }}" method="GET"
                class="mb-8 flex flex-wrap gap-4 items-end bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <div class="flex-1 min-w-[250px]">
                    <label class="block text-xs font-bold text-slate-400 uppercase mb-2 tracking-widest">Filter by
                        Patient</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search name or ID..."
                            class="w-full pl-10 pr-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                        <svg class="w-5 h-5 absolute left-3 top-3 text-slate-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>

                <div class="w-56">
                    <label class="block text-xs font-bold text-slate-400 uppercase mb-2 tracking-widest">Diagnosis
                        Date</label>
                    <select name="sort"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none bg-white appearance-none">
                        <option value="desc" {{ request('sort')=='desc' ? 'selected' : '' }}>Newest Records</option>
                        <option value="asc" {{ request('sort')=='asc' ? 'selected' : '' }}>Oldest Records</option>
                    </select>
                </div>

                <button type="submit"
                    class="bg-slate-800 text-white px-8 py-2.5 rounded-xl font-bold hover:bg-slate-900 transition-all active:scale-95">
                    Apply Filter
                </button>
            </form>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 text-xs uppercase font-bold">
                        <tr>
                            <th class="p-5">Patient Details</th>
                            <th class="p-5">Diagnosis & Findings</th>
                            <th class="p-5">Date Diagnosed</th>
                            <th class="p-5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($records as $record)
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            <td class="p-5">
                                <div class="font-bold text-slate-900 group-hover:text-blue-600 transition-colors">
                                    {{ $record->patient->first_name }} {{ $record->patient->last_name }}
                                </div>
                                <div class="text-xs text-slate-400 font-mono">{{ $record->patient->patient_number }}
                                </div>
                            </td>
                            <td class="p-5">
                                <span
                                    class="px-2.5 py-1 bg-blue-50 text-blue-700 rounded-md text-xs font-bold uppercase mr-2">Dx</span>
                                <span class="text-slate-700 italic">"{{ $record->diagnosis }}"</span>
                            </td>
                            <td class="p-5 text-slate-600">
                                {{ \Carbon\Carbon::parse($record->diagnosis_date)->format('M d, Y') }}
                            </td>
                            <td class="p-5 text-right space-x-3">
                                <a href="{{ route('medical-records.edit', $record->id) }}"
                                    class="text-slate-600 hover:text-blue-600 font-bold">Edit</a>
                                <form action="{{ route('medical-records.destroy', $record->id) }}" method="POST"
                                    class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 font-bold"
                                        onclick="return confirm('Archive this record?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-20 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="bg-slate-100 p-4 rounded-full mb-4">
                                        <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-800">No medical records found</h3>
                                    <p class="text-slate-500 max-w-xs mx-auto mt-1">Start by adding a new diagnosis or
                                        treatment plan for your patients.</p>
                                    <a href="{{ route('medical-records.create') }}"
                                        class="mt-6 text-blue-600 font-bold hover:underline">+ Create the first
                                        record</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                {{ $records->appends(request()->query())->links() }}
            </div>
        </div>
    </main>
</body>

</html>
