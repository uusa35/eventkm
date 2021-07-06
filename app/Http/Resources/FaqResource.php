<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'content' => trim(filter_var(strip_tags($this->content), FILTER_SANITIZE_STRING)),
            'content_ar' => trim(filter_var(strip_tags($this->content_ar), FILTER_SANITIZE_STRING)),
            'content_en' => trim(filter_var(strip_tags($this->content_en), FILTER_SANITIZE_STRING))
        ];
    }
}
