<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Support\Str;

class CommentExtraLightResource extends JsonResource
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
            'title' => ucfirst(Str::limit($this->title,20,'..')),
            'content' => $this->content,
            'created_at' => $this->created_at->diffForHumans(),
            'owner' => UserExtraLightResource::make($this->whenLoaded('owner'))
        ];
    }
}
