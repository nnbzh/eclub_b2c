<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function rules() {
        return [
            'address_id'            => 'nullable|int|exists:user_addresses,id',
            'pharmacy_id'           => 'nullable|int|exists:pharmacies,id',
            'customer_name'         => 'nullable|string',
            'customer_phone'        => 'nullable|string',
            'cost'                  => 'required|int',
            'delivery_cost'         => 'required|int',
            'comment'               => 'nullable|string',
            'delivery_method_id'    => 'required|int|exists:delivery_methods,id',
            'payment_method_id'     => 'required|int|exists:payment_methods,id',
            'used_bonuses'          => 'nullable|int',
            'products'              => 'required|array',
            'products.*.product_id' => 'required|int|exists:products,id',
            'products.*.quantity'   => 'required|int|gte:1',
        ];
    }
}
