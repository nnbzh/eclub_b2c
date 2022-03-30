<?php

namespace App\Classes;

use App\Models\Order;
use App\Repositories\Api\EuropharmaRepository;

class CRMOrder
{
    public function __construct(private Order $order)
    {
        $this->loadRelations();
    }

    public function toArray() {
        $order = [
            'city_id'       => $this->order->address['city_id'],
            'address'       => $this->order->address['address'],
            'floor'         => $this->order->address['floor'],
            'apartment'     => $this->order->address['apartment'],
            'entrance'      => $this->order->address['entrance'],
            'lat'           => $this->order->address['lat'],
            'lng'           => $this->order->address['lng'],
            'user_id'       => $this->order->user_id,
            'cost'          => $this->order->fields_json['new_cost'],
            'channel'       => $this->order->fields_json['channel'],
            'slot_id'       => $this->order->fields_json['slot_id'] ?? null,
            'version'       => $this->order->fields_json['version'] ?? null,
            'delivery_id'   => $this->order->delivery_method_id,
            'payment_id'    => $this->order->payment_method_id,
            'pharmacy'      => $this->order->pharmacy?->number,
            'comment'       => $this->order->comment,
            'name'          => $this->order->customer_name,
            'phone'         => \StringFormatter::maskPhone($this->order->customer_phone),
            'items'         => $this->mapItems($this->order->products)->toArray(),
            'fast_delivery_pharmacy' => $this->order->fields_json['fast_delivery_pharmacy'] ?? null
        ];

        return $order;
    }

    private function loadRelations() {
        $this->order->load(
            'user',
            'paymentMethod',
            'deliveryMethod',
            'paymentMethod',
            'products',
            'pharmacy'
        );
    }

    private function mapItems($products) {
        return $products->map(function ($product) {
            $item['sku']        = $product->sku;
            $item['price']      = $product->pivot->price;
            $item['quantity']   = $product->pivot->quantity;
            $item['barcode']    = $product->barcode;
            $item['title']      = trim($product->name);

            return $item;
        });
    }

    public function sendToCrm() {
        $repo = new EuropharmaRepository();
        try {
            return $repo->sendOrderToCrm($this->toArray());
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
