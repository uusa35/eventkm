<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Support\Str;

class UserExtraLightResource extends JsonResource
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
            'slug' => ucfirst(Str::limit($this->slug ? $this->slug : $this->name, 30, '')),
            'slug_ar' => ucfirst(Str::limit($this->slug_ar ? $this->slug_ar : $this->name_ar, 30, '')),
            'slug_en' => ucfirst(Str::limit($this->slug_en ? $this->slug_en : $this->name_en, 30, '')),
            'description' => $this->description ? ucfirst(Str::limit($this->description, 80, '')) : ucfirst(Str::limit($this->service, 80, '')),
            'description_ar' => $this->description_ar ? ucfirst(Str::limit($this->description_ar, 80, '')) : ucfirst(Str::limit($this->service_ar, 80, '')),
            'description_en' => $this->description_en ? ucfirst(Str::limit($this->description_en, 80, '')) : ucfirst(Str::limit($this->service_en, 80, '')),
            'thumb' => $this->getCurrentImageAttribute('image'),
            'fullMobile' => $this->fullMobile,
            'whatsapp' => $this->fullWhatsapp,
            'rating' => $this->rating,
            'has_map' => ($this->longitude && $this->latitude),
            'longitude' => (float)$this->longitude,
            'latitude' => (float)$this->latitude,
            'CustomeDelivery' => $this->customeDeliveryUser,
            'CustomeDeliveryFees' => $this->custome_delivery_fees,
            'branches' => new BranchLightResource($this->whenLoaded('branches')),
            'localArea' => AreaLightResource::make($this->whenLoaded('localArea')),
        ];
    }
}
