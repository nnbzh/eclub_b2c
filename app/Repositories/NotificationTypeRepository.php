<?php

namespace App\Repositories;

use App\Helpers\NotificationStatus;
use App\Models\NotificationType;
use App\Models\User;

class NotificationTypeRepository
{
    public function list(User $user = null) {
        $query = NotificationType::query();

        if ($user) {
            $query->withCount([
                'sentPushNotifications' => fn($query) => $query
                    ->where('user_id', $user->id)
                    ->where('status', NotificationStatus::UNREAD)
            ]);
        }

        return $query->get();
    }
}
