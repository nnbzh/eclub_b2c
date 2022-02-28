<?php

namespace App\Console\Commands\Parsers;

use App\Jobs\Tarantool\Stock\UpdateStockJob;
use Illuminate\Console\Command;

class UpdateStocksCommand extends Command
{
    protected $signature = 'update:stocks';

    public function handle() {
        dispatch(new UpdateStockJob())->onConnection('redis');
    }
}
