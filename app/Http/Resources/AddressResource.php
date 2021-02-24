<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'content' => $this->content,
            'area' => $this->area,
            'block' => $this->block,
            'street' => $this->street,
            'building' => $this->building,
            'floor' => $this->floor,
            'apartment' => $this->apartment,
            'country_name' => $this->country_name,
            'area_id' => $this->area_id,
            'governate_id' => $this->governate_id,
            'country_id' => $this->country_id

        ];
    }
}
