<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostLightResource extends JsonResource
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
            'thumb' => $this->getCurrentImageAttribute(),
            'large' => $this->getCurrentImageAttribute('image', 'large'),
            'title' => $this->title,
            'slug' => $this-> slug,
            'keywords' => $this->keywords,
            'video_url' => $this->video_url,
            'user' => new UserExtraLightResource($this->whenLoaded('user')),
            'comments' => CommentExtraLightResource::collection($this->whenLoaded('comments')),
        ];
    }
}
