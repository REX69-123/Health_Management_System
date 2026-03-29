@extends('layouts.apps')

@section('content')
<div class="min-h-screen bg-slate-50 pb-12">
    <div class="bg-white border-b border-slate-200 sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <div
                    class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center text-white text-xl font-black shadow-lg shadow-blue-200">
                    {{ substr(Auth::guard('patient')->user()->first_name, 0, 1) }}
                </div>
                <div>
                    <h1 class="text-xl font-bold text-slate-900">
                        Welcome back, {{ $patient->first_name ?? $patient->name ?? 'User' }}!
                    </h1>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-widest">Patient Portal • Last Sync:
                        {{ now()->format('h:i A') }}</p>
                </div>
            </div>
            <div class="flex gap-3">
                <form action="{{ route('portal.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 text-sm font-bold text-red-600 hover:bg-red-50 rounded-lg transition-all">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <div class="grid grid-cols-12 gap-8">

            <div class="col-span-12 lg:col-span-4 space-y-6">
                <div
                    class="bg-gradient-to-br from-red-500 to-red-600 rounded-2xl shadow-lg shadow-red-100 p-6 text-white">
                    <h3 class="text-lg font-bold mb-2">Need Urgent Care?</h3>
                    <p class="text-red-50 text-sm mb-4">Click below to send an immediate alert to the clinic staff.</p>
                    <form action="{{ route('portal.emergency') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full py-3 bg-white text-red-600 rounded-xl font-bold text-sm hover:bg-red-50 transition-all shadow-md">
                            Request Emergency Assistance
                        </button>
                    </form>
                </div>

                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-slate-500">Patient ID</span>
                        <span class="text-sm font-bold text-slate-700">#{{ str_pad($patient->id, 5, '0', STR_PAD_LEFT)
                            }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-slate-500">Gender</span>
                        <span class="text-sm font-bold text-slate-700">{{ $patient->gender ?? 'Not Set' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-slate-500">Age</span>
                        <span class="text-sm font-bold text-slate-700">{{ $patient->age }} Years</span>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-8">
                <div class="mb-6 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-800">My Health Records</h3>
                    <span class="text-xs font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-full uppercase">Official
                        Results Only</span>
                </div>

                <div class="space-y-4">
                    @forelse($consultations as $consultation)
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:border-blue-400 transition-all group">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                                        <span
                                            class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Finalized
                                            Consultation</span>
                                    </div>
                                    <h4 class="text-lg font-bold text-slate-900">{{ $consultation->diagnosis ?? 'General
                                        Check-up' }}</h4>
                                    <p class="text-sm text-slate-500 mt-1">Consulted on {{
                                        $consultation->created_at->format('M d, Y') }}</p>
                                </div>
                                <div class="text-right">
                                    <span
                                        class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Doctor/Staff</span>
                                    <span class="text-sm font-bold text-slate-700">Clinic Physician</span>
                                </div>
                            </div>

                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                                    <span
                                        class="block text-[10px] font-bold text-blue-600 uppercase tracking-widest mb-1">Prescription</span>
                                    <p class="text-sm text-slate-700 font-medium italic">"{{ $consultation->prescription
                                        ?? 'No medication prescribed.' }}"</p>
                                </div>
                                <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                                    <span
                                        class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Doctor's
                                        Note</span>
                                    <p class="text-sm text-slate-600 leading-relaxed">{{ $consultation->chief_complaint
                                        }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="bg-white rounded-3xl border-2 border-dashed border-slate-200 p-16 text-center">
                        <div
                            class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-slate-900 font-bold text-lg">No records yet</h3>
                        <p class="text-slate-500 text-sm mt-2">Your medical records will appear here once your
                            consultations are finalized by the clinic.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
