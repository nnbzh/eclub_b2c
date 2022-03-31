<?php

namespace App\Repositories\Api;

class EclubRepository extends ApiRepository
{
    protected string $key = 'eclub';

    public function getDeliveryZones() {
        return $this->client->get('api/eclub/delivery-zones')->json();
    }

    public function getFastDeliveryZones() {
        return $this->client->get('api/eclub/fast-delivery-zones')->json();
    }
}
