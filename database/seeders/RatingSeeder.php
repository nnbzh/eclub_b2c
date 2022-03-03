<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ratings = [
            ['rating' => 1],
            ['rating' => 2],
            ['rating' => 3],
            ['rating' => 4],
            ['rating' => 5],
        ];

        foreach ($ratings as $rating) {
            Rating::query()->updateOrCreate($rating);
        }
    }
}
