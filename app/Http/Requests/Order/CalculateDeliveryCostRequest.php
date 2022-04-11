<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CalculateDeliveryCostRequest extends FormRequest
{
    public function rules() {
        return [
            'owner_id' => 'required|in:app_ios,app_android',
            'city_id'  => 'required|exists:cities,id',
            'lat'      => 'required',
            'lng'      => 'required',
            'positions' => 'required|array',
            'positions.*.sku' => 'required',
            'positions.*.quantity' => 'required',
        ];
    }
}
