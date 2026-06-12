<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'country',
        'zip_code',
        'subtotal',
        'shipping_price',
        'total',
        'shipping_method',
        'payment_method',
        'status',
    ];

    // The allowed order statuses — used to build the admin filter/select
    // and to validate status updates. Single source of truth.
    public const STATUSES = [
        'New',
        'Accepted',
        'Cancelled',
        'Onshipping',
        'Completed',
    ];

    // An order is made up of many line items.
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // The customer who placed the order (nullable if the account was deleted).
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
