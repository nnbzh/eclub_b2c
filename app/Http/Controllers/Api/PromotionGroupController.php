<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PromotionGroupResource;
use App\Services\Product\PromotionGroupService;
use Illuminate\Http\Request;

class PromotionGroupController extends Controller
{
    public function __construct(private PromotionGroupService $promotionGroupService)
    {
    }

    public function getBySlug(Request $request, $slug) {
        $this->validate($request, [
            'city_id' => 'required|exists:cities,id'
        ]);
        $group = $this->promotionGroupService->getBySlug($slug, $request->city_id);

        return new PromotionGroupResource($group);
    }
}
