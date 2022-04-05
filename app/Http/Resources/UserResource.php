<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'phone_verified_at' => $this->phone_verified_at,
            'email_verified_at' => $this->email_verified_at,
            'gender' => $this->gender,
            'birthdate' => $this->birthdate,
            'lang' => $this->lang,
            'send_mail' => $this->send_mail,
            'send_notification' => $this->send_notification,
            'image' => $this->fullImgSrc,
            'subscription' => new SubscriptionResource($this->lastActiveSubscription())
        ];
    }
}
