<?php

namespace App\Http\Requests\UserAddress;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserAddressRequest extends FormRequest
{
    public function rules() {
        return [
            'address'   => 'required|string',
            'city_id'   => 'required|int|exists:cities,id',
            'block'     => 'nullable',
            'floor'     => 'nullable|int',
            'apartment' => 'nullable',
            'lat'       => 'nullable|string',
            'lng'       => 'nullable|string',
        ];
    }
}
