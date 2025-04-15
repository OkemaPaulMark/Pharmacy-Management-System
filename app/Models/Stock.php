<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks';
    protected $fillable = [
        'medicine',
        'supplier_id',
        'quantity',
        'expiry_date',
        'unit_cost',
        'purchase_date',
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'purchase_date' => 'date',
    ];

    /**
     * Get the supplier associated with the stock.
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Calculate the expiry status based on the difference between current date and expiry date.
     */
    public function getExpiryStatusAttribute()
    {
        $today = Carbon::today();
        $expiryDate = Carbon::parse($this->expiry_date);
        $monthsDifference = $today->diffInMonths($expiryDate, false);

        if ($today > $expiryDate) {
            return 'Expired';
        } elseif ($monthsDifference <= 6) {
            return 'Expiring Soon';
        } else {
            return 'Safe';
        }
    }
}
