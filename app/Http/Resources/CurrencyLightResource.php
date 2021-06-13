<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyLightResource extends JsonResource
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
            'name_en' => $this->name_en,
            'currency_symbol' => $this->currency_symbol,
            'currency_symbol_en' => $this->currency_symbol_en,
            'exchange_rate' => $this->exchange_rate,
            'country' => CountryLightResource::make($this->whenLoaded('country')),
        ];
    }
}
