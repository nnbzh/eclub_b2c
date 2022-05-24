<?php

namespace App\Http\Requests\Reminder;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReminderRequest extends FormRequest
{
    public function rules() {
        return [
            'name' => 'nullable|string',
            'days' => 'nullable|array|min:1',
            'slots' => 'nullable|array|min:1',
            'slots.*' => 'nullable|date_format:H:i',
        ];
    }
}
