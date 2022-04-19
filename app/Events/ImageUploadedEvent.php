<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;

class ImageUploadedEvent
{
    use Dispatchable;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public $model, public $image, public $isSecond = false, public $locale = 'ru')
    {
        //
    }
}
