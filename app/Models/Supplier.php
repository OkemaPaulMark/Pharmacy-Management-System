<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_name',
        'contact_person',
        'phone',
        'address',
        'email',
        'supplier_type',
    ];

    public function stocks()
{
    return $this->hasMany(Stock::class);
}

public function medicines()
{
    return $this->hasMany(AddMedicine::class);
}
}
