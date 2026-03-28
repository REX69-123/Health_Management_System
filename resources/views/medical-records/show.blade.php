@extends('layouts.app')

@section('content')
<style>
    @media print {
        .no-print {
            display: none !important;
        }

        body {
            background: white !important;
        }

        .print-shadow-none {
            shadow: none !important;
            border: 1px solid #e2e8f0 !important;
        }

        .sticky {
            position: static !important;
        }
    }
</style>

<div class="min-h-screen bg-slate-50 pb-12">
    <div class="bg-white border-b border-slate-200 sticky top-0 z-10 no-print">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('medical-records.index') }}"
                    class="p-2 hover:bg-slate-100 rounded-full transition-colors">
                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-xl font-bold text-slate-900">Patient Electronic Health Record</h1>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">File Reference: PT-{{
                        str_pad($patient->id, 5, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>
            <div class="flex gap-3">
                <button onclick="window.print()"
                    class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-slate-600 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Print Summary
                </button>
                <a href="{{ route('consultations.create', ['patient_id' => $patient->id]) }}"
                    class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-sm transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    New Consultation
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <div class="grid grid-cols-12 gap-8">

            <div class="col-span-12 lg:col-span-4 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden print-shadow-none">
                    <div class="h-24 bg-gradient-to-r from-blue-600 to-indigo-700 no-print"></div>
                    <div class="px-6 pb-6">
                        <div class="-mt-12 mb-4 no-print">
                            <div
                                class="inline-flex items-center justify-center w-24 h-24 bg-white rounded-2xl shadow-md border-4 border-white text-3xl font-bold text-blue-600 uppercase">
                                {{ substr($patient->first_name, 0, 1) }}{{ substr($patient->last_name, 0, 1) }}
                            </div>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-900 mt-4 lg:mt-0">{{ $patient->first_name }} {{
                            $patient->last_name }}</h2>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-slate-500 font-medium">{{ $patient->gender }}</span>
                            <span class="text-slate-300">•</span>
                            <span class="text-slate-500 font-medium">{{ $patient->age }} Years Old</span>
                        </div>
                        <div class="mt-6 grid grid-cols-2 gap-4 border-t border-slate-100 pt-6">
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Last Visit</p>
                                <p class="text-sm font-semibold text-slate-700">{{ $lastVisit ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Visits
                                </p>
                                <p class="text-sm font-semibold text-slate-700">{{ $visitCount ??
                                    $consultations->count() }} Records</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 print-shadow-none">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Contact Information</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-slate-50 rounded-lg">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <span class="text-sm text-slate-600 font-medium">{{ $patient->phone ?? 'No phone listed'
                                }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-slate-50 rounded-lg">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <span class="text-sm text-slate-600 font-medium truncate">{{ $patient->address ?? 'No
                                address listed' }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 print-shadow-none">
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-widest mb-4">Clinical Alerts</h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 p-3 bg-red-50 rounded-xl border border-red-100">
                            <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                            <span class="text-sm font-bold text-red-700">Allergies: None Recorded</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-8">
                <div class="mb-6 flex items-center justify-between no-print">
                    <h3 class="text-lg font-bold text-slate-800">Clinical Encounter Timeline</h3>
                    <div class="flex gap-2">
                        <span
                            class="px-3 py-1 bg-white border border-slate-200 text-slate-500 text-xs font-bold rounded-full shadow-sm">Sorted:
                            Newest First</span>
                    </div>
                </div>

                <div class="relative">
                    <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-slate-200 no-print"></div>

                    <div class="space-y-8">
                        @forelse($consultations as $consultation)
                        <div class="relative lg:pl-16">
                            <div
                                class="absolute left-[21px] top-2 w-2.5 h-2.5 rounded-full border-2 border-white bg-blue-600 ring-4 ring-blue-50 no-print">
                            </div>

                            <div
                                class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:border-blue-300 transition-all print-shadow-none">
                                <div
                                    class="bg-slate-50 px-6 py-3 border-b border-slate-200 flex justify-between items-center">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Visit:
                                            {{ $consultation->created_at->format('M d, Y') }}</span>
                                    </div>
                                    <span
                                        class="px-2 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-black uppercase rounded">Finalized
                                        Record</span>
                                </div>

                                <div class="p-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                        <div>
                                            <h4
                                                class="text-[10px] font-bold text-blue-600 uppercase tracking-widest mb-2">
                                                Diagnosis & Findings</h4>
                                            <p class="text-sm font-bold text-slate-800 leading-relaxed mb-3">
                                                {{ $consultation->diagnosis ?? 'Observation/General Check-up' }}
                                            </p>
                                            <div class="bg-slate-50 rounded-lg p-3 border-l-4 border-slate-200">
                                                <p class="text-xs text-slate-500 font-medium italic">"{{
                                                    $consultation->chief_complaint }}"</p>
                                            </div>
                                        </div>

                                        <div class="bg-blue-50/30 p-4 rounded-xl border border-blue-100/50">
                                            <h4
                                                class="text-[10px] font-bold text-blue-500 uppercase tracking-widest mb-2">
                                                Prescription / Plan</h4>
                                            <p class="text-sm text-slate-700 font-medium leading-relaxed">
                                                {{ $consultation->prescription ?? 'No medication or follow-up recorded.'
                                                }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-8 pt-6 border-t border-slate-100">
                                        <div class="grid grid-cols-4 gap-4">
                                            <div class="text-center md:text-left">
                                                <span
                                                    class="block text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Blood
                                                    Pressure</span>
                                                <span class="text-sm font-bold text-slate-700">{{
                                                    $consultation->blood_pressure ?? '--/--' }}</span>
                                                <span class="text-[10px] text-slate-400 ml-1">mmHg</span>
                                            </div>
                                            <div class="text-center md:text-left">
                                                <span
                                                    class="block text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Heart
                                                    Rate</span>
                                                <span class="text-sm font-bold text-slate-700">{{
                                                    $consultation->heart_rate ?? '--' }}</span>
                                                <span class="text-[10px] text-slate-400 ml-1">bpm</span>
                                            </div>
                                            <div class="text-center md:text-left">
                                                <span
                                                    class="block text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Temperature</span>
                                                <span class="text-sm font-bold text-slate-700">{{
                                                    $consultation->temperature ?? '--' }}</span>
                                                <span class="text-[10px] text-slate-400 ml-1">°C</span>
                                            </div>
                                            <div class="text-center md:text-left">
                                                <span
                                                    class="block text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Weight</span>
                                                <span class="text-sm font-bold text-slate-700">{{
                                                    $consultation->weight_kg ?? '--' }}</span>
                                                <span class="text-[10px] text-slate-400 ml-1">kg</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="relative lg:pl-16">
                            <div class="bg-white rounded-2xl border-2 border-dashed border-slate-200 p-16 text-center">
                                <div
                                    class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-slate-900 font-bold">Comprehensive History Empty</h3>
                                <p class="text-slate-500 text-sm mt-2 max-w-xs mx-auto">There are no completed medical
                                    logs for this patient profile in our digital registry.</p>
                                <a href="{{ route('consultations.create', ['patient_id' => $patient->id]) }}"
                                    class="mt-6 inline-flex items-center gap-2 px-6 py-2 bg-blue-600 text-white rounded-lg text-sm font-bold hover:bg-blue-700 transition-all">
                                    Add New Clinical Entry
                                </a>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
