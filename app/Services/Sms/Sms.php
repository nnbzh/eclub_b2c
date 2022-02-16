<?php

namespace App\Services\Sms;

use App\Services\Sms\Facades\Sms as SmsFacade;
use App\Services\Sms\Jobs\SendSmsJob;

class Sms
{
    protected $attributes = [];

    public function __construct($receiver = null, $message = null)
    {
        $this->attributes['receiver']   = $receiver;
        $this->attributes['message']    = $message;
    }

    public function to(string $to): self
    {
        $this->attributes['to'] = $to;

        return $this;
    }

    public function text(string $text): self
    {
        $this->attributes['text'] = $text;

        return $this;
    }

    public function send()
    {
        match (config('services.sms.connection', 'sync')) {
            'queue' => SendSmsJob::dispatch($this)->onQueue('notification'),
            'sync'  => SmsFacade::send($this)
        };
    }

    public function toArray(): array
    {
        return $this->attributes;
    }

    public function __get($argument)
    {
        return $this->attributes[$argument] ?? null;
    }
}
