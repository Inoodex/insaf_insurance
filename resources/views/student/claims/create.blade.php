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
            <form action="{{ $step == 6 ? route('student.claims.store') : route('student.claims.create') }}" method="POST" enctype="multipart/form-data" id="claimForm">
                @csrf
                <input type="hidden" name="step" value="{{ $step }}">
                
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
                        <div class="w-full max-w-md">
                            <select name="type" class="w-full px-6 py-4 outline-none font-medium appearance-none" onchange="this.form.submit()">
                                <option value=""> Choose Claim Type </option>
                                @foreach(['Illness', 'Accident', 'Maternity', 'Dental', 'Liability', 'Disability', 'Luggage', 'Cancellation trip', 'Repatriation', 'Search and rescue', 'Ambulance Air, Sea, Ground', 'Death', 'Other'] as $type)
                                    <option value="{{ $type }}" {{ $claimType == $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @elseif($step == 3)
                    <!-- Step 3: Claim Details -->
                    <input type="hidden" name="policy_id" value="{{ $selectedPolicy }}">
                    <input type="hidden" name="type" value="{{ $claimType }}">
                    <div class="grid grid-cols-2 gap-12 py-8">
                        <div class="space-y-8">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3">Date of the event <span class="text-red-400">*</span></label>
                                <div class="relative">
                                    <input type="date" name="event_date" required class="w-full bg-[#f4f7ff] border-none rounded-xl px-6 py-4 outline-none text-[#4A3B75] font-medium">
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="w-1/3">
                                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3">Currency <span class="text-red-400">*</span></label>
                                    <select name="currency" required class="w-full px-4 py-4 outline-none font-medium appearance-none">
                                        <option value="EUR">EUR</option>
                                        <option value="USD">USD</option>
                                        <option value="GBP">GBP</option>
                                    </select>
                                </div>
                                <div class="flex-grow">
                                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3">Amount <span class="text-red-400">*</span></label>
                                    <input type="number" step="0.01" name="amount" placeholder="0.00" required min="0.01" class="w-full bg-[#f4f7ff] border-none rounded-xl px-6 py-4 outline-none text-[#4A3B75] font-medium">
                                </div>
                            </div>
                        </div>
                        <div class="space-y-8">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3">Are you working?</label>
                                <div class="space-y-4">
                                    <label class="flex items-center gap-4 cursor-pointer group">
                                        <input type="radio" name="is_working" value="0" class="hidden" checked>
                                        <div class="w-5 h-5 rounded-full border-2 border-gray-100 flex items-center justify-center bg-gray-50 group-hover:border-[#A294F9]">
                                            <div class="w-2 h-2 rounded-full bg-[#A294F9] opacity-0 radio-check"></div>
                                        </div>
                                        <span class="text-xs font-bold text-gray-500 uppercase tracking-widest">No</span>
                                    </label>
                                    <label class="flex items-center gap-4 cursor-pointer group">
                                        <input type="radio" name="is_working" value="1" class="hidden">
                                        <div class="w-5 h-5 rounded-full border-2 border-gray-100 flex items-center justify-center bg-gray-50 group-hover:border-[#A294F9]">
                                            <div class="w-2 h-2 rounded-full bg-[#A294F9] opacity-0 radio-check"></div>
                                        </div>
                                        <span class="text-xs font-bold text-gray-500 uppercase tracking-widest">Yes, more than 8h/week</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <style>input[type="radio"]:checked + div .radio-check { opacity: 1; }</style>
                @elseif($step == 6)
                    <!-- Step 6: Final Confirmation -->
                    <div class="flex flex-col items-center justify-center gap-8 py-8">
                        <h3 class="text-xl font-medium text-[#4A3B75]">Review and confirm your claim</h3>

                        @php
                            $sessionData = session('claim_form', []);
                            $policyApp = \App\Models\InsuranceApplication::with('plan')->find($sessionData['policy_id'] ?? null);
                            $docCount = count($sessionData['documents'] ?? []);
                        @endphp

                        <div class="w-full max-w-md space-y-4">
                            <div class="flex items-center justify-between p-4 rounded-xl bg-gray-50/50 border border-gray-50">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Policy</span>
                                <span class="text-sm font-medium text-[#4A3B75]">{{ $policyApp?->policy_number ?? '-' }}</span>
                            </div>
                            <div class="flex items-center justify-between p-4 rounded-xl bg-gray-50/50 border border-gray-50">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Claim Type</span>
                                <span class="text-sm font-medium text-[#4A3B75]">{{ $sessionData['type'] ?? '-' }}</span>
                            </div>
                            <div class="flex items-center justify-between p-4 rounded-xl bg-gray-50/50 border border-gray-50">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Event Date</span>
                                <span class="text-sm font-medium text-[#4A3B75]">{{ $sessionData['event_date'] ?? '-' }}</span>
                            </div>
                            <div class="flex items-center justify-between p-4 rounded-xl bg-gray-50/50 border border-gray-50">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Amount</span>
                                <span class="text-sm font-medium text-[#4A3B75]">{{ $sessionData['currency'] ?? 'EUR' }} {{ number_format((float)($sessionData['amount'] ?? 0), 2) }}</span>
                            </div>
                            <div class="flex items-center justify-between p-4 rounded-xl bg-gray-50/50 border border-gray-50">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Working &gt; 8h/week</span>
                                <span class="text-sm font-medium text-[#4A3B75]">{{ ($sessionData['is_working'] ?? '0') == '1' ? 'Yes' : 'No' }}</span>
                            </div>
                            <div class="flex items-center justify-between p-4 rounded-xl bg-gray-50/50 border border-gray-50">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Documents</span>
                                <span class="text-sm font-medium text-[#4A3B75]">{{ $docCount }} file(s)</span>
                            </div>
                            <div class="flex items-center justify-between p-4 rounded-xl bg-gray-50/50 border border-gray-50">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Bank</span>
                                <span class="text-sm font-medium text-[#4A3B75]">{{ $sessionData['bank_name'] ?? '-' }}</span>
                            </div>
                        </div>

                        <label class="flex items-center gap-3 cursor-pointer mt-4">
                            <input type="checkbox" name="confirm" value="1" id="confirmCheck" required class="sr-only" {{ old('confirm') ? 'checked' : '' }}>
                            <span class="w-5 h-5 rounded-md border-2 border-gray-200 flex items-center justify-center bg-white transition-all" id="confirmBox">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="4" id="confirmTick" class="hidden"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            </span>
                            <span class="text-xs text-gray-500">I confirm the information above is accurate and complete.</span>
                        </label>
                        <style>
                            #confirmCheck:checked ~ #confirmBox {
                                background-color: #8E79F0;
                                border-color: #8E79F0;
                            }
                            #confirmCheck:checked ~ #confirmBox #confirmTick {
                                display: block;
                            }
                        </style>
                    </div>
                @elseif($step == 4)
                    <!-- Step 4: Upload Files -->
                    <input type="hidden" name="policy_id" value="{{ $selectedPolicy }}">
                    <input type="hidden" name="type" value="{{ $claimType }}">
                    <div class="flex flex-col items-center justify-center gap-8 py-8">
                        <h3 class="text-xl font-medium text-[#4A3B75]">Upload supporting documents</h3>
                        <p class="text-xs text-gray-400 text-center max-w-md">Invoices, medical reports, prescriptions, or any other relevant files. <br> Accepted: PDF, JPG, PNG, DOC (max 5MB each).</p>

                        @if(session('claim_form.documents') && count(session('claim_form.documents')) > 0)
                            <div class="w-full max-w-md space-y-2">
                                @foreach(session('claim_form.documents') as $idx => $doc)
                                    <div class="flex items-center justify-between gap-3 p-3 rounded-xl bg-purple-50/40 border border-purple-100">
                                        <div class="flex items-center gap-3 min-w-0 flex-1">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-[#8E79F0] shrink-0"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                            <div class="min-w-0 flex-1">
                                                <div class="text-xs font-medium text-gray-700 truncate">{{ $doc['file_name'] }}</div>
                                                <div class="text-[10px] text-gray-400 uppercase tracking-widest">{{ $doc['file_type'] }}</div>
                                            </div>
                                        </div>
                                        <a href="{{ asset('storage/' . $doc['file_path']) }}" target="_blank" class="text-[10px] font-bold text-[#8E79F0] uppercase tracking-widest hover:underline shrink-0">View</a>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <label class="w-full max-w-md cursor-pointer">
                            <input type="file" name="documents[]" multiple accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" class="hidden" id="documentInput" onchange="document.getElementById('fileLabel').textContent = this.files.length + ' file(s) selected'">
                            <div class="w-full p-8 rounded-2xl border-2 border-dashed border-gray-200 hover:border-[#A294F9] bg-gray-50/30 flex flex-col items-center gap-3 transition-all">
                                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-gray-300"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                <div class="text-sm font-medium text-gray-500" id="fileLabel">Click to upload documents</div>
                                <div class="text-[10px] text-gray-300 uppercase tracking-widest">PDF, JPG, PNG, DOC</div>
                            </div>
                        </label>
                    </div>
                @elseif($step == 5)
                    <!-- Step 5: Bank Details -->
                    <input type="hidden" name="policy_id" value="{{ $selectedPolicy }}">
                    <input type="hidden" name="type" value="{{ $claimType }}">
                    <div class="flex flex-col items-center justify-center gap-8 py-8 w-full max-w-md mx-auto">
                        <h3 class="text-xl font-medium text-[#4A3B75]">Bank details for reimbursement</h3>
                        <div class="w-full space-y-6">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3">Bank Name <span class="text-red-400">*</span></label>
                                <input type="text" name="bank_name" value="{{ old('bank_name', session('claim_form.bank_name')) }}" class="w-full bg-[#f4f7ff] border-none rounded-xl px-6 py-4 outline-none text-[#4A3B75] font-medium" required>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3">Account Holder <span class="text-red-400">*</span></label>
                                <input type="text" name="account_holder" value="{{ old('account_holder', session('claim_form.account_holder')) }}" class="w-full bg-[#f4f7ff] border-none rounded-xl px-6 py-4 outline-none text-[#4A3B75] font-medium" required>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3">IBAN (Account Number) <span class="text-red-400">*</span></label>
                                <input type="text" name="iban" value="{{ old('iban', session('claim_form.iban')) }}" class="w-full bg-[#f4f7ff] border-none rounded-xl px-6 py-4 outline-none text-[#4A3B75] font-medium" required>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3">BIC / SWIFT Code <span class="text-red-400">*</span></label>
                                <input type="text" name="bic_swift" value="{{ old('bic_swift', session('claim_form.bic_swift')) }}" class="w-full bg-[#f4f7ff] border-none rounded-xl px-6 py-4 outline-none text-[#4A3B75] font-medium" required>
                            </div>
                        </div>
                    </div>
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
                            {{ $step == 4 ? 'Upload & Continue' : ($step == 6 ? 'Submit Claim' : 'Next') }}
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
