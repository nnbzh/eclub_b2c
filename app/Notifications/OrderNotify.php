<?php

namespace App\Notifications;

use App\Models\Notification as NotificationModel;
use App\Models\User;
use App\Services\Push\Channels\ExpoChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderNotify extends Notification
{
    use Queueable;

    protected $message;
    protected $orderId;
    protected $notification;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message, $orderId = null)
    {
        $this->message = $message;
        $this->orderId = $orderId;
        $this->notification = NotificationModel::where('key', 'send_push_order')->first();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if (! $this->notification) {
            return [];
        }

        if ($notifiable->isPushEnabled()) {
            return [ExpoChannel::class];
        }
//        if ($notifiable->isSmsEnabled && $this->notification->send_sms) {
//            return [SmsChannel::class];
//        }

        return [];
    }

    public function toPush(User $notifiable = null) {
        return $this->notification->toPush($notifiable, [
            'order_id'  => $this->orderId,
            'text'      => $this->message
        ]);
    }
}
