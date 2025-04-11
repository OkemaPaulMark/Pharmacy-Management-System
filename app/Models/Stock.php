<?php

namespace App\Models;

use App\Models\AddMedicine;
use App\Models\Supplier;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine',
        'supplier_id',
        'quantity',
        'expiry_date',
        'unit_cost',
        'purchase_date',
    ];

    // In your Stock model (app/Models/Stock.php)
protected $casts = [
    'expiry_date' => 'date',
    'purchase_date' => 'date',
];
    // Relationship to Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function medicine()
    {
        return $this->belongsTo(AddMedicine::class, 'medicine_id');
    }
    
}
