<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Review\StoreProductReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Product;
use App\Services\Review\ProductReviewService;

class ProductReviewController extends Controller
{
    public function __construct(private ProductReviewService $productReviewService) {
        $this->middleware('auth')->only(['store']);
    }

    public function store(StoreProductReviewRequest $request, Product $product) {
        return new ReviewResource($this->productReviewService->create($request->user(), $product, $request->validated()));
    }

    public function index(Product $product) {
        return ReviewResource::collection($this->productReviewService->list($product));
    }
}
