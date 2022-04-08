<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    public function findByNumber($value) {
        return Order::whereNumber($value)->first();
    }

    public function create(array $data) : Order {
        return Order::query()->create($data);
    }

    public function update(Order $order, $data) : Order {
        $order->fill($data);
        $order->saveOrFail();

        return $order;
    }
}
