<?php

namespace App\Models;

// Change 'Model' to 'Authenticatable'
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class Patient extends Authenticatable
{
    protected $fillable = [
        'patient_number',
        'first_name',
        'last_name',
        'email',
        'dob',
        'gender',
        'status',
        'password'
    ];

    protected $casts = [
        'dob' => 'date', // Ensures 'dob' is a date object
    ];

    // FIX FOR THE BLANK AGE IN DASHBOARD
    public function getAgeAttribute()
    {
        return $this->dob ? Carbon::parse($this->dob)->age : 'N/A';
    }
}
