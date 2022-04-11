<?php

namespace App\Repositories\Api;

use Illuminate\Support\Facades\Http;

abstract class ApiRepository
{
    protected $client;
    protected $key;
    protected $host;
    protected $apiKey;

    public function __construct()
    {
        $this->host     = config("services.api.$this->key.host");
        $this->apiKey   = config("services.api.$this->key.apiKey");
        $this->client   = $this->buildClient();
    }

    protected function buildClient() {
        return Http::baseUrl($this->host)->withHeaders([
            'Authorization' => "Bearer $this->apiKey"
        ]);
    }
}
