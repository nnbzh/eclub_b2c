<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            MarketSeeder::class,
            MenuItemsSeeder::class,
            RatingSeeder::class,
            PromotionGroupSeeder::class,
            SubscriptionSeeder::class,
            NotificationTypeSeeder::class,
            NotificationSeeder::class,
        ]);
    }
}
