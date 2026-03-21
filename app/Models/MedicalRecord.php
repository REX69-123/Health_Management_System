<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = ['patient_id', 'diagnosis', 'diagnosis_date', 'treatment_plan', 'notes'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
