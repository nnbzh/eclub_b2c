<?php

namespace App\Repositories;

use App\Models\Story;

class StoryRepository
{
    public function list() {
        return Story::query()
            ->with('image')
            ->where('is_active', true)
            ->orderBy('lft')
            ->get();
    }
}
