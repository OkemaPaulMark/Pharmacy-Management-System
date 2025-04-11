<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posterminal extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_id',
        'category_id',
        'unit_price',
        'quantity',
        'total',
        'prescription',
        'user_id'
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getSalesReport()
    {
        return self::with(['medicine', 'category', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
