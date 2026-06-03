@extends('admin.layouts.master')

@section('title', 'New Insurance Application')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h2 class="text-xl font-semibold uppercase">New Insurance Application</h2>
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
        <form action="{{ route('admin.applications.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div class="form-group">
                    <label for="student_id">Select Student <span class="text-danger">*</span></label>
                    <select name="student_id" id="student_id" class="form-select" required>
                        <option value="">Choose Student</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                {{ $student->full_name }} ({{ $student->passport_number }})
                            </option>
                        @endforeach
                    </select>
                    @error('student_id') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="plan_id">Select Insurance Plan <span class="text-danger">*</span></label>
                    <select name="plan_id" id="plan_id" class="form-select" required>
                        <option value="">Choose Plan</option>
                        @foreach($plans as $plan)
                            <option value="{{ $plan->id }}" {{ old('plan_id') == $plan->id ? 'selected' : '' }}>
                                {{ $plan->plan_name }} ({{ $plan->plan_level }})
                            </option>
                        @endforeach
                    </select>
                    @error('plan_id') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="first_destination">First Destination <span class="text-danger">*</span></label>
                    <input type="text" name="first_destination" id="first_destination" class="form-input" required value="{{ old('first_destination', 'Malta') }}" />
                </div>

                <div class="form-group">
                    <label for="currency">Currency <span class="text-danger">*</span></label>
                    <select name="currency" id="currency" class="form-select" required>
                        <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                        <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD ($)</option>
                        <option value="GBP" {{ old('currency') == 'GBP' ? 'selected' : '' }}>GBP (£)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="start_date">Start Date <span class="text-danger">*</span></label>
                    <input type="date" name="start_date" id="start_date" class="form-input" required value="{{ old('start_date') }}" />
                </div>

                <div class="form-group">
                    <label for="end_date">End Date <span class="text-danger">*</span></label>
                    <input type="date" name="end_date" id="end_date" class="form-input" required value="{{ old('end_date') }}" />
                </div>

                <div class="form-group">
                    <label for="premium_amount">Premium Amount <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="premium_amount" id="premium_amount" class="form-input" required value="{{ old('premium_amount') }}"/>
                </div>

                <div class="form-group md:col-span-2">
                    <label for="notes">Internal Notes</label>
                    <textarea name="notes" id="notes" class="form-textarea" rows="3">{{ old('notes') }}</textarea>
                </div>
            </div>

            <div class="mt-8 flex items-center gap-4">
                <button type="submit" class="btn btn-primary px-10">Create Draft Application</button>
                <button type="reset" class="btn btn-outline-danger">Reset Form</button>
            </div>
        </form>
    </div>
@endsection
