<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
    ];

    // The product this cart line refers to.
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // The user who owns this cart line.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
