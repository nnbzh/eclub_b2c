<?php

namespace App\Jobs\Tarantool\Stock;

use App\Services\Stock\StockService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateStockByCityIdJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private int $cityId) {}

    public function handle() {
        app()->make(StockService::class)->updateStocksByCityId($this->cityId);
    }
}
