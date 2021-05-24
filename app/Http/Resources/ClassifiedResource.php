<?php

namespace App\Http\Resources;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Support\Str;
Carbon::setLocale(request()->header('lang'));

class ClassifiedResource extends JsonResource
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
            'name' => ucfirst(Str::limit($this->name, 30, '')),
            'description' => $this->description,
            'mobile' => $this->mobile ? '+'.$this->country->calling_code  . $this->mobile : null,
            'image' => $this->image,
            'large' => $this->imageLargeLink,
            'price' => (float) round($this->price, 2),
            'address' => $this->address,
            'block' => $this->block,
            'street' => $this->street,
            'building' => $this->building,
            'floor' => $this->floor,
            'apartment' => $this->apartment,
            'rooms' => $this->rooms,
            'bathroom' => $this->bathroom,
            'years_old' => $this->years_old,
            'keywords' => $this->keywords,
            'path' => $this->path,
            'longitude' => (float)$this->longitude,
            'latitude' => (float)$this->latitude,
            'has_map' => ($this->longitude && $this->latitude),
            'has_items' => $this->items->isNotEmpty(),
            'years_experience' => $this->years_experience,
            'videoGroup' => [
                'video_url_one' => $this->video_url_one,
                'video_url_two' => $this->video_url_two,
                'video_url_three' => $this->video_url_three,
                'video_url_four' => $this->video_url_four,
                'video_url_five' => $this->video_url_five,
            ],
            'is_property' => $this->is_property,
            'is_negotiable' => $this->is_negotiable,
            'is_available' => $this->is_available,
            'is_paid' => $this->is_paid,
            'exclusive' => $this->exclusive,
            'is_exclusive' => $this->is_exclusive,
            'is_featured' => $this->is_featured,
            'has_balcony' => $this->has_balcony,
            'only_whatsapp' => $this->only_whatsapp,
            'category_id' => $this->category_id,
            'country_id' => $this->country_id,
            'governate_id' => $this->governate_id,
            'area_id' => $this->area_id,
            'user_id' => $this->user_id,
            'views' => (integer) $this->views,
            'created_at' => $this->created_at->diffForHumans(),
            'commentsCount' => $this->comments->count(),
            'expired_at' => $this->expired_at,
            'area' => $this->area()->first() ? $this->area()->first()->slug : ($this->area ? $this->area : null),
            'isFavorite' => auth('api')->user() && request()->has('api_token') ? in_array($this->id, User::where('api_token', request()->api_token)->first()->classified_favorites()->pluck('classified_id')->toArray()) : false,
            'user' => new UserLightResource($this->whenLoaded('user')),
            'country' => new CountryLightResource($this->whenLoaded('country')),
            'category' => CategoryExtraLightResource::make($this->whenLoaded('category')),
            'images' => ImageLightResource::collection($this->whenLoaded('images')),
            'tags' => TagLightResource::collection($this->whenLoaded('tags')),
            'items' => ClassifiedItemLightResource::collection($this->whenLoaded('items')),
            'comments' => CommentExtraLightResource::collection($this->whenLoaded('comments'))
        ];
    }
}
