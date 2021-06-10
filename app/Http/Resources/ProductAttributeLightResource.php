<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductAttributeLightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cart_id' => ($this->product->hasRealAttributes ? $this->product_id : null ).$this->id,
            'product_id'=> $this->product_id,
            'qty' => $this->qty,
            'color_id' => $this->color_id,
            'size_id' => $this->size_id,
            'color' => new ColorLightResource($this->whenLoaded('color')),
            'size' => new SizeLightResource($this->whenLoaded('size')),
        ];
    }
}
