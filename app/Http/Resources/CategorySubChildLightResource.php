<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Support\Str;

class CategorySubChildLightResource extends JsonResource
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
            'name' => ucfirst(Str::limit($this->name,20,'..')),
            'thumb' =>$this->imageThumbLink,
            'large' =>$this->imageLargeLink,
            'is_real_estate' => $this->is_real_estate,
            'is_user' => $this->is_user,
            'is_product' => $this->is_product,
            'is_classified' => $this->is_classified,
            'is_service' => $this->is_service,
            'is_featured' => $this->is_featured,
            'has_children' => $this->children->where('active',true)->count() > 0,
            'has_categoryGroups' => $this->categoryGroups->where('active',true)->count() > 0,
            'steps' => $this->categoryGroups->count(),
            'categoryGroups' => CategoryGroupExtraLightResource::collection($this->whenLoaded('categoryGroups'))
        ];
    }
}
