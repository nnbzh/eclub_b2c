<?php

namespace Database\Seeders;

use App\Models\PromotionGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromotionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $promotionGroups = [
            [
                'name'  => 'Новинки',
                'slug'  => 'new',
            ],
            [
                'name'  => 'Популярные товары',
                'slug'  => 'popular',
            ],
            [
                'name'  => 'Очень выгодно',
                'slug'  => 'profitable',
            ],
            [
                'name'  => 'Вас может заинтересовать',
                'slug'  => 'interesting',
            ],
            [
                'name'  => 'Повседневный спрос',
                'slug'  => 'daily',
            ],
        ];

        foreach ($promotionGroups as $group) {
            PromotionGroup::query()->updateOrCreate(
                ['slug' => $group['slug']], $group
            );
        }
    }
}
