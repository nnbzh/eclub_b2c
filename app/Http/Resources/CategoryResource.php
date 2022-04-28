<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'image'         => $this->firstImgSrc,
            'subcategories' => self::collection($this->whenLoaded('subcategories'))
        ];
    }
}
