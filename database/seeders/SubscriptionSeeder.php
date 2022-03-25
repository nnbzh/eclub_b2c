<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subscriptions = [
            [
                'name'  => 'Месячный',
                'slug'  => 'monthly',
                'price' => 9999,
            ],
            [
                'name'  => 'Годовой',
                'slug'  => 'yearly',
                'price' => 999,
            ]
        ];

        foreach ($subscriptions as $subscription) {
            Subscription::query()->updateOrCreate(['slug' => $subscription['slug']], $subscription);
        }
    }
}
