@if(isset($elements) && $elements->isNotEmpty())
    <div class="container-indent {!! isset($isGray) ? 'lightGrayBgRow' : '' !!}">
        <div class="container container-fluid-custom-mobile-padding">
            @if($title)
                <div class="tt-block-title">
                    <h1 class="tt-title">{{ $title }}</h1>
                    {{--                <div class="tt-description">{{ trans('message.recent_products') }}</div>--}}
                </div>
            @endif
            <div class="tt-carousel-products row arrow-location-tab arrow-location-tab01 tt-alignment-img tt-layout-product-item slick-animated-show-js"
                 data-item="{{ isset($items) ? $items : 4  }}"
            >
                @foreach($elements as $element)
                    <div class="col-lg-3 col-sm-12">
                        @include('frontend.wokiee.four.partials._product_widget',['element' => $element,'view' => true, 'currency' => $currency])
                    </div>
                @endforeach
            </div>
{{--            @foreach($elements as $element)--}}
{{--                    @include('frontend.wokiee.four.partials._add_to_cart_quick_view_product_btn',['element' => $element, 'currency' => $currency])--}}
{{--                @endforeach--}}
        </div>
    </div>
@endif
