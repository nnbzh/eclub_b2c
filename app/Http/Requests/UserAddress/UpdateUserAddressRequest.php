<?php

namespace App\Http\Requests\UserAddress;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserAddressRequest extends FormRequest
{
    public function rules() {
        return [
            'name'      => 'nullable|string',
            'address'   => 'required|string',
            'entrance'  => 'nullable',
            'floor'     => 'nullable|int',
            'apartment' => 'nullable',
            'lat'       => 'nullable|string',
            'lng'       => 'nullable|string',
            'city_id'   => 'nullable|int|exists:cities,id',
        ];
    }
}
