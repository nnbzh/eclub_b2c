<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'address'   => $this->address,
            'entrance'  => $this->entrance,
            'floor'     => $this->floor,
            'apartment' => $this->apartment,
            'lat'       => $this->lat,
            'lng'       => $this->lng,
            'is_active' => $this->is_active,
        ];
    }
}
