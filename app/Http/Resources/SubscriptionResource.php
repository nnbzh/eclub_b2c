<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'id'    => $this->id,
            'name'  => $this->name,
        ];

        if (! empty($this->userSubscription)) {
            $data['started_at'] = $this->userSubscription->started_at->format('Y-m-d');
            $data['expires_at'] = $this->userSubscription->expires_at->format('Y-m-d');
        };

        return $data;
    }
}
