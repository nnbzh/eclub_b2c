<?php

namespace App\Repositories\Api;

class EuropharmaRepository extends ApiRepository
{
    protected $key = 'europharma';

    public function calculateDeliveryCost($cityId, $lat, $lng, $positions, $ownerId = null)
    {
        return $this->client->post('app/delivery-amount', [
            'lat'       => $lat,
            'lng'       => $lng,
            'positions' => $positions,
            'city_id'   => $cityId,
            'owner_id'  => $ownerId
        ])->json();
    }

    public function sendOrderToCrm($data) {
        return $this->client->post('app/orders/create', $data)->json();
    }

    public function cancelOrder($orderNumber, $reason) {
        return $this->client->post("app/orders/$orderNumber/cancel", ['type' => $reason])->json();
    }
}
