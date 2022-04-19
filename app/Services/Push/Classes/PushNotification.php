<?php

namespace App\Services\Push\Classes;

use App\Helpers\NotificationStatus;
use App\Services\Push\Jobs\SendPushNotificationJob;

class PushNotification
{
    private $pushable;
    private mixed $receiver;
    private array $push;
    private $text;

    public function __construct($pushable, $notifiable = null, $data = [])
    {
        $this->pushable = $pushable;
        $this->receiver = $notifiable;
        $this->text     = $data['text'] ?? null;
        $this->push     = $this->prepare($data);
    }

    private function prepare($data) {
        return [
            'subject'   => $this->pushable->subject ?? 'Eclub',
            'text'      => $data['text'] ?? $this->pushable->text,
            'order_id'  => $data['order_id'] ?? null,
            'extra' => [
                'badge' => $this->receiver?->unreadSentPushNotifications()->count(),
                'type'  => $this->pushable?->notifcationType->slug ?? null,
                'image' => $this->pushable?->firstImgSrc
            ]
        ];
    }

    public function send() {
        match (config('services.push.connection')) {
            'sync'  => \Push::notify($this),
            'queue' => SendPushNotificationJob::dispatch($this)->onQueue('notification'),
        };
    }

    public function getReceiver() {
        return $this->receiver;
    }

    public function __get($attribute)
    {
        return $this->push[$attribute] ?? null;
    }

    public function handleResponse($response)
    {
        $status = $response['data'][0]['status'] ?? null;
        if ($status && $status === 'ok') {
            $status = NotificationStatus::UNREAD;
        } else {
            $status = NotificationStatus::FAILED;
        }

        $data = [
            'status'        => $status,
            'user_id'       => $this->receiver->id,
            'fields_json'   => $response['data'][0] ?? [],
            'notification_type_id' => $this->pushable->notifcationType?->id
        ];

        if ($this->text) {
            $data['fields_json']['text'] = $this->text;
        }

        if ($status == NotificationStatus::UNREAD) {
            $data['token_id'] = $response['data'][0]['id'];
        }

        return $this->pushable->sentPushNotifications()->create($data);
    }
}
