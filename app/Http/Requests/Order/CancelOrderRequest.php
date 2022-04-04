<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CancelOrderRequest extends FormRequest
{
    public function rules() {
        return [
            'cancel_message_id' => 'required|exists:cancel_messages,id',
            'comment'           => 'nullable|string',
        ];
    }
}
