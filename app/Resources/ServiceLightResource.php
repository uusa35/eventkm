<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Support\Str;

class ServiceLightResource extends JsonResource
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
            'name' => ucfirst(Str::limit($this->name,30,'')),
            'isOnSale' => $this->isOnSale,
            'exclusive' => $this->exclusive,
            'on_home' => $this->on_home,
            'on_new' => $this->on_new,
            'duration' => $this->duration,
            'setup_time' => $this->setup_time,
            'delivery_time' => $this->delivery_time,
            'individuals' => $this->individuals,
            'delivery_charge' => $this->delivery_charge,
            'price' => (float)round($this->price, 2),
            'finalPrice' => (float)round($this->finalPrice, 2),
            'convertedFinalPrice' => (float) $this->convertedFinalPrice,
            'start_date' => $this->start_date,
            'sale_price' => (float) $this->sale_price,
            'description' => $this->description,
            'thumb' => $this->imageThumbLink,
            'large' => $this->imageLargeLink,
            'is_available' => $this->is_available,
            'is_hot_deal' => $this->is_hot_deal,
            'multi_booking' => $this->multi_booking,
            'booking_limit' => $this->booking_limit,
            'user_id' => $this->user_id,
            'user' => new UserExtraLightResource($this->whenLoaded('user')),
            'range' => new RangeTimingLightResource($this->timings,$this),
            'categories' => CategoryExtraLightResource::collection($this->whenLoaded('categories')),
            'images' => ImageLightResource::collection($this->whenLoaded('images')),
            'slides' => SlideLightResource::collection($this->whenLoaded('slides')),
            'tags' => TagExtraLightResource::collection($this->whenLoaded('tags')),
        ];
    }
}
