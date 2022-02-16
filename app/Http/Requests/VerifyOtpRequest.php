<?php

namespace App\Http\Requests;

class VerifyOtpRequest extends PhoneNumberRequest
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            'code' => 'required|int|digits:4'
        ]);
    }
}
