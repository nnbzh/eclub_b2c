<?php

namespace App\Repositories;

use App\Models\Reminder;

class ReminderRepository
{
    public function create($data) {
        return Reminder::query()->create($data);
    }

    public function update(Reminder $reminder, $data) {
        $reminder->fill($data);
        $reminder->saveOrFail();

        return $reminder;
    }

    public function getById($id) {
        return Reminder::findOrFail($id);
    }
}
