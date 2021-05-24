<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
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
            'name' => $this->name,
            'caption' => $this->caption,
            'order' => $this->order,
            'url' => $this->url,
            'video_id' => $this->video_id,
            'products' => ProductExtraLightResource::collection($this->whenLoaded('products')),
        ];
    }
}
