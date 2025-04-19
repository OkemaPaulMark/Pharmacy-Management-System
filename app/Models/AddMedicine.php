<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddMedicine extends Model
{
    use HasFactory;

    protected $table = 'add_medicines';
    protected $fillable = [
        'name',
        'category_id',
        'unit_price',
        'quantity',
        'supplier_id',
        'expiry_date',
        'description',
        'stock_id', // assuming you meant this instead of medicine_id
    ];
    

    protected $casts = [
        'expiry_date' => 'date',
        'unit_price' => 'decimal:2',
    ];

    /**
     * Get the stock associated with the medicine.
     */
    public function stock()
    {
        return $this->belongsTo(Stock::class, 'medicine_id');
    }

    /**
     * Get the category associated with the medicine (retained for existing functionality).
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get the supplier associated with the medicine (retained for existing functionality).
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    /**
     * Calculate the stock value as unit_price * quantity.
     */
    public function getStockValueAttribute()
    {
        return $this->unit_price * $this->quantity;
    }

    /**
     * Determine the stock status based on quantity:
     * - Critical Stock: quantity < 50
     * - Low Stock: 50 <= quantity < 100
     * - In Stock: quantity >= 100
     */
    public function getStatusAttribute()
    {
        if ($this->quantity < 50) {
            return 'Critical Stock';
        } elseif ($this->quantity < 100) {
            return 'Low Stock';
        }
        return 'In Stock';
    }
}
