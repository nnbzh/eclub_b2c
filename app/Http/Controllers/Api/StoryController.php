<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoryResource;
use App\Services\Story\StoryService;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function __construct(private StoryService $storyService)
    {}

    public function index(Request $request) {
        $stories = $this->storyService->list();

        return StoryResource::collection($stories);
    }
}
