<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Support\Str;

class ClassifiedLightResource extends JsonResource
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
            'name' => ucfirst(Str::limit($this->name,30,'')),
            'price' => $this->price,
            'thumb' => $this->imageThumbLink,
            'is_featured' => $this->is_featured,
            'created_at' => $this->created_at->diffForHumans(),
            'views' => (integer) $this->views,
            'address' => $this->address,
            'longitude' => (float)$this->longitude,
            'latitude' => (float)$this->latitude,
            'has_map' => ($this->longitude && $this->latitude),
            'items' => ClassifiedItemLightResource::collection($this->whenLoaded('items'))

        ];
    }
}
