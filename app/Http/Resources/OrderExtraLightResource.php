<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderExtraLightResource extends JsonResource
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
            'name' => trans('general.invoice_no'). ' ' .$this->id. ' '. trans('general.on_date'). ' '. $this->created_at->format('d/m/Y')
        ];
    }
}
