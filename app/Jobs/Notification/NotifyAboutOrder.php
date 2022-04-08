<?php

namespace App\Jobs\Notification;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Order;
use App\Models\Notification as EloquentNotification;

class NotifyAboutOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;
    protected $key;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order, $key)
    {
        $this->order = $order;
        $this->key = $key;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::findOrFail($this->order->user_id);
        $push = EloquentNotification::findByKey($this->key);

        if ($user->isPushEnabled()) {
            $push->toPush($user)->send();
        }
    }
}
