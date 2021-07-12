<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Types\Integer;
use \Illuminate\Support\Str;

class CategoryLightResource extends JsonResource
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
            'isParent' => $this->isParent,
            'name' => ucfirst(Str::limit($this->name, 20, '..')),
            'name_ar' => ucfirst(Str::limit($this->name_ar, 20, '..')),
            'name_en' => ucfirst(Str::limit($this->name_en, 20, '..')),
            'thumb' => $this->getCurrentImageAttribute('image'),
            'large' => $this->getCurrentImageAttribute('image'),
            'path' => asset(env('FILES').$this->path),
//            'min' => $this->min ? (int) number_format($this->min,0) : 50,
            'min' => $this->min ? (int) $this->min : 50,
            'max' => $this->max ? (int) $this->max : 10000,
            'is_real_estate' => $this->is_real_estate,
            'is_user' => $this->is_user,
            'is_product' => $this->is_product,
            'is_classified' => $this->is_classified,
            'is_service' => $this->is_service,
            'is_featured' => $this->is_featured,
            'has_children' => $this->children->where('active', true)->count() > 0,
            'has_categoryGroups' => $this->categoryGroups->where('active', true)->count() > 0,
            'steps' => $this->categoryGroups->count(),
            'children' => CategoryChildLightResource::collection($this->whenLoaded('children')),
            'categoryGroups' => CategoryGroupExtraLightResource::collection($this->whenLoaded('categoryGroups')),
            'tags' => TagExtraLightResource::collection($this->whenLoaded('tags')),
        ];
    }
}
