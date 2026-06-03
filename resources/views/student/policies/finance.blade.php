@extends('student.layouts.app')

@section('title', 'Finance')

@section('content')
    <div class="mb-12">
        <h2 class="text-4xl font-bold text-[#4A3B75] mb-8">Finance</h2>

        <div class="flex items-center gap-4 mb-12">
            <div class="w-6 h-6 rounded-full bg-green-50 text-green-400 flex items-center justify-center">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>
            <h3 class="text-2xl font-medium text-[#4A3B75]">{{ $application->plan->plan_name }}</h3>

            <!-- Policy Sub-nav -->
            <div class="ml-auto flex flex-wrap bg-gray-50/50 p-1 rounded-2xl border border-gray-50 student-option-nav">
                <a href="{{ route('student.policies.show', $application->id) }}"
                    class="flex flex-col items-center gap-1 px-4 py-2 rounded-xl">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                            stroke-linecap="round" />
                    </svg>
                    <span class="text-[8px] font-bold uppercase tracking-widest text-center">Details</span>
                </a>
                <a href="{{ route('student.policies.finance', $application->id) }}"
                    class="flex flex-col items-center gap-1 px-4 py-2 rounded-xl {{ request()->routeIs('student.policies.finance') ? 'is-active' : '' }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"
                            stroke-linecap="round" />
                    </svg>
                    <span class="text-[8px] font-bold uppercase tracking-widest">Finance</span>
                </a>
                <a href="{{ route('student.policies.download', $application->id) }}"
                    class="flex flex-col items-center gap-1 px-4 py-2 rounded-xl">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-linecap="round" />
                    </svg>
                    <span class="text-[8px] font-bold uppercase tracking-widest text-center">Download<br>Policy</span>
                </a>
                <a href="#" class="flex flex-col items-center gap-1 px-4 py-2 rounded-xl">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                            stroke-linecap="round" />
                    </svg>
                    <span class="text-[8px] font-bold uppercase tracking-widest">Contacts</span>
                </a>
            </div>
        </div>

        <div class="w-full">
            <h4 class="text-[10px] font-bold text-gray-600 uppercase tracking-[0.2em] mb-8">Completed Payments</h4>

            <div class="space-y-4">
                @if ($application->paid_on)
                    <div
                        class="flex items-center justify-between px-10 py-8 bg-white rounded-3xl shadow-2xl shadow-purple-50 border border-gray-50 group">
                        <div class="flex items-center gap-12">
                            <!-- Success Check -->
                            <div class="w-8 h-8 rounded-full bg-green-50 text-green-400 flex items-center justify-center">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="3">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>

                            <!-- From/To -->
                            <div class="flex gap-12">
                                <div>
                                    <span
                                        class="block text-[10px] font-bold text-gray-600 uppercase tracking-widest mb-1">From:</span>
                                    <span
                                        class="text-xs font-medium text-gray-500">{{ $application->start_date->format('d.m.Y') }}</span>
                                </div>
                                <div>
                                    <span
                                        class="block text-[10px] font-bold text-gray-600 uppercase tracking-widest mb-1">To:</span>
                                    <span
                                        class="text-xs font-medium text-gray-500">{{ $application->end_date->format('d.m.Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-16">
                            <!-- Download Icon -->
                            <a href="{{ route('student.policies.download', $application->id) }}"
                                class="w-10 h-10 rounded-full bg-[#8E79F0]/10 text-[#8E79F0] flex items-center justify-center hover:bg-[#8E79F0] hover:text-white transition-all">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </a>

                            <!-- Payment Date -->
                            <div>
                                <span
                                    class="block text-[10px] font-bold text-gray-600 uppercase tracking-widest mb-1">Payment
                                    Date:</span>
                                <span
                                    class="text-xs font-medium text-gray-500">{{ $application->paid_on->format('d.m.Y') }}</span>
                            </div>

                            <!-- Amount -->
                            <div class="text-right min-w-[100px]">
                                <span
                                    class="block text-[10px] font-bold text-gray-600 uppercase tracking-widest mb-1">{{ $application->currency }}</span>
                                <span
                                    class="text-lg font-bold text-gray-700">{{ number_format($application->premium_amount, 2) }}</span>
                            </div>

                            <!-- Status Badge -->
                            <span
                                class="px-4 py-1.5 bg-green-50 text-green-500 text-[10px] font-bold uppercase tracking-widest rounded-full flex items-center gap-2">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="3">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Paid
                            </span>

                            <!-- Arrow -->
                            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12 text-gray-400 text-sm italic">
                        No completed payments found for this policy.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
