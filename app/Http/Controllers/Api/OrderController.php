<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CancelOrderRequest;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\Order\OrderService;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService)
    {
    }

    public function store(StoreOrderRequest $request) {
        $data   = $request->validated();
        $user   = $request->user();
        $order  = $this->orderService->create($user, $data);

        return new OrderResource($order);
    }

    public function cancel(CancelOrderRequest $request, Order $order) {
        $this->orderService->cancel($order, $request->validated());

        return response()->json(['data' => null]);
    }

    public function show(Order $order) {
        $order->load('paymentMethod', 'deliveryMethod', 'pharmacy', 'user');

        return new OrderResource($order);
    }
}
