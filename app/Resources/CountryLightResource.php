<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryLightResource extends JsonResource
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
            'slug' => $this->slug,
            'calling_code' => $this->calling_code,
            'country_code' => $this->country_code,
            'thumb' => $this->imageThumbLink,
            'currency_symbol' => $this->currency_symbol,
            'fixed_shipment_charge' => (float) $this->fixed_shipment_charge,
            'is_local' => $this->is_local,
            'currency' => CurrencyLightResource::make($this->whenLoaded('currency')),
            'areas' => AreaLightResource::collection($this->whenLoaded('areas'))
        ];
    }
}
