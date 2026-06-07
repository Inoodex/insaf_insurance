@extends('admin.layouts.master')

@section('title', 'Insurance Plans')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h2 class="text-xl font-semibold uppercase">Insurance Plans</h2>
        <div class="flex w-full flex-wrap items-center justify-end gap-4 sm:w-auto">
            <a href="{{ route('admin.plans.create') }}" class="btn btn-primary gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Create Plan
            </a>
        </div>
    </div>

    <div class="panel mt-6">
        <div class="mb-5 flex flex-col gap-3 md:flex-row md:items-center">
            <form action="{{ route('admin.plans.index') }}" method="GET" class="flex w-full flex-col gap-2 md:flex-row md:items-center">
                <div class="relative min-w-0 flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Plan Name or Territory..." class="form-input ltr:pr-11 rtl:pl-11" />
                    <button type="submit" class="absolute inset-y-0 flex items-center hover:text-primary ltr:right-4 rtl:left-4">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor" stroke-width="1.5" opacity="0.5" />
                            <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </button>
                </div>
                <div class="flex shrink-0 gap-2">
                    <select name="level" class="form-select pr-10">
                        <option value="">Levels</option>
                        <option value="Basic" {{ request('level') == 'Basic' ? 'selected' : '' }}>Basic</option>
                        <option value="Premium" {{ request('level') == 'Premium' ? 'selected' : '' }}>Premium</option>
                    </select>
                    <select name="status" class="form-select pr-10">
                        <option value="">Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
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
                            <th>Plan Name</th>
                            <th>Level</th>
                            <th>Medical Cover</th>
                            <th>Territory</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($plans as $plan)
                            <tr>
                                <td>
                                    <div class="font-semibold">{{ $plan->plan_name }}</div>
                                    <div class="text-xs text-white-dark truncate max-w-[200px]">{{ $plan->description }}
                                    </div>
                                </td>
                                <td>{{ $plan->plan_level }}</td>
                                <td>€{{ number_format($plan->medical_cover_max, 2) }}</td>
                                <td>{{ $plan->territories ?? 'N/A' }}</td>
                                <td>
                                    @if ($plan->is_active)
                                        <span class="badge badge-outline-success">Active</span>
                                    @else
                                        <span class="badge badge-outline-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.plans.show', $plan->id) }}"
                                            class="btn btn-sm btn-outline-info">View</a>
                                        <a href="{{ route('admin.plans.edit', $plan->id) }}"
                                            class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form action="{{ route('admin.plans.destroy', $plan->id) }}" method="POST"
                                            onsubmit="return confirm('Delete this plan?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No insurance plans created yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $plans->links() }}
            </div>
        </div>
    </div>
@endsection
