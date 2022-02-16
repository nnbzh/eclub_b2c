<?php

namespace App\Repositories;

use App\Models\Block;

class BlockRepository
{
    public function list() {
        return Block::query()->orderBy('lft')->get();
    }
}
