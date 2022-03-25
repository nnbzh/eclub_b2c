<?php

namespace App\Repositories;

use App\Models\Privilege;

class PrivilegeRepository
{
    public function getByKey($key) {
        return Privilege::query()->where('key', $key)->first();
    }
}
