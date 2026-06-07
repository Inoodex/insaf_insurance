@extends('admin.layouts.master')

@section('title', 'Claims Management')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h2 class="text-xl font-semibold uppercase">Claims Management</h2>
    </div>

    <div class="panel mt-6">
        <div class="mb-5 flex flex-col gap-3 md:flex-row md:items-center">
            <form action="{{ route('admin.claims.index') }}" method="GET" class="flex w-full flex-col gap-2 md:flex-row md:items-center">
                <div class="relative min-w-0 flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Student, Passport or Claim #..." class="form-input ltr:pr-11 rtl:pl-11" />
                    <button type="submit" class="absolute inset-y-0 flex items-center hover:text-primary ltr:right-4 rtl:left-4">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor" stroke-width="1.5" opacity="0.5" />
                            <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </button>
                </div>
                <div class="flex shrink-0 gap-2">
                    <select name="status" class="form-select pr-10">
                        <option value="">Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary shrink-0">Filter</button>
                </div>
            </form>
        </div>

        <div class="datatable">
            <div class="overflow-x-auto">
                <table class="table-hover w-full table-auto">
                    <thead>
                        <tr>
                            <th>Claim #</th>
                            <th>Student</th>
                            <th>Policy / Plan</th>
                            <th>Event Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($claims as $claim)
                            <tr>
                                <td>
                                    <span class="font-mono font-bold text-primary">{{ $claim->claim_number }}</span>
                                    <div class="text-xs text-white-dark capitalize">{{ $claim->claim_type }}</div>
                                </td>
                                <td>
                                    <div class="font-semibold">{{ $claim->student->full_name }}</div>
                                    <div class="text-xs text-white-dark">{{ $claim->student->passport_number }}</div>
                                </td>
                                <td>
                                    <div class="text-sm font-semibold">{{ $claim->application->policy_number }}</div>
                                    <div class="text-xs text-white-dark">{{ $claim->application->plan->plan_name }}</div>
                                </td>
                                <td>{{ $claim->event_date->format('d M Y') }}</td>
                                <td class="font-bold">
                                    {{ $claim->currency }} {{ number_format($claim->amount, 2) }}
                                </td>
                                <td>
                                    @php
                                        $statusClass = [
                                            'pending' => 'badge-outline-warning',
                                            'approved' => 'badge-outline-success',
                                            'rejected' => 'badge-outline-danger',
                                        ][$claim->status] ?? 'badge-outline-primary';
                                    @endphp
                                    <span class="badge {{ $statusClass }} capitalize">
                                        {{ $claim->status }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.claims.show', $claim->id) }}" class="btn btn-sm btn-outline-info">View & Process</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No claims found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $claims->links() }}
            </div>
        </div>
    </div>
@endsection
