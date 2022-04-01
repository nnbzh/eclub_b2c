<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Review\StoreProductReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Product;
use App\Services\Review\ReviewService;

class ProductReviewController extends Controller
{
    public function __construct(private ReviewService $reviewService) {
        $this->middleware('auth')->only(['store']);
    }

    public function store(StoreProductReviewRequest $request, Product $product) {
        return new ReviewResource($this->reviewService->create($request->user(), $product, $request->validated()));
    }

    public function index(Product $product) {
        return ReviewResource::collection($this->reviewService->list($product));
    }
}
