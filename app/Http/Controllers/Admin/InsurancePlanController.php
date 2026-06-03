<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InsurancePlan;
use Illuminate\Http\Request;

class InsurancePlanController extends Controller
{
    public function index()
    {
        $plans = InsurancePlan::latest()->paginate(15);
        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.plans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'plan_name' => 'required|string|max:255',
            'plan_level' => 'required|string|max:255',
            'description' => 'nullable|string',
            'medical_cover_max' => 'required|numeric|min:0',
            'sea_mountain_rescue_max' => 'required|numeric|min:0',
            'emergency_evacuation_max' => 'required|numeric|min:0',
            'medical_repatriation_max' => 'required|numeric|min:0',
            'repatriation_mortal_remains_max' => 'required|numeric|min:0',
            'luggage_max' => 'required|numeric|min:0',
            'luggage_deductible' => 'required|numeric|min:0',
            'accidental_death_max' => 'required|numeric|min:0',
            'accidental_disability_max' => 'required|numeric|min:0',
            'third_party_liability_max' => 'required|numeric|min:0',
            'no_deductible_medical' => 'boolean',
            'no_waiting_period' => 'boolean',
            'schengen_included' => 'boolean',
            'territories' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        InsurancePlan::create($validated);

        return redirect()->route('admin.plans.index')->with('success', 'Insurance plan created successfully.');
    }

    public function edit(InsurancePlan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    public function update(Request $request, InsurancePlan $plan)
    {
        $validated = $request->validate([
            'plan_name' => 'required|string|max:255',
            'plan_level' => 'required|string|max:255',
            'description' => 'nullable|string',
            'medical_cover_max' => 'required|numeric|min:0',
            'sea_mountain_rescue_max' => 'required|numeric|min:0',
            'emergency_evacuation_max' => 'required|numeric|min:0',
            'medical_repatriation_max' => 'required|numeric|min:0',
            'repatriation_mortal_remains_max' => 'required|numeric|min:0',
            'luggage_max' => 'required|numeric|min:0',
            'luggage_deductible' => 'required|numeric|min:0',
            'accidental_death_max' => 'required|numeric|min:0',
            'accidental_disability_max' => 'required|numeric|min:0',
            'third_party_liability_max' => 'required|numeric|min:0',
            'no_deductible_medical' => 'boolean',
            'no_waiting_period' => 'boolean',
            'schengen_included' => 'boolean',
            'territories' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $plan->update($validated);

        return redirect()->route('admin.plans.index')->with('success', 'Insurance plan updated successfully.');
    }

    public function destroy(InsurancePlan $plan)
    {
        if ($plan->applications()->count() > 0) {
            return redirect()->route('admin.plans.index')->with('error', 'Cannot delete plan as it is in use by applications.');
        }

        $plan->delete();
        return redirect()->route('admin.plans.index')->with('success', 'Insurance plan deleted successfully.');
    }
}
