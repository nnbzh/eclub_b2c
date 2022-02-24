<?php

namespace App\Console\Commands\Parsers;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Bus;

class StartAllParsersBySingleCommand extends Command
{
    protected $signature = 'parsers:start';

    public function handle() {
        Bus::chain([
            Artisan::queue('parse:store'),
            Artisan::queue('seed:markets'),
            Artisan::queue('parse:cities'),
            Artisan::queue('parse:categories'),
            Artisan::queue('parse:brands'),
            Artisan::queue('parse:products'),
        ])
            ->onConnection('redis');
    }
}
