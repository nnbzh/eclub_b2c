<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductDescriptionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
          'id'          => $this->id,
          'description' => $this->description,
          'product_id'  => $this->product_id
        ];
    }
}
