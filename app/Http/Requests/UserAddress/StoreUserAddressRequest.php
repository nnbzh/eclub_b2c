<?php

namespace App\Http\Requests\UserAddress;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserAddressRequest extends FormRequest
{
    public function rules() {
        return [
            'name'      => 'nullable|string',
            'address'   => 'required|string',
            'city_id'   => 'required|int|exists:cities,id',
            'entrance'  => 'nullable',
            'floor'     => 'nullable|int',
            'apartment' => 'nullable',
            'lat'       => 'nullable|string',
            'lng'       => 'nullable|string',
        ];
    }
}
