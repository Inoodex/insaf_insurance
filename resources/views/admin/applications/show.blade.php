@extends('admin.layouts.master')

@section('title', 'Application Details')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h2 class="text-xl font-semibold uppercase">Application Details: #{{ $application->id }}</h2>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.applications.index') }}" class="btn btn-outline-secondary gap-2" aria-label="Back to list">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    class="h-5 w-5">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Back to List
            </a>
            {{-- @if($application->status === 'draft')
                <form action="{{ route('admin.applications.issue', $application->id) }}" method="POST"
                    onsubmit="return confirm('Issue this policy now? A confirmation email with the billing summary will be sent to the student.');"
                    class="inline">
                    @csrf
                    <button type="submit" class="btn btn-success gap-2" aria-label="Issue policy and email student">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            class="h-5 w-5">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                        Issue Policy
                    </button>
                </form>
            @endif --}}
            <a href="{{ route('admin.applications.edit', $application->id) }}" class="btn btn-primary gap-2" aria-label="Edit application">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    class="h-5 w-5">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
                Edit
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 mt-6">
        <!-- Student Info -->
        <div class="panel">
            <h3 class="text-lg font-bold mb-4 border-b pb-2">Student Information</h3>
            <div class="space-y-3">
                <div>
                    <span class="text-white-dark block">Full Name</span>
                    <span class="font-semibold">{{ optional($application->student)->full_name }}</span>
                </div>
                <div>
                    <span class="text-white-dark block">Email</span>
                    <span>{{ optional($application->student)->email }}</span>
                </div>
                <div>
                    <span class="text-white-dark block">Passport</span>
                    <span>{{ optional($application->student)->passport_number }}</span>
                </div>
                <div>
                    <span class="text-white-dark block">Nationality</span>
                    <span>{{ optional($application->student)->nationality }}</span>
                </div>
                <div>
                    <span class="text-white-dark block">Institute</span>
                    <span class="text-sm">{{ optional($application->student)->institute_name }}</span>
                </div>
            </div>
        </div>

        <!-- Policy Info -->
        <div class="panel">
            <h3 class="text-lg font-bold mb-4 border-b pb-2">Policy Information</h3>
            <div class="space-y-3">
                <div>
                    <span class="text-white-dark block">Status</span>
                    <span class="badge badge-outline-primary capitalize">{{ $application->status }}</span>
                </div>
                <div>
                    <span class="text-white-dark block">Policy Number</span>
                    <span class="font-mono text-primary font-bold">{{ $application->policy_number ?? 'Not Issued' }}</span>
                </div>
                <div>
                    <span class="text-white-dark block">Plan</span>
                    <span>{{ $application->plan->plan_name }} ({{ $application->plan->plan_level }})</span>
                </div>
                <div>
                    <span class="text-white-dark block">Period</span>
                    <span>{{ $application->start_date->format('d M Y') }} - {{ $application->end_date->format('d M Y') }}</span>
                </div>
                <div>
                    <span class="text-white-dark block">Premium</span>
                    <span class="font-bold text-success">{{ $application->currency }} {{ number_format($application->premium_amount, 2) }}</span>
                </div>
                <div>
                    <span class="text-white-dark block">Payment</span>
                    @if($application->paid_on)
                        <span class="badge badge-outline-success">Paid on {{ $application->paid_on->format('d M Y') }}</span>
                    @else
                        <span class="badge badge-outline-warning">Unpaid</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Meta Info -->
        <div class="panel">
            <h3 class="text-lg font-bold mb-4 border-b pb-2">Meta Data</h3>
            <div class="space-y-3">
                <div>
                    <span class="text-white-dark block">Created By</span>
                    <span>{{ $application->admin->name }}</span>
                </div>
                <div>
                    <span class="text-white-dark block">Created At</span>
                    <span>{{ $application->created_at->format('d M Y, h:i A') }}</span>
                </div>
                <div>
                    <span class="text-white-dark block">Duration</span>
                    <span>{{ $application->duration_days }} Days</span>
                </div>
                @if($application->notes)
                <div>
                    <span class="text-white-dark block">Notes</span>
                    <p class="text-sm">{{ $application->notes }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Benefit Coverages -->
    <div class="panel mt-6">
        <h3 class="text-lg font-bold mb-4">Benefit Coverages</h3>
        <div class="table-responsive">
            <table class="table-hover">
                <thead>
                    <tr>
                        <th>Benefit Type</th>
                        <th>Max Coverage</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($application->benefitCoverages as $benefit)
                        <tr>
                            <td class="capitalize">{{ str_replace('_', ' ', $benefit->benefit_type) }}</td>
                            <td class="font-semibold">{{ $benefit->currency }} {{ number_format($benefit->max_amount, 2) }}</td>
                            <td class="text-white-dark text-sm">
                                {{ $benefit->deductible_note }} {{ $benefit->delivery_note }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
