<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderLightResource extends JsonResource
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
            'net_price' => $this->net_price,
            'status' => trans('general.'.$this->status),
            'success' => $this->status === 'success',
            'received' => $this->status === 'received',
            'under_progress' => $this->status === 'under_progress',
            'delivered' => $this->status === 'delivered',
            'shipped' => $this->status === 'shipped',
            'completed' => $this->status === 'completed',
            'date' => $this->created_at->format('d/m/Y'),
            'shipment_reference' => $this->shipment_reference ? $this->shipment_reference : null,
            'order_metas' => OrderMetaLightResource::collection($this->order_metas)
        ];
    }
}
