<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AppClearCommand extends Command
{
    protected $signature = 'app:clear';

    public function handle() {
        Artisan::call('optimize');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
    }
}
