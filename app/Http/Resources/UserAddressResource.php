<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'address'   => $this->address,
            'block'     => $this->block,
            'floor'     => $this->floor,
            'apartment' => $this->apartment,
            'lat'       => $this->lat,
            'lng'       => $this->lng,
            'is_active' => $this->is_active,
        ];
    }
}
