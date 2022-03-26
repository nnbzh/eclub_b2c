<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'number',
        'user_id',
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
        'fields_json',
        'address'
    ];

    protected $casts = [
        'fields_json'   => 'array',
        'address'       => 'array',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function deliveryMethod() {
        return $this->belongsTo(DeliveryMethod::class);
    }

    public function paymentMethod() {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function pharmacy() {
        return $this->belongsTo(Pharmacy::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'order_product')
            ->withPivot('quantity', 'price');
    }
}
