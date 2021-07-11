
<div class="element-item {{ $loop->index === 1 ? 'double-size hidden-xs' : null  }}">
    <div class="tt-product-design02 thumbprod-center">
        <div class="tt-image-box">
            <a href="{{ route('frontend.product.show', $element->id) }}">
                <span class="tt-img"><img src="{{ $element->imageThumbLink }}" alt="{{ $element->name }}"></span>
            </a>
            @if($element->isReallyHot && $double)
                @include('frontend.wokiee.four.partials._widget_is_really_hot')
            @endif
        </div>
        @include('frontend.wokiee.four.partials._product_widget_description')
{{--        @include('frontend.wokiee.four.partials._add_to_cart_quick_view_product_btn',['currency' => $currency])--}}
        @auth
            <a href="{{ route('frontend.favorite.product.add', $element->id) }}" class="tt-btn-wishlist {{ $element->isFavorited ? 'active' : null }}"
               data-tooltip="{{ trans('general.add_to_wish_list') }}"
               data-tposition="{{ app()->isLocale('ar') ? 'right' : 'left' }}"
            ></a>
        @endauth
    </div>
</div>
