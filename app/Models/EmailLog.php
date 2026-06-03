<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    protected $fillable = [
        'student_id',
        'application_id',
        'user_id',
        'email_type',
        'subject',
        'recipient_email',
        'status',
        'sent_at',
        'error_message',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function application()
    {
        return $this->belongsTo(InsuranceApplication::class, 'application_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
