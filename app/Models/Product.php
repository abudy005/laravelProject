<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Fields that can be mass assigned (e.g. Product::create([...]))
    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'keywords',
        'description',
        'detail',
        'image',
        'price',
        'stock',
        'minstock',
        'discount',
        'status',
    ];

    // A product belongs to one category (Electronics, Phones, etc.)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // A product belongs to the user (admin) who created it
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Cart lines that reference this product (used for stock/cart logic).
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Order line items that reference this product.
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // The actual selling price after applying the discount percentage.
    // e.g. price 100 with discount 20 → 80. Used as $product->discounted_price.
    public function getDiscountedPriceAttribute()
    {
        return $this->price * (1 - $this->discount / 100);
    }
}
