<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'token_id'  => $this->token_id,
            'subject'   => $this->fields_json->subject ?? $this->pushable->subject,
            'text'      => $this->fields_json->text ?? $this->pushable->text,
            'image'     => $this->pushable->fullImgSrc ?? null
        ];
    }
}
