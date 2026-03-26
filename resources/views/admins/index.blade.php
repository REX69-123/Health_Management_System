<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Admins - Health Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-slate-50 flex h-screen overflow-hidden" x-data="{ selectedAdmin: null }">

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

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <header
            class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 shadow-sm shrink-0">
            <h1 class="text-xl font-semibold text-slate-800">Administrator Management</h1>
            <a href="{{ route('admins.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm">
                + Add New Admin
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
                <a href="{{ route('admins.index') }}"
                    class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center hover:shadow-md transition-shadow cursor-pointer">
                    <div
                        class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-xl font-bold mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total System Admins</p>
                        <p class="text-2xl font-bold text-slate-800">{{ $totalAdmins ?? 0 }}</p>
                    </div>
                </a>

                <a href="{{ route('admins.index', ['status' => 'Active']) }}"
                    class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center border-l-4 border-l-emerald-500 hover:shadow-md transition-shadow cursor-pointer">
                    <div
                        class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center text-xl font-bold mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Active Accounts</p>
                        <p class="text-2xl font-bold text-slate-800">{{ $activeAdmins ?? $totalAdmins ?? 0 }}</p>
                    </div>
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex justify-between items-center">
                    <h2 class="font-semibold text-slate-800">Admin Directory</h2>
                </div>

                <form action="{{ route('admins.index') }}" method="GET"
                    class="bg-white p-4 border-b border-slate-200 flex flex-col md:flex-row gap-4 items-center justify-between">

                    <div class="relative w-full md:w-1/3">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search name or email..."
                            class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm placeholder-slate-400">
                    </div>

                    <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto items-center">

                        <select name="sort" onchange="this.form.submit()"
                            class="w-full md:w-auto px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm bg-slate-50 text-slate-700 cursor-pointer">
                            <option value="newest" {{ request('sort')=='newest' ? 'selected' : '' }}>Newest Added
                            </option>
                            <option value="oldest" {{ request('sort')=='oldest' ? 'selected' : '' }}>Oldest Added
                            </option>
                            <option value="name_asc" {{ request('sort')=='name_asc' ? 'selected' : '' }}>Name (A-Z)
                            </option>
                            <option value="name_desc" {{ request('sort')=='name_desc' ? 'selected' : '' }}>Name (Z-A)
                            </option>
                        </select>

                        @if(request()->anyFilled(['search', 'sort']))
                        <a href="{{ route('admins.index') }}"
                            class="text-sm font-semibold text-red-500 hover:text-red-700 transition-colors px-2">
                            Clear
                        </a>
                        @endif

                        <button type="submit"
                            class="hidden md:block px-4 py-2 bg-slate-900 text-white text-sm font-bold rounded-lg hover:bg-slate-800 transition-colors">
                            Search
                        </button>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-slate-50 border-b border-slate-200 text-xs text-slate-500 uppercase tracking-wider">
                                <th class="p-4 font-medium w-1/6">Admin ID</th>
                                <th class="p-4 font-medium w-1/4">Full Name</th>
                                <th class="p-4 font-medium w-1/4">Email</th>
                                <th class="p-4 font-medium w-1/6">Status</th>
                                <th class="p-4 font-medium w-1/6 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @forelse($admins as $admin)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="p-4 text-sm text-slate-500 font-mono">ADM-{{ str_pad($admin->id, 4, '0',
                                    STR_PAD_LEFT) }}</td>

                                <td class="p-4">
                                    @php
                                    $adminData = [
                                    'id' => $admin->id,
                                    'name' => $admin->name,
                                    'number' => 'ADM-' . str_pad($admin->id, 4, '0', STR_PAD_LEFT),
                                    'email' => $admin->email,
                                    'joined' => $admin->created_at ? $admin->created_at->format('F d, Y') : 'N/A',
                                    'status' => 'Active',
                                    'edit_url' => route('admins.edit', $admin->id)
                                    ];
                                    @endphp

                                    <button @click='selectedAdmin = @json($adminData)'
                                        class="font-medium text-blue-600 hover:text-blue-800 text-left underline decoration-blue-100 underline-offset-4 decoration-2">
                                        {{ $admin->name }}
                                    </button>
                                </td>

                                <td class="p-4 text-sm">{{ $admin->email }}</td>
                                <td class="p-4">
                                    <span
                                        class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">
                                        Active
                                    </span>
                                </td>
                                <td class="p-4 text-right flex justify-end items-center space-x-4">
                                    <a href="{{ route('admins.edit', $admin->id) }}"
                                        class="text-blue-600 hover:text-blue-800 text-sm font-semibold">Update</a>

                                    <form action="{{ route('admins.destroy', $admin->id) }}" method="POST"
                                        onsubmit="return confirm('Remove this administrator from the database?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-500 hover:text-red-700 text-sm font-semibold">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-12 text-center text-slate-400">No administrator records found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div x-show="selectedAdmin" style="display: none;"
            class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">

            <div @click.outside="selectedAdmin = null" x-data="{ activeTab: 'profile' }"
                class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden flex flex-col">

                <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h3 class="font-bold text-lg text-slate-800" x-text="selectedAdmin?.name"></h3>
                    <span class="text-xs font-mono bg-blue-100 text-blue-700 px-2 py-1 rounded-md"
                        x-text="selectedAdmin?.number"></span>
                </div>

                <div class="flex border-b border-slate-200 px-6 pt-2 bg-slate-50/30">
                    <button @click="activeTab = 'profile'"
                        :class="activeTab === 'profile' ? 'border-blue-600 text-blue-700 font-bold' : 'border-transparent text-slate-500 hover:text-slate-700'"
                        class="px-4 py-2 border-b-2 text-sm transition-colors">
                        Admin Details
                    </button>
                    <button @click="activeTab = 'account'"
                        :class="activeTab === 'account' ? 'border-blue-600 text-blue-700 font-bold' : 'border-transparent text-slate-500 hover:text-slate-700'"
                        class="px-4 py-2 border-b-2 text-sm transition-colors">
                        System Access Info
                    </button>
                </div>

                <div class="p-6">
                    <div x-show="activeTab === 'profile'" class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                                <p class="text-xs font-bold uppercase text-slate-400 mb-1">Date Joined</p>
                                <p class="text-sm text-slate-800 font-medium" x-text="selectedAdmin?.joined"></p>
                            </div>
                            <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                                <p class="text-xs font-bold uppercase text-slate-400 mb-1">System Role</p>
                                <p class="text-sm text-slate-800 font-medium">Administrator</p>
                            </div>
                        </div>
                        <div
                            class="flex items-center justify-between p-3 bg-emerald-50 rounded-xl border border-emerald-100">
                            <p class="text-xs font-bold uppercase text-emerald-600">Account Status</p>
                            <span class="text-sm font-bold text-emerald-700" x-text="selectedAdmin?.status"></span>
                        </div>
                    </div>

                    <div x-show="activeTab === 'account'" style="display: none;" class="space-y-4">
                        <div class="p-4 bg-blue-50 rounded-xl border border-blue-100">
                            <p class="text-xs font-bold uppercase text-blue-600 mb-1">System Login Email</p>
                            <p class="text-sm text-slate-800 font-medium" x-text="selectedAdmin?.email"></p>
                        </div>
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                            <p class="text-xs font-bold uppercase text-slate-500 mb-1">Account Password</p>
                            <p class="text-sm text-slate-700 font-mono tracking-widest">••••••••</p>
                            <p class="text-xs text-slate-400 mt-2">Passwords are encrypted. To reset this admin's
                                password, click Edit below.</p>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-between items-center">
                    <a :href="selectedAdmin?.edit_url"
                        class="text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">
                        Edit Administrator
                    </a>

                    <button @click="selectedAdmin = null"
                        class="bg-white border border-slate-300 px-6 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:bg-slate-100 transition-colors">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
