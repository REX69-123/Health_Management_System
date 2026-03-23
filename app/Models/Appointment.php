<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    // We added 'email' to this array so Laravel allows us to save it!
    protected $fillable = [
        'patient_id',
        'email',
        'appointment_date',
        'appointment_time',
        'purpose',
        'notes',
        'status'
    ];

    // Relationship to Patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
