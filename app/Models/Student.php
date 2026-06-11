<?php

namespace App\Models;

use App\Notifications\StudentResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use SoftDeletes, Notifiable, CanResetPassword;

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new StudentResetPassword($token));
    }

    protected $fillable = [
        'full_name',
        'email',
        'passport_number',
        'date_of_birth',
        'gender',
        'nationality',
        'country_of_origin',
        'phone_number',
        'institute_name',
        'institute_address',
        'institute_phone',
        'address_2',
        'zip_code',
        'city',
        'country_code',
        'is_company',
        'correspondence_firstname',
        'correspondence_lastname',
        'correspondence_gender',
        'correspondence_address_1',
        'correspondence_address_2',
        'correspondence_country',
        'correspondence_zip_code',
        'correspondence_city',
        'correspondence_country_code',
        'correspondence_phone',
        'password',
        'temporary_password',
        'password_changed',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'temporary_password',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'password_changed' => 'boolean',
        'password' => 'hashed',
    ];

    public function applications()
    {
        return $this->hasMany(InsuranceApplication::class);
    }

    public function emailLogs()
    {
        return $this->hasMany(EmailLog::class);
    }

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }
}
