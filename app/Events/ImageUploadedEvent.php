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
    public function __construct(
        public $binary,
        public $data,
        public $operation,
    )
    {

    }
}
