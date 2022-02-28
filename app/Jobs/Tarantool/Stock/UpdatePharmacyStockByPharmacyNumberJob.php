<?php

namespace App\Jobs\Tarantool\Stock;

use App\Services\Stock\StockService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdatePharmacyStockByPharmacyNumberJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private int $pharmacyNumber) {}

    public function handle() {
        app()->make(StockService::class)->updateStocksByPharmacyNumber($this->pharmacyNumber);
    }
}
