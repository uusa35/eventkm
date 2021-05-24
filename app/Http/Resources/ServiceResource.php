<?php

namespace App\Http\Resources;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Support\Str;


class ServiceResource extends JsonResource
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
            'sku' => $this->sku,
            'name' => ucfirst(Str::limit($this->name, 30, '')),
            'isOnSale' => $this->isOnSale,
            'exclusive' => $this->exclusive,
            'on_home' => $this->on_home,
            'on_new' => $this->on_new,
            'duration' => $this->duration,
            'setup_time' => $this->setup_time,
            'delivery_time' => $this->delivery_time,
            'individuals' => $this->individuals,
            'delivery_charge' => $this->delivery_charge,
            'price' => (float) round($this->price, 2),
            'finalPrice' => (float) round($this->finalPrice, 2),
            'convertedFinalPrice' => (float) $this->convertedFinalPrice,
            'sale_price' => (float) $this->sale_price,
            'description' => $this->description,
            'notes' => $this->notes,
            'keywords' => $this->keywords,
            'thumb' => $this->getCurrentImageAttribute('image'),
            'large' => $this->getCurrentImageAttribute('image','large'),
            'start_sale' => $this->start_sale,
            'end_sale' => $this->end_sale,
            'active' => $this->active,
            'is_available' => $this->is_available,
            'is_hot_deal' => $this->is_hot_deal,
            'multi_booking' => $this->multi_booking,
            'booking_limit' => $this->booking_limit,
            'user_id' => $this->user_id,
            'views' => (integer) $this->views,
            'videoGroup' => [
                'video_url_one' => $this->video_url_one,
                'video_url_two' => $this->video_url_two,
                'video_url_three' => $this->video_url_three,
                'video_url_four' => $this->video_url_four,
                'video_url_five' => $this->video_url_five,
            ],
            'range' => new RangeTimingLightResource($this->timings,$this),
            'user' => new UserLightResource($this->whenLoaded('user')),
            'categories' => CategoryExtraLightResource::collection($this->whenLoaded('categories')),
            'images' => ImageLightResource::collection($this->whenLoaded('images')),
            'slides' => SlideLightResource::collection($this->whenLoaded('slides')),
            'tags' => TagLightResource::collection($this->whenLoaded('tags')),
            'videos' => VideoLightResource::collection($this->whenLoaded('videos')),
            'timings' => TimingLightResource::collection($this->whenLoaded('timings'))->groupBy('today'),
            'isFavorite' => auth('api')->user() ? in_array($this->id, User::where('api_token', request()->api_token)->first()->service_favorites()->pluck('service_id')->toArray()) : false
        ];
    }
}
