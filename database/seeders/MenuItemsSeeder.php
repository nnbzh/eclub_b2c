<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => 'Подписка',],
            ['name' => 'Мои заказы',],
            ['name' => 'Аптеки',],
            ['name' => 'Мои адреса',],
            ['name' => 'Поддержка',],
            ['name' => 'Акции',],
            ['name' => 'Напоминания',],
            ['name' => 'Пригласить друга',],
        ];

        foreach ($items as $item) {
            MenuItem::query()->updateOrCreate($item);
        }
    }
}
