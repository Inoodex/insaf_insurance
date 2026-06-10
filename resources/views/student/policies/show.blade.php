@extends('student.layouts.app')

@section('title', 'Policy Details')

@section('content')
    <div class="mb-12">
        <h2 class="text-4xl font-bold text-[#4A3B75] mb-8">Policy</h2>

        <div class="flex items-center gap-4 mb-8">
            <div class="w-6 h-6 rounded-full bg-green-50 text-green-400 flex items-center justify-center">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>
            <h3 class="text-2xl font-medium text-[#4A3B75]">{{ $application->plan->plan_name }}</h3>

            <!-- Policy Sub-nav -->
            <div class="ml-auto flex flex-wrap bg-gray-50/50 p-1 rounded-2xl border border-gray-50 student-option-nav">
                <a href="{{ route('student.policies.show', $application->id) }}"
                    class="flex flex-col items-center gap-1 px-4 py-2 rounded-xl {{ request()->routeIs('student.policies.show') ? 'is-active' : '' }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                            stroke-linecap="round" />
                    </svg>
                    <span class="text-[10px] font-bold uppercase tracking-widest">Details</span>
                </a>
                <a href="{{ route('student.policies.finance', $application->id) }}"
                    class="flex flex-col items-center gap-1 px-4 py-2 rounded-xl">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"
                            stroke-linecap="round" />
                    </svg>
                    <span class="text-[10px] font-bold uppercase tracking-widest">Finance</span>
                </a>
                <a href="{{ route('student.policies.download', $application->id) }}"
                    class="flex flex-col items-center gap-1 px-4 py-2 rounded-xl">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-linecap="round" />
                    </svg>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-center">Download<br>Policy</span>
                </a>
                {{-- <a href="#" class="flex flex-col items-center gap-1 px-4 py-2 rounded-xl">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                            stroke-linecap="round" />
                    </svg>
                    <span class="text-[8px] font-bold uppercase tracking-widest">Contacts</span>
                </a> --}}
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Policy Details Card -->
            <div class="bg-white rounded-3xl p-8 shadow-2xl shadow-purple-50 border border-gray-80 flex flex-col gap-8">
                <h4 class="text-xs font-bold text-gray-600 uppercase tracking-widest">Policy</h4>
                <div class="space-y-6">
                    <div class="flex justify-between items-start">
                        <span class="text-xs font-bold text-gray-600 uppercase tracking-widest">Policy ID</span>
                        <span class="text-xs font-medium text-gray-700 text-right">{{ $application->policy_number }}</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-xs font-bold text-gray-600 uppercase tracking-widest min-w-[80px]">Insurance
                            Conditions</span>
                        <span
                            class="text-xs font-medium text-gray-700 text-right">{{ $application->gic_reference ?? 'ISIE-GIC-012026' }}</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-xs font-bold text-gray-600 uppercase tracking-widest">From</span>
                        <span
                            class="text-xs font-medium text-gray-700 text-right">{{ $application->start_date->format('d.m.Y') }}</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-xs font-bold text-gray-600 uppercase tracking-widest">End Date</span>
                        <span
                            class="text-xs font-medium text-gray-700 text-right">{{ $application->end_date->format('d.m.Y') }}</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-xs font-bold text-gray-600 uppercase tracking-widest">First Destination</span>
                        <span
                            class="text-xs font-medium text-gray-700 text-right">{{ $application->first_destination }}</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-xs font-bold text-gray-600 uppercase tracking-widest">Area of Cover</span>
                        <span
                            class="text-xs leading-relaxed font-medium text-gray-700">{{ $application->territories ?? 'Worldwide excluding US territories / Canada / Country of origin' }}</span>
                    </div>
                </div>
            </div>

            <!-- Policy Holder Card -->
            <div class="bg-white rounded-3xl p-8 shadow-2xl shadow-purple-50 border border-gray-80 flex flex-col gap-8">
                <h4 class="text-xs font-bold text-gray-600 uppercase tracking-widest">Policy Holder</h4>
                <div class="space-y-6">
                    <div class="flex justify-between items-start">
                        <span class="text-xs font-bold text-gray-600 uppercase tracking-widest">Name</span>
                        <div class="flex flex-col items-end">
                            <span
                                class="text-xs font-medium text-gray-700 uppercase">{{ explode(' ', $application->student->full_name)[0] }}</span>
                            <span
                                class="text-xs font-medium text-gray-700 uppercase">{{ explode(' ', $application->student->full_name)[1] ?? '' }}</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-xs font-bold text-gray-600 uppercase tracking-widest">Address</span>
                        <span
                            class="text-xs leading-relaxed font-medium text-gray-700 text-right max-w-[150px]">{{ $application->student->institute_address }}</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-xs font-bold text-gray-600 uppercase tracking-widest">Zip Code</span>
                        <span class="text-xs font-medium text-gray-700 text-right">PLA 1501</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-xs font-bold text-gray-600 uppercase tracking-widest">City</span>
                        <span class="text-xs font-medium text-gray-700 text-right">Tarxien</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-xs font-bold text-gray-600 uppercase tracking-widest">Country</span>
                        <span
                            class="text-xs font-medium text-gray-700 uppercase text-right">{{ $application->student->nationality }}</span>
                    </div>
                    <div class="flex justify-between items-start">
                        <span class="text-xs font-bold text-gray-600 uppercase tracking-widest">Phone Number</span>
                        <span
                            class="text-xs font-medium text-gray-700 text-right">{{ $application->student->phone_number ?? '77775386' }}</span>
                    </div>
                    <div class="flex justify-between items-start border-t border-gray-80 pt-4">
                        <span class="text-xs font-bold text-gray-600 uppercase tracking-widest">Plan Level</span>
                        <span
                            class="text-xs font-medium text-gray-700 uppercase text-right">{{ $application->plan->plan_level }}</span>
                    </div>
                </div>
            </div>

            <!-- Insured Person Card -->
            <div class="bg-white rounded-3xl p-8 shadow-2xl shadow-purple-50 border border-gray-80 flex flex-col gap-8">
                <h4 class="text-xs font-bold text-gray-600 uppercase tracking-widest">Insured Person(s)</h4>
                <div
                    class="p-6 bg-gray-50/50 rounded-2xl border border-gray-80 relative overflow-hidden group hover:bg-white hover:shadow-lg transition-all duration-300">
                    <div
                        class="absolute top-0 right-0 w-1 h-full bg-[#8E79F0] opacity-0 group-hover:opacity-100 transition-opacity">
                    </div>
                    <h5 class="text-xs font-medium text-gray-700 uppercase tracking-wide mb-1">
                        {{ $application->student->full_name }}</h5>
                    <p class="text-xs text-gray-700 font-medium">{{ $application->student->gender }} -
                        {{ $application->student->date_of_birth->format('d.m.Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Correspondence Link -->
        <!-- <div class="mt-12 flex items-center gap-2 group cursor-pointer">
                                    <span class="text-lg font-bold text-[#4A3B75] group-hover:text-[#8E79F0] transition-colors">+ CORRESPONDENCE</span>
                                </div> -->
    </div>
@endsection
