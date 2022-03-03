<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RatingMessageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'message'   => $this->message,
            'image'     => $this->fullImgSrc,
        ];
    }
}
