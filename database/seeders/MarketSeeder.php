<?php

namespace Database\Seeders;

use App\Models\Market;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $markets = [
            [
                'name'      => 'Europharma',
                'number'    => 1,
            ],
            [
                'name'      => 'Emart',
                'number'    => 2
            ],
            [
                'name'      => 'Arzan Mart',
                'number'    => 4,
            ],
            [
                'name'      => 'Darkstore',
                'number'    => 6
            ]
        ];

        foreach ($markets as $market) {
            Market::query()->updateOrCreate(['number' => $market['number']], $market);
        }
    }
}
