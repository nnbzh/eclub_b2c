<?php

namespace App\Services\Reminder;

use App\Models\Reminder;
use App\Models\User;
use App\Repositories\ReminderRepository;

class ReminderService
{
    public function __construct(private ReminderRepository $reminderRepository)
    {
    }

    public function createForUser(User $user, $data) {
        $data['user_id'] = $user->id;

        return $this->reminderRepository->create($data);
    }

    public function update(Reminder $reminder, $data) {
        return $this->reminderRepository->update($reminder, $data);
    }

    public function sync(User $user, $data)
    {
        $data = collect($data['reminders']);
        $newReminders = $data->whereNull('id')->toArray();
        foreach ($newReminders as &$reminder) {
            $reminder['user_id'] = $user->id;
            $reminder['days'] = json_encode($reminder['days'], JSON_UNESCAPED_UNICODE);
            $reminder['slots'] = json_encode($reminder['slots'], JSON_UNESCAPED_UNICODE);
        }
        $user->reminders()->insert($newReminders);

        return $user->reminders()->get();
    }
}
