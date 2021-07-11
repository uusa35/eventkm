<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Support\Str;

class CategoryGroupExtraLightResource extends JsonResource
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
            'name' => ucfirst(Str::limit($this->name,20)),
            'icon' => $this->icon,
            'thumb' => $this->image ? $this->imageThumbLink : null,
            'is_multi' => $this->is_multi,
            'properties' => PropertyExtraLightResource::collection($this->whenLoaded('properties'))
        ];
    }
}
