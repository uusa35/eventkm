<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentPackageLightResource extends JsonResource
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
            'image' => $this->imageLargeLink,
            'slug_ar' => $this->slug,
            'charge' => (float) $this->charge,
            'is_available' => $this->is_available,
            'notes_ar' => $this->notes,
        ];
    }
}
