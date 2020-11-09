<div class="tt-product thumbprod-center" style="padding: 10px;">
    <div class="tt-image-box">
{{--        @include('frontend.wokiee.four.partials._quick_view_product_btn')--}}
{{--        @auth--}}
{{--            <a href="{{ route('frontend.favorite.product.add', $element->id) }}"--}}
{{--               class="tt-btn-wishlist {{ $element->isFavorited ? 'active' : null }}"--}}
{{--               data-tooltip="{{ trans('general.add_to_wish_list') }}"--}}
{{--               data-tposition="{{ app()->isLocale('ar') ? 'right' : 'left' }}"--}}
{{--            ></a>--}}
{{--        @endauth--}}
        <a href="{{ route('frontend.classified.show.name', ['id' => $element->id, 'name' => $element->name]) }}">
            @include('frontend.wokiee.four.partials._widget_tags_and_images')
        </a>
        @if($element->isReallyHot)
            @include('frontend.wokiee.four.partials._widget_is_really_hot')
        @endif
    </div>
    <div class="tt-description text-center">
        <div class="tt-row">
            <ul class="tt-add-info">
                <li>
                    <a href="{{ route('frontend.classified.search',['user_id' => $element->user_id]) }}">{{ str_limit($element->user->slug,25,'..') }}</a>
                </li>
        </div>
        <h2 class="tt-title">
            <a href="{{ route('frontend.classified.show.name', ['id' => $element->id, 'name' => $element->name]) }}">{{ str_limit($element->name,25,'..') }}</a>
        </h2>
        @include('frontend.wokiee.four.partials._widget_price_and_color')
        <div class="tt-product-inside-hover text-center">
            <div class="tt-row-btn">
                <a href="{{ route('frontend.classified.show.name', ['id' => $element->id, 'name' => $element->name]) }}"
                   class="btn btn-small mb-2">
                    <i class="icon-g-89"></i>
                    {{ trans('general.view_details') }}
                </a>
            </div>
        </div>
    </div>

</div>
