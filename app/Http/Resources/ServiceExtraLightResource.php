<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Support\Str;

class ServiceExtraLightResource extends JsonResource
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
            'name' => ucfirst(Str::limit($this->name,30,'')),
            'isOnSale' => $this->isOnSale,
            'exclusive' => $this->exclusive,
            'on_new' => $this->on_new,
            'price' => (float)round($this->price, 2),
            'finalPrice' => (float)round($this->finalPrice, 2),
            'convertedFinalPrice' => $this->convertedFinalPrice,
            'sale_price' => $this->sale_price,
            'thumb' => $this->imageThumbLink,
            'is_available' => $this->is_available,
            'is_hot_deal' => $this->is_hot_deal
        ];
    }
}
