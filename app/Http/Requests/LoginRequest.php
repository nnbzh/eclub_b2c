<?php

namespace App\Http\Requests;

class LoginRequest extends PhoneNumberRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'password' => 'required'
        ]);
    }
}
