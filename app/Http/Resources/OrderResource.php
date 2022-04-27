<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'number'            => $this->number,
            'customer_name'     => $this->customer_name,
            'customer_phone'    => $this->customer_phone,
            'payment_method'    => new PaymentMethodResource($this->paymentMethod),
            'delivery_method'   => new DeliveryMethodResource($this->deliveryMethod),
            'products'          => ProductResource::collection($this->products),
            'pharmacy'          => new PharmacyResource($this->pharmacy),
            'status'            => $this->status,
            'cost'              => $this->cost,
            'delivery_cost'     => $this->delivery_cost,
            'address'           => $this->address,
            'comment'           => $this->comment,
            'fields_json'       => $this->fields_json,
        ];
    }
}
