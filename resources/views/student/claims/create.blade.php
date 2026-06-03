@extends('student.layouts.app')

@section('title', 'Submit A Claim')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h2 class="text-4xl font-bold text-[#4A3B75] mb-12">Submit A Claim</h2>

        <!-- Progress Steps -->
        <div class="flex items-center justify-between mb-20 relative px-4">
            <div class="absolute top-1/2 left-0 right-0 h-0.5 bg-gray-100 -translate-y-1/2 z-0"></div>
            @php
                $steps = [
                    1 => 'Choose policy',
                    2 => 'Select claim type',
                    3 => 'Claim details',
                    4 => 'Upload files',
                    5 => 'Bank details',
                    6 => 'Final confirmation'
                ];
            @endphp
            @foreach($steps as $num => $label)
                <div class="relative z-10 flex flex-col items-center gap-4">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm transition-all
                        {{ $step == $num ? 'bg-white border-2 border-[#A294F9] text-[#A294F9] shadow-lg shadow-purple-50' : 
                           ($step > $num ? 'bg-[#7EE1C2] text-white' : 'bg-white border-2 border-gray-100 text-gray-200') }}">
                        @if($step > $num)
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        @else
                            {{ $num }}
                        @endif
                    </div>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-center whitespace-nowrap
                        {{ $step == $num ? 'text-[#7EE1C2]' : ($step > $num ? 'text-[#7EE1C2]' : 'text-gray-300') }}">
                        {{ $label }}
                    </span>
                </div>
            @endforeach
        </div>

        <div class="bg-white rounded-3xl p-12 shadow-2xl shadow-purple-50 border border-gray-50 min-h-[400px] flex flex-col">
            <form action="{{ $step == 6 ? route('student.claims.store') : route('student.claims.create') }}" method="{{ $step == 6 ? 'POST' : 'GET' }}" id="claimForm">
                @if($step == 6) @csrf @endif
                <input type="hidden" name="step" value="{{ $step + 1 }}">
                
                @if($step == 1)
                    <!-- Step 1: Choose Policy -->
                    <div class="flex flex-col items-center justify-center gap-8 py-12">
                        <h3 class="text-xl font-medium text-[#4A3B75]">Select the policy for this claim</h3>
                        <div class="grid grid-cols-1 gap-4 w-full max-w-md">
                            @foreach($applications as $app)
                                <label class="flex items-center gap-4 p-6 rounded-2xl border-2 cursor-pointer transition-all hover:border-[#A294F9] group
                                    {{ $selectedPolicy == $app->id ? 'border-[#A294F9] bg-purple-50/30' : 'border-gray-50 bg-gray-50/30' }}">
                                    <input type="radio" name="policy_id" value="{{ $app->id }}" class="hidden" {{ $selectedPolicy == $app->id ? 'checked' : '' }} onchange="this.form.submit()">
                                    <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center transition-all
                                        {{ $selectedPolicy == $app->id ? 'border-[#A294F9] bg-[#A294F9]' : 'border-gray-200 bg-white' }}">
                                        @if($selectedPolicy == $app->id) <div class="w-1.5 h-1.5 rounded-full bg-white"></div> @endif
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-[#4A3B75]">{{ $app->plan->plan_name }}</div>
                                        <div class="text-[10px] text-gray-400 font-mono">{{ $app->policy_number }}</div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @elseif($step == 2)
                    <!-- Step 2: Select Claim Type -->
                    <input type="hidden" name="policy_id" value="{{ $selectedPolicy }}">
                    <div class="flex flex-col items-center justify-center gap-8 py-12">
                        <h3 class="text-xl font-medium text-[#4A3B75]">What type of claim are you making?</h3>
                        <div class="w-full max-w-md relative">
                            <select name="type" class="w-full bg-[#f4f7ff] border-none rounded-xl px-6 py-4 outline-none text-[#4A3B75] font-medium appearance-none" onchange="this.form.submit()">
                                <option value=""> Choose Claim Type </option>
                                @foreach(['Illness', 'Accident', 'Maternity', 'Dental', 'Liability', 'Disability', 'Luggage', 'Cancellation trip', 'Repatriation', 'Search and rescue', 'Ambulance Air, Sea, Ground', 'Death', 'Other'] as $type)
                                    <option value="{{ $type }}" {{ $claimType == $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                            <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-[#4A3B75]">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                    </div>
                @elseif($step == 3)
                    <!-- Step 3: Claim Details -->
                    <input type="hidden" name="policy_id" value="{{ $selectedPolicy }}">
                    <input type="hidden" name="type" value="{{ $claimType }}">
                    <div class="grid grid-cols-2 gap-12 py-8">
                        <div class="space-y-8">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-300 uppercase tracking-widest mb-3">Date of the event</label>
                                <div class="relative">
                                    <input type="date" name="event_date" class="w-full bg-[#f4f7ff] border-none rounded-xl px-6 py-4 outline-none text-[#4A3B75] font-medium">
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="w-1/3">
                                    <label class="block text-[10px] font-bold text-gray-300 uppercase tracking-widest mb-3">Currency</label>
                                    <select name="currency" class="w-full bg-[#f4f7ff] border-none rounded-xl px-4 py-4 outline-none text-[#4A3B75] font-medium">
                                        <option value="EUR">EUR</option>
                                        <option value="USD">USD</option>
                                        <option value="GBP">GBP</option>
                                    </select>
                                </div>
                                <div class="flex-grow">
                                    <label class="block text-[10px] font-bold text-gray-300 uppercase tracking-widest mb-3">Amount</label>
                                    <input type="number" step="0.01" name="amount" placeholder="0.00" class="w-full bg-[#f4f7ff] border-none rounded-xl px-6 py-4 outline-none text-[#4A3B75] font-medium">
                                </div>
                            </div>
                        </div>
                        <div class="space-y-8">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-300 uppercase tracking-widest mb-3">Are you working?</label>
                                <div class="space-y-4">
                                    <label class="flex items-center gap-4 cursor-pointer group">
                                        <input type="radio" name="is_working" value="0" class="hidden" checked>
                                        <div class="w-5 h-5 rounded-full border-2 border-gray-100 flex items-center justify-center bg-gray-50 group-hover:border-[#A294F9]">
                                            <div class="w-2 h-2 rounded-full bg-[#A294F9] opacity-0 radio-check"></div>
                                        </div>
                                        <span class="text-xs font-bold text-gray-300 uppercase tracking-widest">No</span>
                                    </label>
                                    <label class="flex items-center gap-4 cursor-pointer group">
                                        <input type="radio" name="is_working" value="1" class="hidden">
                                        <div class="w-5 h-5 rounded-full border-2 border-gray-100 flex items-center justify-center bg-gray-50 group-hover:border-[#A294F9]">
                                            <div class="w-2 h-2 rounded-full bg-[#A294F9] opacity-0 radio-check"></div>
                                        </div>
                                        <span class="text-xs font-bold text-gray-300 uppercase tracking-widest">Yes, more than 8h/week</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <style>input[type="radio"]:checked + div .radio-check { opacity: 1; }</style>
                @endif

                <!-- Navigation Buttons -->
                <div class="mt-auto pt-12 flex items-center justify-center gap-12">
                    @if($step == 1)
                        <a href="{{ route('student.claims.index') }}" class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] hover:text-red-400 transition-colors">
                            Cancel
                        </a>
                    @endif

                    @if($step > 1)
                        <button type="button" onclick="window.history.back()" class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] hover:text-gray-600 transition-colors">
                            Step Back
                        </button>
                    @endif
                    
                    @if($step >= 3)
                        <button type="submit" class="w-48 py-4 bg-gradient-to-r from-[#8E79F0] to-[#A294F9] text-white font-bold rounded-full shadow-lg shadow-purple-100 hover:scale-105 transition-transform uppercase tracking-widest text-sm">
                            Next
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
