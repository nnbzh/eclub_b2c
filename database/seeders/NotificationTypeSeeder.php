<?php

namespace Database\Seeders;

use App\Models\NotificationType;
use Illuminate\Database\Seeder;

class NotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'slug' => 'sale',
                'name' => 'Акции'
            ],
            [
                'slug' => 'subscription',
                'name' => 'Подписка E-Club'
            ],
            [
                'slug' => 'app',
                'name' => 'Уведомления от E-Club'
            ],
        ];

        foreach($types as $type) {
            NotificationType::query()->updateOrCreate(['slug' => $type['slug']], $type);
        }
    }
}
