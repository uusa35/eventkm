<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TimingResource extends JsonResource
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
            'day' => $this->day,
            'day_name_ar' => $this->day_name_ar,
            'day_name_en' => $this->day_name_en,
            'active' => $this->active,
            'start' => $this->start,
            'end' => $this->end,
            'is_off' => $this->is_off,
            'allow_multi_select' => $this->allow_multi_select,
            'is_available' => $this->is_available,
            'type' => $this->type,
            'today' => $this->today,
            'notes_ar' => $this->notes_ar,
            'notes_en' => $this->notes_en,
            'week_start' => $this->week_start,
            'day_no' => $this->day_no,
            'user_id' => $this->user_id,
            'service_id' => $this->service_id,
            'day_id' => $this->day_id,
        ];
    }
}
