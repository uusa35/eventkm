<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use \Illuminate\Support\Str;

class ProductExtraLightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sku' => $this->sku,
            'name' => ucfirst(str_limit($this->name,30,'')),
            'on_new' => $this->on_new,
            'exclusive' => $this->exclusive,
            'isOnSale' => $this->isOnSale,
            'finalPrice' => $this->finalPrice,
            'convertedFinalPrice' => $this->convertedFinalPrice,
            'thumb' => $this->getCurrentImageAttribute(),
            'isReallyHot' => $this->isReallyHot,
            'hasStock' => $this->hasStock,
        ];
    }
}
