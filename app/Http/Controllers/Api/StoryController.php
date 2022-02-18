<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function __construct(private StoryService $storyService)
    {}

    public function index(Request $request) {

    }
}
