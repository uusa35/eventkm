<?php

namespace App\Http\Resources;

use App\Models\Service;
use App\Models\Timing;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TimingLightResource extends JsonResource
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
            'day' => $this->day,
            'date' => $this->getCurrentDateAttribute($request->start_date, $request->range),
            'title' => $this->day_name,
            'start' => Carbon::parse($this->start)->format('h:i a'),
            'day_no' => $this->day_no,
            'service_id' => $this->service_id,
        ];
    }
}
