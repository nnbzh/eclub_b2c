<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'sku'       => $this->sku,
            'barcode'   => $this->barcode,
            'name'      => $this->name,
            'by_recipe' => $this->by_recipe,
            'country'   => $this->country,
            'quantity'  => $this->quantity,
            'prices'    => $this->prices,
            'images'    => ImageResource::collection($this->images),
            'description' => new ProductDescriptionResource($this->whenLoaded('description')),
        ];
    }
}
