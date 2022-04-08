<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CancelOrderRequest;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\Order\OrderService;
use Illuminate\Http\Request;

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
        $order->load('paymentMethod', 'deliveryMethod', 'pharmacy', 'user', 'review');

        return new OrderResource($order);
    }

    public function sendPushOrder(Request $request) {
        $this->validate($request, [
            'phone'     => 'required',
            'message'   => 'required|string',
            'order_id'  => 'nullable'
        ]);
        $this->orderService->sendPushOrder($request->phone, $request->message, $request->orderId);

        return response()->json(['data' => null]);
    }

    public function callback(Request $request) {
        $this->orderService->callback($request->getContent());

        return response()->json(null, 201);
    }
}
