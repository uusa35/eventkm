<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'name' => $this->name,
            'slug_ar' => $this->slug,
            'caption_ar' => $this->caption,
            'is_admin' => $this->is_admin,
            'is_super' => $this->is_super,
            'is_client' => $this->is_client,
            'is_company' => $this->is_company,
            'is_designer' => $this->is_designer,
            'is_celebrity' => $this->is_celebrity,
            'is_visible' => $this->is_visible,
            'active' => $this->active,
            'order' => $this->order,
            'color' => $this->color,
        ];
    }
}
