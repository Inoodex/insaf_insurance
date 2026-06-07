@extends('admin.layouts.master')

@section('title', 'Claim Details - ' . $claim->claim_number)

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h2 class="text-xl font-semibold uppercase">Claim: {{ $claim->claim_number }}</h2>
        <a href="{{ route('admin.claims.index') }}" class="btn btn-outline-primary">Back to List</a>
    </div>

    <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Main Claim Info -->
        <div class="panel lg:col-span-2">
            <div class="mb-5 flex items-center justify-between border-b border-[#ebedf2] pb-5 dark:border-[#1b2e4b]">
                <h5 class="text-lg font-semibold">Claim Information</h5>
                <span class="badge {{ $claim->status === 'pending' ? 'badge-outline-warning' : ($claim->status === 'approved' ? 'badge-outline-success' : 'badge-outline-danger') }} capitalize">
                    {{ $claim->status }}
                </span>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="text-white-dark">Claim Type</label>
                    <p class="font-semibold capitalize">{{ $claim->claim_type }}</p>
                </div>
                <div>
                    <label class="text-white-dark">Event Date</label>
                    <p class="font-semibold">{{ $claim->event_date->format('d M Y') }}</p>
                </div>
                <div>
                    <label class="text-white-dark">Amount</label>
                    <p class="text-lg font-bold text-primary">{{ $claim->currency }} {{ number_format($claim->amount, 2) }}</p>
                </div>
                <div>
                    <label class="text-white-dark">Employment Status</label>
                    <p class="font-semibold">{{ $claim->is_working ? 'Employed' : 'Unemployed' }}</p>
                </div>
            </div>

            <div class="mt-6">
                <label class="text-white-dark">Description / Case Details</label>
                <div class="mt-1 rounded-md bg-gray-50 p-4 dark:bg-dark-light/10">
                    {{ $claim->description ?: 'No description provided.' }}
                </div>
            </div>

            <div class="mt-8 border-t border-[#ebedf2] pt-8 dark:border-[#1b2e4b]">
                <h5 class="mb-4 text-lg font-semibold">Bank Account Details</h5>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="text-white-dark">Bank Name</label>
                        <p class="font-semibold">{{ $claim->bank_name }}</p>
                    </div>
                    <div>
                        <label class="text-white-dark">Account Holder</label>
                        <p class="font-semibold">{{ $claim->account_holder }}</p>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="text-white-dark">IBAN</label>
                        <p class="font-mono font-semibold">{{ $claim->iban }}</p>
                    </div>
                    <div>
                        <label class="text-white-dark">BIC / SWIFT</label>
                        <p class="font-mono font-semibold">{{ $claim->bic_swift }}</p>
                    </div>
                </div>
            </div>

            @if($claim->documents->count() > 0)
                <div class="mt-8 border-t border-[#ebedf2] pt-8 dark:border-[#1b2e4b]">
                    <h5 class="mb-4 text-lg font-semibold">Attached Documents</h5>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($claim->documents as $doc)
                            <div class="flex items-center gap-3 rounded-md border border-[#ebedf2] p-3 dark:border-[#1b2e4b]">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10 text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                                </div>
                                <div class="flex-1 overflow-hidden">
                                    <p class="truncate text-sm font-semibold">{{ $doc->file_name }}</p>
                                    <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="text-xs text-primary hover:underline">Download</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar: Student & Action -->
        <div class="space-y-6">
            <!-- Student Card -->
            <div class="panel">
                <h5 class="mb-4 text-lg font-semibold">Student Information</h5>
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-xl font-bold text-primary">
                        {{ substr($claim->student->first_name, 0, 1) }}{{ substr($claim->student->last_name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-semibold">{{ $claim->student->full_name }}</p>
                        <p class="text-sm text-white-dark">{{ $claim->student->email }}</p>
                    </div>
                </div>
                <div class="mt-4 space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-white-dark">Passport:</span>
                        <span class="font-semibold">{{ $claim->student->passport_number }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-white-dark">Nationality:</span>
                        <span class="font-semibold">{{ $claim->student->nationality }}</span>
                    </div>
                </div>
                <hr class="my-4 border-[#ebedf2] dark:border-[#1b2e4b]">
                <h6 class="font-semibold">Policy Details</h6>
                <div class="mt-2 space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-white-dark">Policy #:</span>
                        <span class="font-mono font-bold text-primary">{{ $claim->application->policy_number }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-white-dark">Plan:</span>
                        <span class="font-semibold">{{ $claim->application->plan->plan_name }}</span>
                    </div>
                </div>
            </div>

            <!-- Processing Card -->
            @if($claim->status === 'pending')
                <div class="panel">
                    <h5 class="mb-4 text-lg font-semibold">Process Claim</h5>
                    <form action="{{ route('admin.claims.process', $claim->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label>Admin Notes</label>
                            <textarea name="admin_notes" rows="3" class="form-textarea" placeholder="Add internal notes or reason for rejection..."></textarea>
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" name="status" value="approved" class="btn btn-success flex-1" onclick="return confirm('Approve this claim?')">Approve</button>
                            <button type="submit" name="status" value="rejected" class="btn btn-danger flex-1" onclick="return confirm('Reject this claim?')">Reject</button>
                        </div>
                    </form>
                </div>
            @else
                <div class="panel">
                    <h5 class="mb-4 text-lg font-semibold">Process Details</h5>
                    <div class="mb-4">
                        <label class="text-white-dark">Status</label>
                        <p class="font-semibold capitalize">{{ $claim->status }}</p>
                    </div>
                    @if($claim->processed_at)
                        <div class="mb-4">
                            <label class="text-white-dark">Processed Date</label>
                            <p class="font-semibold">{{ $claim->processed_at->format('d M Y H:i') }}</p>
                        </div>
                    @endif
                    @if($claim->admin_notes)
                        <div class="mb-4">
                            <label class="text-white-dark">Admin Notes</label>
                            <div class="rounded-md bg-gray-50 p-3 text-sm dark:bg-dark-light/10 italic">
                                "{{ $claim->admin_notes }}"
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
