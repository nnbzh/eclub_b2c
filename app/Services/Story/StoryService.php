<?php

namespace App\Services\Story;

use App\Repositories\StoryRepository;

class StoryService
{
    public function __construct(private StoryRepository $storyRepository)
    {
    }

    public function list() {
        return $this->storyRepository->list();
    }
}
