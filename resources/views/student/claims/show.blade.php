@extends('student.layouts.app')

@section('title', 'Claim Details')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-12">
            <h2 class="text-4xl font-bold text-[#4A3B75]">Claim Details</h2>
            <div class="flex items-center gap-2">
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
                <span class="px-6 py-2 {{ $statusClass }} text-xs font-bold uppercase tracking-widest rounded-full">
                    {{ str_replace('_', ' ', $claim->status) }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Main Info -->
            <div class="bg-white rounded-3xl p-8 shadow-2xl shadow-purple-50 border border-gray-50 space-y-8">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-purple-50 text-[#8E79F0] flex items-center justify-center">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V9z"/><polyline points="13 2 13 9 20 9"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-[#4A3B75]">{{ $claim->claim_number }}</h3>
                        <p class="text-xs text-gray-400 uppercase tracking-widest font-bold">Claim ID</p>
                    </div>
                </div>

                <div class="space-y-6 pt-4">
                    <div class="grid grid-cols-2">
                        <span class="text-[10px] font-bold text-gray-300 uppercase tracking-widest">Claim Type</span>
                        <span class="text-xs font-bold text-[#4A3B75] uppercase">{{ $claim->claim_type }}</span>
                    </div>
                    <div class="grid grid-cols-2">
                        <span class="text-[10px] font-bold text-gray-300 uppercase tracking-widest">Event Date</span>
                        <span class="text-xs font-medium text-gray-600">{{ $claim->event_date->format('d.m.Y') }}</span>
                    </div>
                    <div class="grid grid-cols-2">
                        <span class="text-[10px] font-bold text-gray-300 uppercase tracking-widest">Amount</span>
                        <span class="text-xs font-bold text-gray-700">{{ $claim->currency }} {{ number_format($claim->amount, 2) }}</span>
                    </div>
                    <div class="grid grid-cols-2">
                        <span class="text-[10px] font-bold text-gray-300 uppercase tracking-widest">Policy</span>
                        <span class="text-xs font-medium text-gray-600">{{ $claim->application->plan->plan_name }}</span>
                    </div>
                </div>
            </div>

            <!-- Bank Details -->
            <div class="bg-white rounded-3xl p-8 shadow-2xl shadow-purple-50 border border-gray-50">
                <h4 class="text-[10px] font-bold text-gray-300 uppercase tracking-[0.2em] mb-8">Bank Details</h4>
                <div class="space-y-6">
                    <div>
                        <span class="block text-[10px] font-bold text-gray-300 uppercase tracking-widest mb-1">Account Holder</span>
                        <span class="text-xs font-medium text-gray-700">{{ $claim->account_holder }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-gray-300 uppercase tracking-widest mb-1">Bank Name</span>
                        <span class="text-xs font-medium text-gray-700">{{ $claim->bank_name }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-gray-300 uppercase tracking-widest mb-1">IBAN</span>
                        <span class="text-xs font-mono font-medium text-gray-700">{{ $claim->iban }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-gray-300 uppercase tracking-widest mb-1">BIC/SWIFT</span>
                        <span class="text-xs font-mono font-medium text-gray-700">{{ $claim->bic_swift }}</span>
                    </div>
                </div>
            </div>

            <!-- Documents -->
            <div class="md:col-span-2 bg-white rounded-3xl p-8 shadow-2xl shadow-purple-50 border border-gray-50">
                <div class="flex items-center justify-between mb-8">
                    <h4 class="text-[10px] font-bold text-gray-300 uppercase tracking-[0.2em]">Attached Documents</h4>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($claim->documents as $doc)
                        <div class="flex items-center gap-4 p-4 rounded-2xl bg-gray-50 border border-gray-100 group">
                            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-[#8E79F0] shadow-sm">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            </div>
                            <div class="flex-grow min-w-0">
                                <p class="text-xs font-bold text-[#4A3B75] truncate">{{ $doc->file_name }}</p>
                                <p class="text-[8px] text-gray-400 uppercase tracking-widest">{{ $doc->created_at->format('d M Y') }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="w-8 h-8 rounded-full flex items-center justify-center transition-all student-icon-action" title="View Document">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                </a>
                                <a href="{{ Storage::url($doc->file_path) }}" download class="w-8 h-8 rounded-full flex items-center justify-center transition-all student-icon-action" title="Download Document">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-gray-400 italic">No documents attached.</p>
                    @endforelse
                </div>
            </div>

            @if($claim->admin_notes)
                <!-- Admin Notes -->
                <div class="md:col-span-2 bg-[#F9F8FF] rounded-3xl p-8 border border-purple-100">
                    <h4 class="text-[10px] font-bold text-purple-300 uppercase tracking-[0.2em] mb-4">Response from Admin</h4>
                    <p class="text-sm text-[#4A3B75] italic leading-relaxed">
                        "{{ $claim->admin_notes }}"
                    </p>
                    <div class="mt-4 flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-purple-400"></div>
                        <span class="text-[10px] font-bold text-purple-300 uppercase tracking-widest">
                            Processed on {{ $claim->processed_at->format('d M Y') }}
                        </span>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
