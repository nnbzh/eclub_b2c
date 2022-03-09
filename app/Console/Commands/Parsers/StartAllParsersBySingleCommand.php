<?php

namespace App\Console\Commands\Parsers;

use App\Jobs\Tarantool\Price\UpdatePriceJob;
use App\Jobs\Tarantool\Stock\UpdatePharmacyStockJob;
use App\Jobs\Tarantool\Stock\UpdateStockJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Bus;

class StartAllParsersBySingleCommand extends Command
{
    protected $signature = 'parsers:start';

    public function handle() {
        Bus::chain([
            Artisan::queue('parse:store'),
            Artisan::queue('db:seed'),
            Artisan::queue('parse:cities'),
            Artisan::queue('parse:categories'),
            Artisan::queue('parse:brands'),
            Artisan::queue('parse:products'),
            Artisan::queue('parse:pharmacies'),
            Artisan::queue('parse:delivery-methods'),
            Artisan::queue('update:stocks'),
            Artisan::queue('update:pharmacy-stocks'),
            Artisan::queue('update:prices'),
        ])
            ->onConnection('redis');
    }
}
