<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notifications = [
            'subscription_payment' => [
                'description' => 'уведомление до 3 дней до окончания подписки',
                'subject' => 'Истекает срок действия подписки.',
                'text' => 'Следующий платеж произойдет автоматически через 3 дня.',
            ],
            'courier_start' => [
                'description' => 'когда курьер забрал заказ с аптеки',
                'subject' => 'Курьер уже спешит к вам!',
                'text' => 'Ваш заказ в пути!',
            ],
            'courier_delay' => [
                'description' => 'когда заказ задерживается',
                'subject'   => 'Ваш заказ задерживается, приносим извинения, курьер спешит!',
                'text'      => 'Ваш заказ задерживается, приносим извинения, курьер спешит!',
            ],
            'courier_finish' => [
                'description' => 'когда заказ прибыл',
                'subject' => 'Ваш заказ прибыл.',
                'text' => 'Не забывайте о собственной безопасности!'
            ],
            'confirm_order' => [
                'description' => 'когда пользователь подтверждает свою личность',
                'subject' => 'Код подтверждения заказа',
                'text' => 'Ваш код: {code}',
            ],
            'emergency_message' => [
                'description' => 'уведомление пользователям о экстренной случае',
                'subject' => 'Техническая поддержка',
                'text' => 'Онлайн оплата временно не доступна, ведутся технические работы, приносим свои извинения',
            ],
            'new_stories' => [
                'description' => 'отправляется при созданий Истории и статусе Опубликован',
                'subject' => 'Новые сторис',
                'text' => 'Будь в курсе “Что нового в приложении”.',
            ],
            'processing_order' => [
                'description' => 'Заказ в процессе',
                'subject' => 'Заказ принят',
                'text' => 'Мы собираем ваш заказ и скоро передадим курьеру',
            ],
            'send_push_order' => [
                'description' => 'Пуш уведомление от операторов',
                'subject' => 'Europharma',
                'text' => '{message}',
            ],
        ];

        foreach($notifications as $key => $notification) {
            Notification::query()->firstOrCreate([
                'key' => $key,
            ], $notification);
        }
    }
}
