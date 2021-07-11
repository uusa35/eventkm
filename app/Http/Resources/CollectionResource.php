<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CollectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'thumb' => $this->imageThumbLink,
            'large' => $this->imageLargeLink,
            'products' => ProductExtraLightResource::collection($this->whenLoaded('products')),
            'user' => UserExtraLightResource::make($this->whenLoaded('user')),
        ];
    }
}
