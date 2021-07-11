<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponLightResource extends JsonResource
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
            'code' => $this->code,
            'value' => round($this->is_percentage ?  request()->total * ($this->value / 100) : $this->value, 2),
            'is_percentage' => $this->is_percentage,
        ];
    }
}
