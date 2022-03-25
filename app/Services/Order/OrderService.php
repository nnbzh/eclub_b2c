<?php

namespace App\Services\Order;

use App\Models\Privilege;
use App\Models\User;
use App\Repositories\Api\EuropharmaRepository;
use App\Repositories\OrderRepository;

class OrderService
{
    public function __construct(
        private OrderRepository $orderRepository,
        private EuropharmaRepository $europharmaRepository,
    )
    {
    }

    public function create(User $user, array $data) {
        if ($user->hasPrivilege(Privilege::FREE_DELIVERY)) {
            $hasFreeDelivery = true;
        } else {
            $hasFreeDelivery = false;
        }

        $order = $this->orderRepository->create($data);
        dd($order);
        $order->products()->sync($data['products']);

        return $order;
    }
}
