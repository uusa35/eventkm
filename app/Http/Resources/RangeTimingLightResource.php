<?php

namespace App\Http\Resources;

use App\Models\Service;
use App\Models\Timing;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Illuminate\Http\Resources\Json\JsonResource;

class RangeTimingLightResource extends JsonResource
{
    protected $service;

    public function __construct($resource, $service)
    {
        parent::__construct($resource);
        $this->service = $service;
    }

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $col = collect([]);
        $startDate = Carbon::parse($this->service->start_date) >= Carbon::now() ? Carbon::parse($this->service->start_date) : Carbon::now();
        if ($startDate) {
            $newPeriod = new \DatePeriod(Carbon::parse($startDate), CarbonInterval::day(1), Carbon::parse($this->service->end_date));
            if ($newPeriod) {
                foreach ($newPeriod as $date) {
                    $day = Carbon::parse($date)->format('l');
                    foreach ($this->service->timings as $time) {
                        if ($day === $time->day) {
                            $col->push([
                                'id' => $time->id,
                                'day' => $time->day,
                                'date' => Carbon::parse($date)->format('d/m/Y'),
                                'title' => $time->day_name,
                                'start' => Carbon::parse($time->start)->format('h:i a'),
                                'end' => Carbon::parse($time->end)->format('h:i a'),
                                'day_no' => $time->day_no,
                                'service_id' => $this->service->id,
                            ]);
                        }
                    }
                }
                return $col->groupBy('date');
            }
        }
    }
}
