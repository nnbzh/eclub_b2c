<?php

namespace App\Http\Requests\Bankcard;

use Illuminate\Foundation\Http\FormRequest;

class StoreBankcardRequest extends FormRequest
{
    public function rules() {
        return [
            'acquirer' => 'required|in:paybox,cloudpayments'
        ];
    }
}
