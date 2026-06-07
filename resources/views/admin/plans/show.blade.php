@extends('admin.layouts.master')

@section('title', 'Plan Details')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-semibold uppercase">Plan Details: {{ $plan->plan_name }}</h2>
            <p class="mt-1 text-xs text-white-dark">{{ $plan->plan_level }}</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.plans.edit', $plan->id) }}" class="btn btn-primary gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
                Edit
            </a>
            <a href="{{ route('admin.plans.index') }}" class="btn btn-secondary gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Back to List
            </a>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="panel">
            <h3 class="mb-4 border-b pb-2 text-lg font-bold">Plan Information</h3>
            <div class="space-y-3">
                <div>
                    <span class="block text-white-dark">Plan Name</span>
                    <span class="font-semibold">{{ $plan->plan_name }}</span>
                </div>
                <div>
                    <span class="block text-white-dark">Level</span>
                    <span>{{ $plan->plan_level }}</span>
                </div>
                <div>
                    <span class="block text-white-dark">Territories</span>
                    <span>{{ $plan->territories ?? 'N/A' }}</span>
                </div>
                <div>
                    <span class="block text-white-dark">Status</span>
                    @if ($plan->is_active)
                        <span class="badge badge-outline-success">Active</span>
                    @else
                        <span class="badge badge-outline-danger">Inactive</span>
                    @endif
                </div>
                <div>
                    <span class="block text-white-dark">Applications</span>
                    <span>{{ $plan->applications_count }}</span>
                </div>
            </div>
        </div>

        <div class="panel">
            <h3 class="mb-4 border-b pb-2 text-lg font-bold">Rules</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between gap-4">
                    <span>No Medical Deductible</span>
                    <span class="badge {{ $plan->no_deductible_medical ? 'badge-outline-success' : 'badge-outline-danger' }}">
                        {{ $plan->no_deductible_medical ? 'Yes' : 'No' }}
                    </span>
                </div>
                <div class="flex items-center justify-between gap-4">
                    <span>No Waiting Period</span>
                    <span class="badge {{ $plan->no_waiting_period ? 'badge-outline-success' : 'badge-outline-danger' }}">
                        {{ $plan->no_waiting_period ? 'Yes' : 'No' }}
                    </span>
                </div>
                <div class="flex items-center justify-between gap-4">
                    <span>Schengen Included</span>
                    <span class="badge {{ $plan->schengen_included ? 'badge-outline-success' : 'badge-outline-danger' }}">
                        {{ $plan->schengen_included ? 'Yes' : 'No' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="panel">
            <h3 class="mb-4 border-b pb-2 text-lg font-bold">Description</h3>
            <p class="text-sm leading-6 text-white-dark">
                {{ $plan->description ?: 'No description added.' }}
            </p>
        </div>
    </div>

    <div class="panel mt-6">
        <h3 class="mb-4 text-lg font-bold">Benefit Limits</h3>
        <div class="overflow-x-auto">
            <table class="table-hover w-full table-auto">
                <thead>
                    <tr>
                        <th>Benefit</th>
                        <th>Maximum Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Medical Cover</td>
                        <td class="font-semibold">EUR {{ number_format($plan->medical_cover_max, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Sea and Mountain Rescue</td>
                        <td class="font-semibold">EUR {{ number_format($plan->sea_mountain_rescue_max, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Emergency Evacuation</td>
                        <td class="font-semibold">EUR {{ number_format($plan->emergency_evacuation_max, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Medical Repatriation</td>
                        <td class="font-semibold">EUR {{ number_format($plan->medical_repatriation_max, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Repatriation of Mortal Remains</td>
                        <td class="font-semibold">EUR {{ number_format($plan->repatriation_mortal_remains_max, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Luggage</td>
                        <td class="font-semibold">
                            EUR {{ number_format($plan->luggage_max, 2) }}
                            <span class="ml-2 text-xs text-white-dark">Deductible: EUR {{ number_format($plan->luggage_deductible, 2) }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Accidental Death</td>
                        <td class="font-semibold">EUR {{ number_format($plan->accidental_death_max, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Accidental Disability</td>
                        <td class="font-semibold">EUR {{ number_format($plan->accidental_disability_max, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Third Party Liability</td>
                        <td class="font-semibold">EUR {{ number_format($plan->third_party_liability_max, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
