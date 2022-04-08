<?php

namespace App\Observers;

use App\Helpers\OrderStatus;
use App\Jobs\Notification\NotifyAboutOrder;
use App\Models\Order;

class OrderObserver
{
    public function updated(Order $order) {
        if ($order->status != $order->getOriginal('order_status') && $order->delivery_method_id == 1) {
            if (in_array($order->status, [OrderStatus::PROCESSING, OrderStatus::COURIER_TAKE, OrderStatus::COURIER_DELIVERED])) {
                $notification_key = $order->status == OrderStatus::PROCESSING
                    ? 'processing_order'
                    : ($order->status == OrderStatus::COURIER_TAKE
                        ? 'courier_start'
                        : ($order->status == OrderStatus::COURIER_DELIVERED
                            ? 'courier_finish'
                            : null));
                NotifyAboutOrder::dispatch($order, $notification_key)->onQueue('notification');
            }
        }
    }
}
