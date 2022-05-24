<?php

namespace App\Http\Requests\Reminder;

use Illuminate\Foundation\Http\FormRequest;

class StoreReminderRequest extends FormRequest
{
    public function rules() {
        return [
            'name' => 'required|string',
            'days' => 'required|array|min:1',
            'slots' => 'required|array|min:1',
            'slots.*' => 'required|date_format:H:i',
        ];
    }
}
