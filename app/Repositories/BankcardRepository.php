<?php

namespace App\Repositories;

use App\Models\Bankcard;

class BankcardRepository
{
    public function getById($id) : Bankcard {
        return Bankcard::query()->where('id', $id)->first();
    }
}
