<?php

namespace App\Repositories\Api;

use Illuminate\Support\Facades\Http;

class ElogistRepository
{
    private $host;
    private $token;

    public function __construct()
    {
        $this->host = config('services.api.elogist.host');
        $this->token = config('services.api.elogist.apiKey');
    }

    public function getDelayedSlotsByCityId($cityId, $date) {
        return Http::withHeaders(['Authorization' => "Bearer $this->token"])
            ->baseUrl($this->host)
            ->get("orders/load", ['city_id' => $cityId, 'slot_date' => $date])
            ->json();
    }
}
