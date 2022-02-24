<?php

namespace App\Console\Commands\Parsers;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class SeedMarketsCommand extends Command
{
    protected $signature = 'seed:markets';
    protected $description = 'Seed markets table';

    public function handle() {
        try {
            Artisan::call('db:seed --class=MarketSeeder');
            $this->info('Successfully seeded markets');
            Log::info('Successfully seeded markets');
        } catch (\Exception $e) {
            $this->error('Failed while seeding markets');
            Log::error('Failed while seeding markets', [
                'Message'   => $e->getMessage(),
                'File'      => $e->getFile(),
                'Line'      => $e->getLine(),
            ]);
        }

    }
}
