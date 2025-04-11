<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'blood_group',
        'allergies',
        'chronic_conditions',
        'current_medications',
        'special_notes',
    ];

public function patient()
{
    return $this->belongsTo(Patient::class);
}

}
