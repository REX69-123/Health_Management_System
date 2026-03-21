<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
