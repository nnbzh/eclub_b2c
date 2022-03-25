<?php

namespace App\Repositories;

use App\Models\MenuItem;

class MenuItemRepository
{
    public function list() {
        return MenuItem::query()->with('image')->limit(8)->orderBy('lft')->get();
    }
}
