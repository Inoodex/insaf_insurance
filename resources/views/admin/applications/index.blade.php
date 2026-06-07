@extends('admin.layouts.master')

@section('title', 'Insurance Applications')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h2 class="text-xl font-semibold uppercase">Insurance Applications</h2>
        <div class="flex w-full flex-wrap items-center justify-end gap-4 sm:w-auto">
            <a href="{{ route('admin.applications.create') }}" class="btn btn-primary gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    class="h-5 w-5">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                New Application
            </a>
        </div>
    </div>

    <div class="panel mt-6">
        <div class="mb-5 flex flex-col gap-3 md:flex-row md:items-center">
            <form action="{{ route('admin.applications.index') }}" method="GET" class="flex w-full flex-col gap-2 md:flex-row md:items-center">
                <div class="relative min-w-0 flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Student Name, Passport or Policy..." class="form-input ltr:pr-11 rtl:pl-11" />
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
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="sent" {{ request('status') == 'sent' ? 'selected' : '' }}>Sent</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
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
                            <th>Student</th>
                            <th>Policy Number</th>
                            <th>Plan</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applications as $application)
                            <tr>
                                <td>
                                    <div class="font-semibold">{{ $application->student->full_name }}</div>
                                    <div class="text-xs text-white-dark">{{ $application->student->passport_number }}</div>
                                </td>
                                <td>
                                    @if($application->policy_number)
                                        <span class="font-mono text-primary font-bold">{{ $application->policy_number }}</span>
                                    @else
                                        <span class="text-white-dark italic">Not Issued</span>
                                    @endif
                                </td>
                                <td>{{ $application->plan->plan_name }}</td>
                                <td>
                                    <div class="text-sm">{{ $application->start_date->format('d M Y') }}</div>
                                    <div class="text-xs text-white-dark">{{ $application->duration_days }} Days</div>
                                </td>
                                <td>
                                    @php
                                        $statusClass = [
                                            'draft' => 'badge-outline-warning',
                                            'sent' => 'badge-outline-info',
                                            'active' => 'badge-outline-success',
                                            'expired' => 'badge-outline-danger',
                                            'cancelled' => 'badge-outline-secondary',
                                        ][$application->status] ?? 'badge-outline-primary';
                                    @endphp
                                    <span class="badge {{ $statusClass }} capitalize">
                                        {{ $application->status }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        @if(!in_array($application->status, ['expired', 'cancelled']))
                                            <form action="{{ route('admin.applications.send-email', $application->id) }}" method="POST" class="inline" onsubmit="return confirm('{{ $application->status === 'draft' ? 'This will generate a policy number, mark the application as Sent, and email the billing summary to the student. Continue?' : 'Send the policy-issued email with billing summary to the student?' }}');">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-info" title="Send Policy Email">
                                                    {{ $application->status === 'draft' ? 'Issue & Email' : 'Email Application' }}
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('admin.applications.show', $application->id) }}" class="btn btn-sm btn-outline-info">View</a>
                                        <a href="{{ route('admin.applications.edit', $application->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form action="{{ route('admin.applications.destroy', $application->id) }}" method="POST" onsubmit="return confirm('Delete this application?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No insurance applications found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $applications->links() }}
            </div>
        </div>
    </div>
@endsection
