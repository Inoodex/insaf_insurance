@extends('admin.layouts.master')

@section('title', 'New Insurance Application')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/nice-select2.css') }}" />
<style>
    .nice-select,
    .nice-select:hover,
    .nice-select:focus,
    .nice-select.open,
    .nice-select:active {
        width: 100%;
        float: none;
        height: auto;
        min-height: 42px;
        line-height: 1.5;
        font-size: 1rem;
        padding: 0.5rem 2.25rem 0.5rem 0.75rem;
        border-radius: 0;
        border-width: 1px;
        border-style: solid;
        border-color: #e0e6ed !important;
        background-color: #fff;
        background-image: none;
        color: inherit;
    }
    .nice-select:focus,
    .nice-select.open {
        border-color: #4361ee !important;
        box-shadow: 0 0 0 1px #4361ee;
    }
    .nice-select .current {
        display: block;
        line-height: 1.5;
    }
    .nice-select .list {
        max-height: 260px;
    }
</style>
@endpush

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

                <div class="form-group">
                    <label for="policy_number">Policy Number <span class="text-danger">*</span></label>
                    <input type="text" name="policy_number" id="policy_number" class="form-input" required value="{{ old('policy_number') }}" />
                    @error('policy_number') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="gic_reference">GIC Reference <span class="text-danger">*</span></label>
                    <input type="text" name="gic_reference" id="gic_reference" class="form-input" required value="{{ old('gic_reference') }}" />
                    @error('gic_reference') <span class="text-danger text-sm">{{ $message }}</span> @enderror
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
@push('page-scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        NiceSelect.bind(document.getElementById('student_id'), { searchable: true });
        NiceSelect.bind(document.getElementById('plan_id'), { searchable: true });
    });
</script>
@endpush
@endsection
