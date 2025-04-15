<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posterminal extends Model
{
    use HasFactory;

    protected $table = 'posterminals';

    protected $fillable = [
        'medicine_id',
        'category_id',
        'unit_price',
        'quantity',
        'total',
        'prescription',
        'user_id',
    ];

    public function medicine()
    {
        return $this->belongsTo(AddMedicine::class, 'medicine_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}