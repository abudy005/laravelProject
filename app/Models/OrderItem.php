<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'product_title',
        'price',
        'quantity',
        'total',
    ];

    // The order this line belongs to.
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // The product this line refers to (nullable if later deleted).
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
