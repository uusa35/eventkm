<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoLightResource extends JsonResource
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
            'url' => $this->url,
            'thumb' => $this->imageThumbLink,
            'large' => $this->imageLargeLink,
            'video_id' => $this->video_id,
        ];
    }
}
