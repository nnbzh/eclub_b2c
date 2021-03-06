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
            'rating'    => $this->averageRating,
            'unit'      => $this->unit_code,
            'quantity'  => $this->quantity ?? $this->pivot?->quantity,
            'category'  => new CategoryResource($this->category),
            'prices'    => $this->prices,
            'purchase_price' => $this->pivot->price ?? null,
            'images'    => ImageResource::collection($this->images),
            'description' => new ProductDescriptionResource($this->whenLoaded('description')),
        ];
    }
}
