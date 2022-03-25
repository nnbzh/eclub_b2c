<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'number',
        'user_id',
        'user_address_id',
        'pharmacy_id',
        'payment_method_id',
        'delivery_method_id',
        'customer_name',
        'customer_phone',
        'comment',
        'cost',
        'used_bonuses',
        'delivery_cost',
        'status',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot('quantity');
    }
}
