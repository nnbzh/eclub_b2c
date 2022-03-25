<?php

namespace App\Jobs\Tarantool\Price;

use App\Services\Price\PriceService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdatePriceByCityIdJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private int $cityId) {}

    public function handle() {
        app()->make(PriceService::class)->updatePricesByCityId($this->cityId);
    }
}
