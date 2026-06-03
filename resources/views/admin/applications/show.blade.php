@extends('admin.layouts.master')

@section('title', 'Application Details')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h2 class="text-xl font-semibold uppercase">Application Details: #{{ $application->id }}</h2>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.applications.edit', $application->id) }}" class="btn btn-primary gap-2">
                Edit
            </a>
            <a href="{{ route('admin.applications.index') }}" class="btn btn-secondary gap-2">
                Back to List
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
                    <span class="font-semibold">{{ $application->student->full_name }}</span>
                </div>
                <div>
                    <span class="text-white-dark block">Email</span>
                    <span>{{ $application->student->email }}</span>
                </div>
                <div>
                    <span class="text-white-dark block">Passport</span>
                    <span>{{ $application->student->passport_number }}</span>
                </div>
                <div>
                    <span class="text-white-dark block">Nationality</span>
                    <span>{{ $application->student->nationality }}</span>
                </div>
                <div>
                    <span class="text-white-dark block">Institute</span>
                    <span class="text-sm">{{ $application->student->institute_name }}</span>
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
