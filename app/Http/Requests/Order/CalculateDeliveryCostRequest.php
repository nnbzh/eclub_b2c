<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CalculateDeliveryCostRequest extends AvailableDeliveryMethodsRequest
{
    public function rules() {
        return array_merge(
            parent::rules(),
            ['owner_id' => 'required|in:app_ios,app_android',]
        );
    }
}
