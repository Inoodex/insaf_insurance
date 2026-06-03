@extends('student.layouts.app')

@section('title', 'My Policies')

@section('content')
    <div class="flex flex-col items-center">
        <!-- Dashboard Buttons -->
        <div class="flex gap-6 mb-12">
            <button
                class="px-8 py-3 bg-white border border-gray-100 rounded-full shadow-lg shadow-purple-50 flex items-center gap-3 hover:scale-105 transition-transform group">
                <div class="w-6 h-6 rounded-full bg-[#A294F9] text-white flex items-center justify-center font-bold">+</div>
                <span class="text-xs font-bold text-[#4A3B75] uppercase tracking-widest">Apply for Insurance</span>
            </button>
            <!-- <a href="{{ route('student.claims.create') }}" class="px-8 py-3 bg-white border border-gray-100 rounded-full shadow-lg shadow-purple-50 flex items-center gap-3 hover:scale-105 transition-transform group">
                                <div class="w-6 h-6 rounded-full bg-[#7EE1C2] text-white flex items-center justify-center font-bold">+</div>
                                <span class="text-xs font-bold text-[#4A3B75] uppercase tracking-widest">Submit A Claim</span>
                            </a> -->
        </div>

        <!-- Policies Table -->
        <div class="w-full">
            <div
                class="grid grid-cols-6 px-6 py-3 text-[10px] font-bold text-gray-600 uppercase tracking-widest border-b border-gray-50">
                <div class="col-span-2">Policy</div>
                <div class="text-center">Insured</div>
                <div class="text-center">From</div>
                <div class="text-center">End Date</div>
                <div class="text-right">Status</div>
            </div>

            <div class="space-y-4 mt-4">
                @forelse($applications as $application)
                    <a href="{{ route('student.policies.show', $application->id) }}"
                        class="grid grid-cols-6 items-center px-6 py-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow border border-gray-50 group">
                        <div class="col-span-2 flex items-center gap-4">
                            <div class="w-6 h-6 rounded-full bg-green-50 text-green-400 flex items-center justify-center">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="3">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-[#4A3B75] group-hover:text-[#8E79F0]">
                                    {{ $application->plan->plan_name }}</h3>
                                <p class="text-xs text-gray-400 font-mono">{{ $application->policy_number ?? 'PENDING' }}
                                </p>
                            </div>
                        </div>
                        <div class="text-center">
                            <span
                                class="w-6 h-6 rounded-full bg-gray-50 text-gray-500 text-[10px] font-bold inline-flex items-center justify-center">1</span>
                        </div>
                        <div class="text-center text-xs text-gray-500">{{ $application->start_date->format('d.m.Y') }}</div>
                        <div class="text-center text-xs text-gray-500">{{ $application->end_date->format('d.m.Y') }}</div>

                        <div class="flex justify-end">
                            @if ($application->paid_on)
                                <span
                                    class="px-4 py-1.5 bg-[#7EE1C2]/10 text-[#7EE1C2] text-[10px] font-bold uppercase tracking-widest rounded-full flex items-center gap-1.5">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="3">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    Paid
                                </span>
                            @endif
                        </div>
                    </a>
                @empty
                    <div class="text-center py-12 text-gray-400 text-sm italic">
                        No policies found.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Mobile App Links -->
        <div class="mt-24 flex flex-col items-center gap-8 opacity-100">
            <div class="flex flex-col items-center gap-2">
                <h4 class="text-2xl font-bold text-[#4A3B75] uppercase">{{ config('app.name') }}</h4>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Don't forget to download our
                    mobile app</p>
            </div>
            <div class="flex gap-4">
                <a href="#" class="hover:scale-105 transition-transform"><img
                        src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                        alt="Google Play" class="h-10"></a>
                <a href="#" class="hover:scale-105 transition-transform"><img
                        src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Download_on_the_App_Store_Badge.svg"
                        alt="App Store" class="h-10"></a>
            </div>
        </div>
    </div>
@endsection
