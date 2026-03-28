<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Patient extends Model
{
    // This allows Laravel to save these fields into MySQL
    protected $fillable = [
        'patient_number',
        'first_name',
        'last_name',
        'email',
        'dob',
        'gender',
        'status'
    ];
    public function getAgeAttribute()
    {
        if (!$this->dob) return 'N/A';
        return \Carbon\Carbon::parse($this->dob)->age;
    }
}
