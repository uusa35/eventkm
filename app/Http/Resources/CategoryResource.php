<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Support\Str;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
//        return [
//            'id' => $this->id,
//            'name' => ucfirst(Str::limit($this->name,20,'..')),
//            'is_featured' => $this->is_featured,
//            'thumb' =>$this->getCurrentImageAttribute('image'),
//            'large' =>$this->getCurrentImageAttribute('image'),
//            'has_children' => $this->children->count() > 0,
//            'children' => CategoryLightResource::collection($this->whenLoaded('children')),
//        ];
    }
}
