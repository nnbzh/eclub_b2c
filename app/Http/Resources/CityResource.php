<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'slug'  => $this->slug,
            'lat'   => $this->lat,
            'lng'   => $this->lng,
            'code'  => $this->code,
            'number' => $this->number,
            'is_active' => $this->is_active,
            'has_delivery' => $this->has_delivery,
        ];
    }
}
