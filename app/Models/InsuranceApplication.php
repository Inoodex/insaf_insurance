<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InsuranceApplication extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'student_id',
        'user_id',
        'plan_id',
        'policy_number',
        'gic_reference',
        'first_destination',
        'territories',
        'start_date',
        'end_date',
        'duration_days',
        'premium_amount',
        'currency',
        'paid_on',
        'status',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'paid_on' => 'date',
        'premium_amount' => 'decimal:2',
        'duration_days' => 'integer',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function plan()
    {
        return $this->belongsTo(InsurancePlan::class, 'plan_id');
    }

    public function benefitCoverages()
    {
        return $this->hasMany(BenefitCoverage::class, 'application_id');
    }

    public function emailLogs()
    {
        return $this->hasMany(EmailLog::class, 'application_id');
    }
}
