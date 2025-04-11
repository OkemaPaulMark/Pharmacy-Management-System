<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddMedicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'category', 
        'unit_price',
        'quantity',
        'supplier',
        'supplier_id',
        'expiry_date',
        'description',
        'medicine_id',
    ];
    
    

    protected $casts = [
        'expiry_date' => 'date',
    ];

    // Relationships
    public function stock()
    {
        return $this->belongsTo(Stock::class, 'medicine_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    

    // // Accessors for backward compatibility
    // public function getCategoryAttribute()
    // {
    //     return $this->categoryRelation->name ?? null;
    // }

    // public function getSupplierAttribute()
    // {
    //     return $this->supplierRelation->supplier_name ?? null;
    // }
}