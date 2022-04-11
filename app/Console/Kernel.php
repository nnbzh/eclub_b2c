<?php

namespace App\Console;

use App\Jobs\Tarantool\Price\UpdatePriceJob;
use App\Jobs\Tarantool\Stock\UpdatePharmacyStockJob;
use App\Jobs\Tarantool\Stock\UpdateStockJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('parse:store')->dailyAt('06:30');
        $schedule->command('parse:cities')->dailyAt('06:30');
        $schedule->command('parse:categories')->dailyAt('06:30');
        $schedule->command('parse:products')->dailyAt('06:30');
        $schedule->command('parse:pharmacies')->dailyAt('06:30');
        $schedule->command('horizon:snapshot')->everyFiveMinutes();
        $schedule->job(new UpdateStockJob)->everyThreeMinutes();
        $schedule->job(new UpdatePriceJob)->everyTenMinutes();
        $schedule->job(new UpdatePharmacyStockJob)->everyTenMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
