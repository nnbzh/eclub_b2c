<?php

namespace App\Http\Requests\Reminder;

use Illuminate\Foundation\Http\FormRequest;

class SyncRemindersRequest extends FormRequest
{
    public function rules() {
        return [
            'reminders' => 'required|array'
        ];
    }
}
