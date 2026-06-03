@extends('admin.layouts.master')

@section('title', 'Create Insurance Plan')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <h2 class="text-xl font-semibold uppercase">Create New Insurance Plan</h2>
        <a href="{{ route('admin.plans.index') }}" class="btn btn-secondary gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back to List
        </a>
    </div>

    <div class="panel mt-6">
        <form action="{{ route('admin.plans.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div class="form-group">
                    <label for="plan_name">Plan Name <span class="text-danger">*</span></label>
                    <input type="text" name="plan_name" id="plan_name" class="form-input" required value="{{ old('plan_name') }}" placeholder="e.g. Standard" />
                </div>
                <div class="form-group">
                    <label for="plan_level">Plan Level <span class="text-danger">*</span></label>
                    <input type="text" name="plan_level" id="plan_level" class="form-input" required value="{{ old('plan_level') }}" placeholder="e.g. Basic, Premium" />
                </div>
                <div class="form-group md:col-span-2">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-textarea" rows="2">{{ old('description') }}</textarea>
                </div>

                <div class="md:col-span-2 mt-4">
                    <h3 class="text-lg font-bold border-b pb-2 mb-4">Coverage Limits (EUR)</h3>
                </div>

                <div class="form-group">
                    <label for="medical_cover_max">Medical Cover Max <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="medical_cover_max" id="medical_cover_max" class="form-input" required value="{{ old('medical_cover_max', 0) }}" />
                </div>
                <div class="form-group">
                    <label for="emergency_evacuation_max">Emergency Evacuation Max <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="emergency_evacuation_max" id="emergency_evacuation_max" class="form-input" required value="{{ old('emergency_evacuation_max', 0) }}" />
                </div>
                <div class="form-group">
                    <label for="medical_repatriation_max">Medical Repatriation Max <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="medical_repatriation_max" id="medical_repatriation_max" class="form-input" required value="{{ old('medical_repatriation_max', 0) }}" />
                </div>
                <div class="form-group">
                    <label for="sea_mountain_rescue_max">Sea/Mountain Rescue Max <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="sea_mountain_rescue_max" id="sea_mountain_rescue_max" class="form-input" required value="{{ old('sea_mountain_rescue_max', 0) }}" />
                </div>
                <div class="form-group">
                    <label for="repatriation_mortal_remains_max">Repatriation Mortal Remains <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="repatriation_mortal_remains_max" id="repatriation_mortal_remains_max" class="form-input" required value="{{ old('repatriation_mortal_remains_max', 0) }}" />
                </div>
                <div class="form-group">
                    <label for="luggage_max">Luggage Max <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="luggage_max" id="luggage_max" class="form-input" required value="{{ old('luggage_max', 0) }}" />
                </div>
                <div class="form-group">
                    <label for="luggage_deductible">Luggage Deductible <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="luggage_deductible" id="luggage_deductible" class="form-input" required value="{{ old('luggage_deductible', 0) }}" />
                </div>
                <div class="form-group">
                    <label for="accidental_death_max">Accidental Death Max <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="accidental_death_max" id="accidental_death_max" class="form-input" required value="{{ old('accidental_death_max', 0) }}" />
                </div>
                <div class="form-group">
                    <label for="accidental_disability_max">Accidental Disability Max <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="accidental_disability_max" id="accidental_disability_max" class="form-input" required value="{{ old('accidental_disability_max', 0) }}" />
                </div>
                <div class="form-group">
                    <label for="third_party_liability_max">Third Party Liability Max <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="third_party_liability_max" id="third_party_liability_max" class="form-input" required value="{{ old('third_party_liability_max', 0) }}" />
                </div>

                <div class="md:col-span-2 mt-4">
                    <h3 class="text-lg font-bold border-b pb-2 mb-4">Additional Info</h3>
                </div>

                <div class="form-group">
                    <label for="territories">Territories</label>
                    <input type="text" name="territories" id="territories" class="form-input" value="{{ old('territories', 'Worldwide excluding US, Canada and country of origin') }}" />
                </div>

                <div class="flex flex-wrap gap-10 mt-4 md:col-span-2">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="no_deductible_medical" class="form-checkbox" value="1" {{ old('no_deductible_medical', 1) ? 'checked' : '' }} />
                        <span class="text-white-dark">No Medical Deductible</span>
                    </label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="no_waiting_period" class="form-checkbox" value="1" {{ old('no_waiting_period', 1) ? 'checked' : '' }} />
                        <span class="text-white-dark">No Waiting Period</span>
                    </label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="schengen_included" class="form-checkbox" value="1" {{ old('schengen_included', 1) ? 'checked' : '' }} />
                        <span class="text-white-dark">Schengen Included</span>
                    </label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" class="form-checkbox" value="1" {{ old('is_active', 1) ? 'checked' : '' }} />
                        <span class="text-white-dark">Plan Active</span>
                    </label>
                </div>
            </div>

            <div class="mt-8 flex items-center gap-4">
                <button type="submit" class="btn btn-primary px-10">Save Plan</button>
                <button type="reset" class="btn btn-outline-danger">Reset Form</button>
            </div>
        </form>
    </div>
@endsection
