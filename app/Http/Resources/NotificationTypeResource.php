<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationTypeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'slug'  => $this->slug,
            'unread_count'  => $this->sent_push_notifications_count ?? null,
            'image' => $this->firstImgSrc
        ];
    }
}
