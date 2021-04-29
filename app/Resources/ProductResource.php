<?php

namespace App\Http\Resources;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => ucfirst(str_limit($this->name, 30,'')),
            'on_new' => $this->on_new,
            'home_delivery_availability' => $this->home_delivery_availability,
            'shipment_availability' => $this->shipment_availability,
            'delivery_time' => $this->delivery_time,
            'exclusive' => $this->exclusive,
            'isOnSale' => $this->isOnSale,
            'on_sale' => $this->on_sale,
            'is_available' => $this->is_available,
            'price' => (float) round($this->price, 2),
            'finalPrice' => $this->finalPrice,
            'convertedFinalPrice' => $this->convertedFinalPrice,
            'weight' => $this->weight,
            'sale_price' => (double)$this->sale_price,
            'size_chart_image' => $this->size_chart_image ? $this->getProductSizeChartImageAttribute() : null,
            'qr' => $this->getCurrentImageAttribute('qr', 'large'),
            'description' => $this->description,
            'notes' => $this->notes,
            'keywords' => $this->keywords,
            'thumb' => $this->getCurrentImageAttribute(),
            'large' => $this->getCurrentImageAttribute('image', 'large'),
            'views' => (integer) $this->views,
            'videoGroup'=> [
                'video_url_one' => $this->video_url_one,
                'video_url_two' => $this->video_url_two,
                'video_url_three' => $this->video_url_three,
                'video_url_four' => $this->video_url_four,
                'video_url_five' => $this->video_url_five,
            ],
            'start_sale' => $this->start_sale,
            'end_sale' => Carbon::parse($this->end_sale)->format('d-m-Y'),
            'check_stock' => $this->check_stock,
            'has_stock' => $this->hasStock,
            'isReallyHot' => $this->isReallyHot,
            'has_attributes' => $this->hasRealAttributes,
            'wrap_as_gift' => $this->wrap_as_gift,
            'show_attribute' => $this->show_attribute,
            'qty' => (Int)$this->totalAVailableQty,
            'user_id' => $this->user_id,
            'brand_id' => $this->brand_id,
            'color_id' => $this->color_id,
            'size_id' => $this->size_id,
            'rating' => $this->rating,
            'shipment_package_id' => $this->shipment_package_id,
            'directPurchase' => $this->direct_purchase,
            'tailorService' => $this->tailor_measurement_service,
            'user' => new UserExtraLightResource($this->whenLoaded('user')),
            'product_attributes' => $this->has_attributes ? ProductAttributeLightResource::collection($this->whenLoaded('product_attributes')) : [],
            'shipment_package' => ShipmentPackageLightResource::make($this->whenLoaded('shipment_package')),
            'colors' => ColorLightResource::collection($this->whenLoaded('colors')),
            'color' => new ColorLightResource($this->whenLoaded('color')),
            'size' => new SizeLightResource($this->whenLoaded('size')),
            'sizes' => SizeLightResource::collection($this->whenLoaded('sizes')),
            'categories' => CategoryExtraLightResource::collection($this->whenLoaded('categories')),
            'brand' => BrandLightResource::make($this->whenLoaded('brand')),
            'images' => ImageLightResource::collection($this->whenLoaded('images')),
            'slides' => SlideExtraLightResource::collection($this->whenLoaded('slides')),
            'tags' => TagLightResource::collection($this->whenLoaded('tags')),
            'collections' => CollectionLightResource::collection($this->whenLoaded('collections')),
            'videos' => VideoLightResource::collection($this->whenLoaded('videos')),
            'isFavorite' => auth('api')->user() ? in_array($this->id,User::where('api_token', request()->api_token)->first()->product_favorites()->pluck('product_id')->toArray()) : false
        ];
    }
}
