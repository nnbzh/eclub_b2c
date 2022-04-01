<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Review\StoreOrderReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Order;
use App\Services\Review\ReviewService;

class OrderReviewController extends Controller
{
    public function __construct(private ReviewService $reviewService)
    {
    }

    public function store(StoreOrderReviewRequest $request, Order $order)
    {
        $user   = $request->user();
        $review = $this->reviewService->create($user, $order, $request->validated());

        return new ReviewResource($review);
    }
}
