<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Support\Str;

class ProductCartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sku' => $this->sku,
            'name' => Str::limit($this->name,30,''),
            'on_new' => $this->on_new,
            'finalPrice' => $this->finalPrice,
            'convertedFinalPrice' => $this->convertedFinalPrice,
            'weight' => $this->weight,
            'description' => $this->description,
            'thumb' => $this->imageThumbLink,
            'large' => $this->imageLargeLink,
            'has_attributes' => $this->hasRealAttributes,
            'qty' => (Int) request()->qty,
            'user' => new UserLightResource($this->whenLoaded('user')),
            'product_attributes' => ProductAttributeLightResource::collection($this->whenLoaded('product_attributes')),
            'color' => new ColorLightResource($this->whenLoaded('color')),
            'size' => new SizeLightResource($this->whenLoaded('size')),
            'brands' => BrandLightResource::collection($this->whenLoaded('brands')),
        ];
    }
}
