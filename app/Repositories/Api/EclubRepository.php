<?php

namespace App\Repositories\Api;

class EclubRepository extends ApiRepository
{
    protected $key = 'eclub';

    public function getDeliveryZones() {
        return $this->client->get('api/eclub/delivery-zones')->json();
    }

    public function getFastDeliveryZones() {
        return $this->client->get('api/eclub/fast-delivery-zones')->json();
    }

    public function getCancelMessages() {
        return $this->client->get('api/eclub/cancel-messages')->json();
    }

    public function getProductImages($skus) {
        return $this->client->post('api/eclub/product-images', [
            'skus' => $skus
        ])->json();
    }

    public function compselections() {
        return $this->client->get('api/eclub/compselections')->json();
    }

    public function categories($id) {
        return $this->client->get("api/eclub/compilations/{$id}/categories")->json();
    }
}
