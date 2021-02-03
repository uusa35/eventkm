<div class="tt-product thumbprod-center" style="padding: 10px;">
    <div class="tt-image-box">
        @include('frontend.wokiee.four.partials._quick_view_product_btn')
        @if(auth()->check() && env('ENABLE_FAV'))
            <a href="{{ route('frontend.favorite.product.add', $element->id) }}"
               class="tt-btn-wishlist {{ $element->isFavorited ? 'active' : null }}"
               data-tooltip="{{ trans('general.add_to_wish_list') }}"
               data-tposition="{{ app()->isLocale('ar') ? 'right' : 'left' }}"
            ></a>
        @endif
        @if(env('COMPARE_PRODUCT'))
            <a href="{{ route('frontend.product.compare.add', $element->id) }}" class="tt-btn-compare"
               data-tooltip="{{ trans('general.add_to_compare') }}"
               data-tposition="{{ app()->isLocale('ar') ? 'right' : 'left' }}"
            ></a>
        @endif
        <a href="{{ route('frontend.product.show.name', ['id' => $element->id, 'name' => $element->name]) }}">
            @include('frontend.wokiee.four.partials._widget_tags_and_images')
        </a>
        @if($element->isReallyHot)
            @include('frontend.wokiee.four.partials._widget_is_really_hot')
        @endif
    </div>
    @include('frontend.wokiee.four.partials._product_widget_description')
</div>
