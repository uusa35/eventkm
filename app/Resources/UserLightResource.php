<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Support\Str;

class UserLightResource extends JsonResource
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
            'slug' => ucfirst(Str::limit($this->slug, 30, '')),
            'thumb' => $this->getCurrentImageAttribute('image'),
            'views' => $this->views,
            'rating' => $this->rating,
            'whatsapp' => numToEn($this->fullWhatsapp),
            'has_map' => ($this->longitude && $this->latitude),
            'longitude' => (float)$this->longitude,
            'latitude' => (float)$this->latitude,
            'service' => ucfirst(Str::limit($this->service, 30, '')),
            'role' => new RoleLightResource($this->whenLoaded('role')),
            'products' => ProductExtraLightResource::collection($this->whenLoaded('products')),
            'services' => ServiceLightResource::collection($this->whenLoaded('services')),
            'orders' => OrderLightResource::collection($this->whenLoaded('orders')),
            'coupons' => CouponLightResource::collection($this->whenLoaded('coupons')),
            'product_favorites' => ProductLightResource::collection($this->whenLoaded('product_favorites')),
            'service_favorites' => ServiceLightResource::collection($this->whenLoaded('service_favorites')),
            'images' => ImageLightResource::collection($this->whenLoaded('images')),
            'slides' => SlideLightResource::collection($this->whenLoaded('slides')),
            'notifications' => NotificationLightResource::collection($this->whenLoaded('notificationAlerts')),
            'tags' => TagLightResource::collection($this->whenLoaded('tags')),
            'collections' => CollectionLightResource::collection($this->whenLoaded('collections')),
            'ratings' => RatingLightResource::collection($this->whenLoaded('ratings')),
            'areas' => AreaLightResource::collection($this->whenLoaded('areas')),
            'branches' => BranchLightResource::collection($this->branches),
            'country' => new CountryLightResource($this->whenLoaded('country')),
        ];
    }
}
