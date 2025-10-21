<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'sale_date',
    ];

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    // Auto calculate total just like subtotal
    public function getTotalAttribute()
    {
        return $this->items->sum('subtotal');
    }
}
