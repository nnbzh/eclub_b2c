<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class AvailableDeliveryMethodsRequest extends FormRequest
{
    public function rules() {
        return [
            'city_id'  => 'required|exists:cities,id',
            'lat'      => 'required',
            'lng'      => 'required',
            'positions' => 'required|array',
            'positions.*.sku' => 'required',
            'positions.*.quantity' => 'required',
        ];
    }
}
