<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlockResource;
use App\Services\Block\BlockService;

class BlockController extends Controller
{
    public function __construct(private BlockService $blockService)
    {
    }

    public function index(Request $request) {
        $blocks = $this->blockService->list();

        return BlockResource::collection($blocks);
    }
}
