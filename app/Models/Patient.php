<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'allergies',
        'blood_group',
        'dob',
        'gender',
        'phone',
        'address',
        'caretaker',
        'caretaker_phone',
    ];
}
