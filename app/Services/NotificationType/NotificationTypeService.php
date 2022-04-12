<?php

namespace App\Services\NotificationType;

use App\Models\User;
use App\Repositories\NotificationTypeRepository;

class NotificationTypeService
{
    public function __construct(private NotificationTypeRepository $notificationTypeRepository)
    {
    }

    public function list(User $user = null) {
        return $this->notificationTypeRepository->list($user);
    }
}
