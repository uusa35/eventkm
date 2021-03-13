<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Types\Integer;
use \Illuminate\Support\Str;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'slug' => ucfirst(Str::limit($this->slug,30,'')),
            'description' => $this->description,
            'service' => $this->service,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'fullMobile' => $this->fullMobile,
            'phone' => $this->phone ? '+'.$this->country->calling_code  . $this->phone : null,
            'fax' => $this->fax ? $this->country->calling_code  . $this->fax : null,
            'thumb' => $this->image ? $this->imageThumbLink : null,
            'large' => $this->image ? $this->imageLargeLink : null,
            'medium' => $this->image ?  $this->imageMediumLink : null,
            'banner' => $this->getCurrentImageAttribute('banner', 'large'),
            'bg' => $this->getCurrentImageAttribute('bg'),
            'address' => $this->address,
//            'area' => $this->area,
//            'block' => $this->block,
//            'street' => $this->street,
//            'building' => $this->building,
//            'floor' => $this->floor,
//            'apartment' => $this->apartment,
            'countryName' => $this->countryName,
//            'policy' => $this->policy,
//            'cancellation' => $this->cancellation,
            'keywords' => $this->keywords,
            'path' => $this->path,
            'website' => $this->website,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'youtube' => $this->youtube,
            'twitter' => $this->twitter,
            'whatsapp' => $this->fullWhatsapp,
            'iphone' => $this->iphone,
            'android' => $this->android,
            'longitude' => (float)$this->longitude,
            'latitude' => (float)$this->latitude,
            'has_map' => ($this->longitude && $this->latitude),
            'player_id' => $this->player_id,
            'country_id' => $this->country_id,
            'role_id' => $this->role_id,
            'merchant_id' => $this->merchant_id,
            'api_token' => $this->api_token,
            'rating' => $this->rating,
            'isFanned' => auth('api')->user() ? in_array(auth('api')->user()->id,$this->fans->pluck('id')->toArray()) : false,
            'totalFans' => $this->totalFans > 0 ? $this->totalFans : 1,
            'views' => (integer) $this->views,
            'mobile_verified' => $this->mobile_verified,
            'videoGroup'=> [
                'video_url_one' => $this->video_url_one,
                'video_url_two' => $this->video_url_two,
                'video_url_three' => $this->video_url_three,
                'video_url_four' => $this->video_url_four,
                'video_url_five' => $this->video_url_five,
            ],
            'commentsCount' => $this->comments->count(),
            'myFannedList' => UserExtraLightResource::collection($this->whenLoaded('myFannedList')),
            'role' => RoleLightResource::make($this->whenLoaded('role')),
            'classifieds' => ClassifiedExtraLightResource::collection($this->whenLoaded('classifieds')),
            'products' => ProductExtraLightResource::collection($this->whenLoaded('products')),
            'productGroup' => ProductExtraLightResource::collection($this->whenLoaded('productGroup')),
            'productCategories' => $this->products->pluck('categories')->count() > 0 ? CategoryExtraLightResource::collection($this->products->pluck('categories')->flatten()->unique('id')) : [],
            'productGroupCategories' => $this->productGroup->pluck('categories')->count() > 0 ? CategoryExtraLightResource::collection($this->productGroup->pluck('categories')->flatten()->unique('id')) : [],
            'services' => ServiceExtraLightResource::collection($this->whenLoaded('services')),
            'orders' => OrderLightResource::collection($this->whenLoaded('orders')),
            'branches' => BranchLightResource::collection($this->whenLoaded('branches')),
            'coupons' => CouponLightResource::collection($this->whenLoaded('coupons')),
            'product_favorites' => ProductExtraLightResource::collection($this->whenLoaded('product_favorites')),
            'service_favorites' => ServiceExtraLightResource::collection($this->whenLoaded('service_favorites')),
            'classified_favorites' => ClassifiedExtraLightResource::collection($this->whenLoaded('classified_favorites')),
            'images' => ImageLightResource::collection($this->whenLoaded('images')),
            'slides' => SlideExtraLightResource::collection($this->whenLoaded('slides')),
            'notifications' => NotificationLightResource::collection($this->whenLoaded('notificationAlerts')),
            'tags' => TagLightResource::collection($this->whenLoaded('tags')),
            'collections' => CollectionLightResource::collection($this->whenLoaded('collections')),
            'ratings' => RatingLightResource::collection($this->whenLoaded('ratings')),
            'areas' => AreaLightResource::collection($this->whenLoaded('areas')),
            'country' => CountryLightResource::make($this->whenLoaded('country')),
            'videos' => VideoLightResource::make($this->whenLoaded('videos')),
            'comments' => CommentExtraLightResource::collection($this->whenLoaded('comments')),
            'addresses' => AddressResource::collection($this->whenLoaded('addresses'))
        ];
    }
}
