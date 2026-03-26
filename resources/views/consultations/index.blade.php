<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultations | Health Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 flex h-screen overflow-hidden text-slate-800">

    <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col hidden md:flex">
        <div
            class="h-16 flex items-center px-6 border-b border-slate-800 font-bold text-white text-xl uppercase tracking-wider">
            Health Portal
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('patients.index') }}"
                class="flex items-center px-4 py-3 rounded-lg bg-blue-600 text-white shadow-md font-medium hover:bg-blue-700 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
                Patients
            </a>

            <a href="{{ route('appointments.index') }}"
                class="flex items-center px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                Appointments
            </a>

            <a href="{{ route('consultations.index') }}"
                class="flex items-center px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                    </path>
                </svg>
                Consultations
            </a>

            <a href="{{ route('medical-records.index') }}"
                class="flex items-center px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                Medical Records
            </a>

            <a href="{{ route('profile.edit') }}"
                class="flex items-center px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                My Profile
            </a>

            <a href="{{ route('admins.index') }}"
                class="flex items-center px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
                Manage Admins
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full text-left px-4 py-2 text-sm text-slate-400 hover:text-white transition-colors flex items-center">
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

    <main class="flex-1 overflow-y-auto">
        <div class="p-8 max-w-7xl mx-auto">

            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Clinic Consultations</h1>
                    <p class="text-slate-500 text-sm mt-1">Manage all daily patient visits and medical logs.</p>
                </div>
                <a href="{{ route('consultations.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-bold transition-colors shadow-sm">
                    + Log New Visit
                </a>
            </div>

            @if(session('success'))
            <div
                class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm font-medium">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-slate-50 border-b border-slate-200 text-xs text-slate-500 uppercase tracking-wider">
                                <th class="px-6 py-4 font-semibold">Date / Time</th>
                                <th class="px-6 py-4 font-semibold">Patient Name</th>
                                <th class="px-6 py-4 font-semibold">Chief Complaint</th>
                                <th class="px-6 py-4 font-semibold">Status</th>
                                <th class="px-6 py-4 font-semibold text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($consultations as $consultation)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-slate-800">
                                    {{ $consultation->created_at->format('M d, Y') }}<br>
                                    <span class="text-xs text-slate-400 font-normal">{{
                                        $consultation->created_at->format('h:i A') }}</span>
                                </td>
                                <td class="px-6 py-4 font-bold text-blue-600">
                                    {{ $consultation->patient->first_name ?? 'Unknown' }} {{
                                    $consultation->patient->last_name ?? 'Patient' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600 line-clamp-2">
                                    {{ $consultation->chief_complaint }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($consultation->status == 'Completed')
                                    <span
                                        class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold">Completed</span>
                                    @else
                                    <span
                                        class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-bold">Pending
                                        Review</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-medium space-x-3">
                                    <a href="{{ route('consultations.show', $consultation) }}"
                                        class="text-slate-500 hover:text-slate-800 transition-colors">View</a>
                                    <a href="{{ route('consultations.edit', $consultation) }}"
                                        class="text-blue-600 hover:text-blue-800 transition-colors">Edit</a>

                                    <form action="{{ route('consultations.destroy', $consultation) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Delete this consultation record completely?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-500 hover:text-red-700 transition-colors">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @if($consultations->isEmpty())
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400">No consultations logged
                                    yet.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
</body>

</html>
