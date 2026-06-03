<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Claim extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'student_id',
        'application_id',
        'claim_number',
        'claim_type',
        'event_date',
        'amount',
        'currency',
        'is_working',
        'description',
        'bank_name',
        'account_holder',
        'iban',
        'bic_swift',
        'status',
        'admin_notes',
        'processed_at',
    ];

    protected $casts = [
        'event_date' => 'date',
        'amount' => 'decimal:2',
        'is_working' => 'boolean',
        'processed_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function application()
    {
        return $this->belongsTo(InsuranceApplication::class);
    }

    public function documents()
    {
        return $this->hasMany(ClaimDocument::class);
    }
}
