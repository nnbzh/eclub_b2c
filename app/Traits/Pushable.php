<?php

namespace App\Traits;

use App\Models\SentPushNotification;
use App\Models\User;
use App\Services\Push\Classes\PushNotification;

trait Pushable
{
    public function sentPushNotifications() {
        return $this->morphMany(SentPushNotification::class, 'pushable');
    }

    public function toPush(User $notifiable = null, $data = []) {
        return new PushNotification($this, $notifiable, $data);
    }
}
