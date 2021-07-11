<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Support\Str;

class ProductLightResource extends JsonResource
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
            'name' => ucfirst(Str::limit($this->name,30,'')),
            'on_new' => $this->on_new,
            'exclusive' => $this->exclusive,
            'isOnSale' => $this->isOnSale,
            'finalPrice' => $this->finalPrice,
            'finalPrice' => $this->finalPrice,
            'convertedFinalPrice' => $this->convertedFinalPrice,
            'description' => $this->description,
            'thumb' => $this->getCurrentImageAttribute(),
            'isReallyHot' => $this->isReallyHot,
            'has_attributes' => $this->hasRealAttributes,
            'qty' => (Int) $this->totalAvailableQty,
            'hasStock' => $this->hasStock,
            'user' => new UserLightResource($this->whenLoaded('user')),
            'product_attributes' => ProductAttributeLightResource::collection($this->whenLoaded('product_attributes')),
            'shipment_package' => ShipmentPackageLightResource::collection($this->whenLoaded('shipment_package')),
            'colors' => ColorLightResource::collection($this->whenLoaded('colors')),
            'color' => new ColorLightResource($this->whenLoaded('color')),
            'size' => new SizeLightResource($this->whenLoaded('size')),
            'sizes' => SizeLightResource::collection($this->whenLoaded('sizes')),
            'categories' => CategoryExtraLightResource::collection($this->whenLoaded('categories')),
            'brand' => BrandLightResource::collection($this->whenLoaded('brand')),
            'images' => ImageLightResource::collection($this->whenLoaded('images')),
            'slides' => SlideLightResource::collection($this->whenLoaded('slides')),
            'tags' => TagLightResource::collection($this->whenLoaded('tags')),
            'collections' => CollectionLightResource::collection($this->whenLoaded('collections')),

        ];
    }
}
