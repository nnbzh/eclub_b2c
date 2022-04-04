<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PharmacyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'number'    => $this->number,
            'name'      => $this->name,
            'address'   => $this->address,
            'lat'       => $this->lat,
            'lng'       => $this->lng,
            'ratio'     => $this->when(! empty($this->ratio), $this->ratio),
            'distance'  => $this->when(! empty($this->distance), round($this->distance, 1).' км'),
            'products'  => $this->when(! empty($this->products), ProductResource::collection($this->products)),
        ];
    }
}
