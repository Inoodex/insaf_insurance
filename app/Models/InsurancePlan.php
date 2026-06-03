<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InsurancePlan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'plan_name',
        'plan_level',
        'description',
        'medical_cover_max',
        'sea_mountain_rescue_max',
        'emergency_evacuation_max',
        'medical_repatriation_max',
        'repatriation_mortal_remains_max',
        'luggage_max',
        'luggage_deductible',
        'accidental_death_max',
        'accidental_disability_max',
        'third_party_liability_max',
        'no_deductible_medical',
        'no_waiting_period',
        'schengen_included',
        'territories',
        'is_active',
    ];

    protected $casts = [
        'no_deductible_medical' => 'boolean',
        'no_waiting_period' => 'boolean',
        'schengen_included' => 'boolean',
        'is_active' => 'boolean',
        'medical_cover_max' => 'decimal:2',
        'sea_mountain_rescue_max' => 'decimal:2',
        'emergency_evacuation_max' => 'decimal:2',
        'medical_repatriation_max' => 'decimal:2',
        'repatriation_mortal_remains_max' => 'decimal:2',
        'luggage_max' => 'decimal:2',
        'luggage_deductible' => 'decimal:2',
        'accidental_death_max' => 'decimal:2',
        'accidental_disability_max' => 'decimal:2',
        'third_party_liability_max' => 'decimal:2',
    ];

    public function applications()
    {
        return $this->hasMany(InsuranceApplication::class, 'plan_id');
    }
}
