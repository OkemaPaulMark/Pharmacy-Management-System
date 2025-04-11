<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_id',
        'category_id',
        'quantity',
        'unit_price',
        'total',
        'prescription',
        'user_id',
    ];

    public function medicine()
    {
        return $this->belongsTo(AddMedicine::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}