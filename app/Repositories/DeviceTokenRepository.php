<?php

namespace App\Repositories;

use App\Models\DeviceToken;

class DeviceTokenRepository
{
    public function create($data) {
        return DeviceToken::create($data);
    }
}
