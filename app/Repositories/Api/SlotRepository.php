<?php

namespace App\Repositories\Api;

use Illuminate\Support\Facades\Http;

class SlotRepository
{
    private $token;
    private $host;

    public function __construct()
    {
        $this->host = config('services.api.slot.host');
        $this->token = config('services.api.slot.apiKey');
    }

    public function getTodaySlotsByCityId($cityId) {
        return Http::withHeaders(['Authorization' => "Bearer $this->token"])
            ->baseUrl($this->host)
            ->get("today/$cityId")
            ->json();
    }

    public function getTomorrowSlotsByCityId($cityId) {
        return Http::withHeaders(['Authorization' => "Bearer $this->token"])
            ->baseUrl($this->host)
            ->get("next-day/$cityId")
            ->json();
    }
}
