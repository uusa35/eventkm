<div class="tt-product thumbprod-center" style="padding: 10px;">
    <div class="tt-image-box">
        {{--        @include('frontend.wokiee.four.partials._quick_view_product_btn')--}}
        {{--<a href="#" class="tt-btn-compare" data-tooltip="Add to Compare"--}}
        {{--data-tposition="{{ app()->isLocale('ar') ? 'right' : 'left' }}"--}}
        {{--></a>--}}
        @if(isset($isUsers) && $isUsers)
            <a href="{{ route('frontend.service.search', ['user_id' => $element->id]) }}">
                @include('frontend.wokiee.four.partials._widget_tags_and_images')
            </a>
        @else
            {{--            <a href="{{ route('frontend.category.show', $element->id) }}">--}}
            {{--                @include('frontend.wokiee.four.partials._widget_tags_and_images')--}}
            {{--            </a>--}}
            @if($type === 'service')
                <a href="{{ route('frontend.service.search', ['service_category_id' => $element->id]) }}">
                    @include('frontend.wokiee.four.partials._widget_tags_and_images')
                </a>
            @else
                <a href="{{ route('frontend.product.search', ['product_category_id' => $element->id]) }}">
                    @include('frontend.wokiee.four.partials._widget_tags_and_images')
                </a>
            @endif
        @endif
    </div>
    @include('frontend.wokiee.four.partials._category_widget_description')
</div>
