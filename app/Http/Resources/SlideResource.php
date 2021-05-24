<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SlideResource extends JsonResource
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
            'title' => $this->title,
            'caption' => $this->caption,
            'order' => $this->order,
            'image' => $this->image,
            'path' => $this->pathLink,
            'url' => $this->url,
            'slidable' => $this->slidable,
            'module' => $this->module,
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'category_id' => $this->category_id,
            'service_id' => $this->service_id,
        ];
    }
}
