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
            'slug_en' => $this->slug_en,
            'calling_code' => $this->calling_code,
            'country_code' => $this->country_code,
            'thumb' => $this->imageThumbLink,
            'currency_symbol' => $this->currency_symbol,
            'currency_symbol_en' => $this->currency_symbol_en,
            'fixed_shipment_charge' => (float) round($this->fixed_shipment_charge,2),
            'is_local' => $this->is_local,
            'currency' => CurrencyLightResource::make($this->whenLoaded('currency')),
            'areas' => AreaLightResource::collection($this->whenLoaded('areas'))
        ];
    }
}
