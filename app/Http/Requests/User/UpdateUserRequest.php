<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules() {
        return [
            'name'      => 'nullable|string',
            'email'     => 'nullable|email|unique',
            'gender'    => 'nullable|in:m,f',
            'birthdate' => 'nullable|date',
            'lang'      => 'nullable|in:kk,en,ru',
            'send_mail' => 'nullable|boolean',
            'send_notification' => 'nullable|boolean',
        ];
    }
}
