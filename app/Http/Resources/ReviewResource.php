<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'comment'   => $this->comment,
            'rating'    => $this->rating->rating,
            'messages'  => RatingMessageResource::collection($this->whenLoaded('messages'))
        ];
    }
}
