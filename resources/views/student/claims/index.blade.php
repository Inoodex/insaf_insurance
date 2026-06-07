@extends('student.layouts.app')

@section('title', 'My Claims')

@section('content')
    <div class="flex flex-col items-center">
        <!-- New Claim Button -->
        <a href="{{ route('student.claims.create') }}" class="mb-12 px-8 py-3 bg-white border border-gray-100 rounded-full shadow-lg shadow-purple-50 flex items-center gap-3 hover:scale-105 transition-transform group">
            <div class="w-6 h-6 rounded-full bg-[#A294F9] text-white flex items-center justify-center font-bold">+</div>
            <span class="text-xs font-bold text-[#4A3B75] uppercase tracking-widest">Submit A Claim</span>
        </a>

        @if(session('success'))
            <div class="w-full mb-6 p-4 bg-green-50 text-green-600 rounded-2xl text-sm font-medium border border-green-100 text-center">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="w-full mb-6 p-4 bg-red-50 text-red-600 rounded-2xl text-sm font-medium border border-red-100 text-center">
                {{ session('error') }}
            </div>
        @endif

        <!-- Claims Table -->
        <div class="w-full">
            <div class="grid grid-cols-5 px-6 py-3 text-[10px] font-bold text-gray-300 uppercase tracking-widest border-b border-gray-50">
                <div class="col-span-2">Claim Details</div>
                <div class="text-center">Type</div>
                <div class="text-center">Date</div>
                <div class="text-center">Status</div>
            </div>

            <div class="space-y-4 mt-4">
                @forelse($claims as $claim)
                    <a href="{{ route('student.claims.show', $claim->id) }}" class="grid grid-cols-5 items-center px-6 py-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow border border-gray-50 group relative">
                        <div class="col-span-2 flex items-center gap-4">
                            <div class="w-8 h-8 rounded-full bg-purple-50 text-[#8E79F0] flex items-center justify-center">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V9z"/><polyline points="13 2 13 9 20 9"/></svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-[#4A3B75] group-hover:text-[#8E79F0]">{{ $claim->claim_number }}</h3>
                                <p class="text-[10px] text-gray-400 font-mono">{{ $claim->application->plan->plan_name }}</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <span class="px-3 py-1 bg-gray-50 text-gray-500 text-[10px] font-bold uppercase tracking-widest rounded-full">{{ $claim->claim_type }}</span>
                        </div>
                        <div class="text-center text-xs text-gray-500">{{ $claim->event_date->format('d.m.Y') }}</div>
                        <div class="text-center">
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-yellow-50 text-yellow-600',
                                    'under_review' => 'bg-blue-50 text-blue-600',
                                    'approved' => 'bg-green-50 text-green-600',
                                    'rejected' => 'bg-red-50 text-red-600',
                                    'paid' => 'bg-purple-50 text-[#8E79F0]',
                                ];
                                $statusClass = $statusClasses[$claim->status] ?? 'bg-gray-50 text-gray-500';
                            @endphp
                            <span class="px-3 py-1 {{ $statusClass }} text-[10px] font-bold uppercase tracking-widest rounded-full">
                                {{ str_replace('_', ' ', $claim->status) }}
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="text-center py-24 bg-white rounded-3xl border border-dashed border-gray-200">
                        <p class="text-gray-400 text-sm italic">You haven't submitted any claims yet.</p>
                        <a href="{{ route('student.claims.create') }}" class="text-[#8E79F0] text-xs font-bold uppercase tracking-widest mt-4 inline-block hover:underline">Start your first claim</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
