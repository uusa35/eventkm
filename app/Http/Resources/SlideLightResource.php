<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SlideLightResource extends JsonResource
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
            'title' => $this->title,
            'caption' => $this->caption,
            'order' => $this->order,
            'large' => $this->imageLargeLink,
            'path' => $this->path ? $this->pathLink : null,
            'url' => $this->url ? $this->url : env('APP_URL'),
            'module' => $this->module,
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'category_id' => $this->category_id,
            'service_id' => $this->service_id,
        ];
    }
}
