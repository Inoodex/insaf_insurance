<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BenefitCoverage extends Model
{
    protected $fillable = [
        'application_id',
        'benefit_type',
        'max_amount',
        'currency',
        'delivery_note',
        'deductible_note',
    ];

    protected $casts = [
        'max_amount' => 'decimal:2',
    ];

    public function application()
    {
        return $this->belongsTo(InsuranceApplication::class, 'application_id');
    }
}
