<?php

namespace App\Console\Commands\Parsers;

use App\Jobs\Tarantool\Stock\UpdatePharmacyStockJob;
use Illuminate\Console\Command;

class UpdatePharmacyStocksCommand extends Command
{
    protected $signature = 'update:pharmacy-stocks';

    public function handle() {
        dispatch(new UpdatePharmacyStockJob())->onConnection('redis');
    }
}
