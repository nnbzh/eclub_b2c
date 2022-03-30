<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscribeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'subscription_id'   => 'required|exists:subscriptions,id',
            'bankcard_id'       => 'required|exists:bankcards,id'
        ];
    }
}
