<?php

namespace App\Repositories;

use App\Models\Subscription;

class SubscriptionRepository
{
    public function getById($id) : Subscription|null {
        return Subscription::query()->where('id', $id)->first();
    }
}
