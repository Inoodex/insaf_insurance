<x-mail::message>
# Hello, {{ $application->student->full_name }}!

Your insurance application has been issued. Please find your policy details and billing summary below.

<x-mail::panel>
**Policy Number:** {{ $application->policy_number }}  
**Status:** {{ ucfirst($application->status) }}  
**Coverage Period:** {{ $application->start_date->format('d M Y') }} — {{ $application->end_date->format('d M Y') }} ({{ $application->duration_days }} days)
</x-mail::panel>

## Billing Summary

<x-mail::table>
| Item | Details |
| :--- | :--- |
| **Plan** | {{ $application->plan->plan_name }} ({{ $application->plan->plan_level }}) |
| **First Destination** | {{ $application->first_destination }} |
| **Territories** | {{ $application->territories ?? 'N/A' }} |
| **Premium** | {{ $application->currency }} {{ number_format((float) $application->premium_amount, 2) }} |
</x-mail::table>

{{-- ## Benefit Coverages

@php
    $benefitLabels = [
        'medical_cover' => 'Medical Cover',
        'sea_mountain_rescue' => 'Sea & Mountain Rescue',
        'emergency_evacuation' => 'Emergency Evacuation',
        'medical_repatriation' => 'Medical Repatriation',
        'repatriation_mortal_remains' => 'Repatriation of Mortal Remains',
        'luggage' => 'Luggage',
        'accidental_death' => 'Accidental Death',
        'accidental_disability' => 'Accidental Disability',
        'third_party_liability' => 'Third Party Liability',
    ];
@endphp

<x-mail::table>
| Benefit | Maximum Coverage |
| :--- | ---: |
@foreach ($application->benefitCoverages as $coverage)
| {{ $benefitLabels[$coverage->benefit_type] ?? ucwords(str_replace('_', ' ', $coverage->benefit_type)) }} | {{ $coverage->currency }} {{ number_format((float) $coverage->max_amount, 2) }} @if($coverage->deductible_note)<br><small>{{ $coverage->deductible_note }}</small>@endif |
@endforeach
</x-mail::table>

## Plan Features

<x-mail::table>
| Feature | Status |
| :--- | :--- |
| No Medical Deductible | {{ $application->plan->no_deductible_medical ? 'Yes' : 'No' }} |
| No Waiting Period | {{ $application->plan->no_waiting_period ? 'Yes' : 'No' }} |
| Schengen Included | {{ $application->plan->schengen_included ? 'Yes' : 'No' }} |
</x-mail::table> --}}

You can log in to your student portal to view the full policy details, download documents, or update your information at any time.

<x-mail::button :url="route('student.login')">
Open Student Portal
</x-mail::button>

If you have any questions about your policy, please contact our support team.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
