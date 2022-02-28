<?php

namespace App\Console\Commands\Parsers;

use App\Jobs\Tarantool\Price\UpdatePriceJob;
use Illuminate\Console\Command;

class UpdatePricesCommand extends Command
{
    protected $signature = 'update:prices';

    public function handle() {
        dispatch(new UpdatePriceJob())->onConnection('redis');
    }
}
