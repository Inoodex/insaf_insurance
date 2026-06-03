@extends('admin.layouts.master')

@section('title', 'Edit Insurance Application')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h2 class="text-xl font-semibold uppercase">Edit Application: #{{ $application->id }}</h2>
        <a href="{{ route('admin.applications.index') }}" class="btn btn-secondary gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to List
        </a>
    </div>

    <div class="panel mt-6">
        <form action="{{ route('admin.applications.update', $application->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div class="form-group">
                    <label>Student</label>
                    <input type="text" class="form-input bg-gray-100 cursor-not-allowed" value="{{ $application->student->full_name }}" readonly />
                </div>

                <div class="form-group">
                    <label>Insurance Plan</label>
                    <input type="text" class="form-input bg-gray-100 cursor-not-allowed" value="{{ $application->plan->plan_name }}" readonly />
                </div>

                <div class="form-group">
                    <label for="status">Application Status <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="draft" {{ old('status', $application->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="sent" {{ old('status', $application->status) == 'sent' ? 'selected' : '' }}>Sent (Generate Policy No)</option>
                        <option value="active" {{ old('status', $application->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="expired" {{ old('status', $application->status) == 'expired' ? 'selected' : '' }}>Expired</option>
                        <option value="cancelled" {{ old('status', $application->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="policy_number">Policy Number</label>
                    <input type="text" name="policy_number" id="policy_number" class="form-input {{ $application->policy_number ? 'bg-gray-100 cursor-not-allowed' : '' }}" 
                        value="{{ old('policy_number', $application->policy_number) }}" {{ $application->policy_number ? 'readonly' : '' }} placeholder="Auto-generated if status is 'Sent'" />
                </div>

                <div class="form-group">
                    <label for="first_destination">First Destination <span class="text-danger">*</span></label>
                    <input type="text" name="first_destination" id="first_destination" class="form-input" required value="{{ old('first_destination', $application->first_destination) }}" />
                </div>

                <div class="form-group">
                    <label for="premium_amount">Premium Amount ({{ $application->currency }}) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="premium_amount" id="premium_amount" class="form-input" required value="{{ old('premium_amount', $application->premium_amount) }}" />
                </div>

                <div class="form-group">
                    <label for="start_date">Start Date <span class="text-danger">*</span></label>
                    <input type="date" name="start_date" id="start_date" class="form-input" required value="{{ old('start_date', $application->start_date->format('Y-m-d')) }}" />
                </div>

                <div class="form-group">
                    <label for="end_date">End Date <span class="text-danger">*</span></label>
                    <input type="date" name="end_date" id="end_date" class="form-input" required value="{{ old('end_date', $application->end_date->format('Y-m-d')) }}" />
                </div>

                <div class="form-group md:col-span-2">
                    <label for="notes">Internal Notes</label>
                    <textarea name="notes" id="notes" class="form-textarea" rows="3">{{ old('notes', $application->notes) }}</textarea>
                </div>
            </div>

            <div class="mt-8 flex items-center gap-4">
                <button type="submit" class="btn btn-primary px-10">Update Application</button>
                <a href="{{ route('admin.applications.index') }}" class="btn btn-outline-danger">Cancel</a>
            </div>
        </form>
    </div>
@endsection
