<div class="container-indent">
    {{--<div class="row">--}}
    {{--<div class="col-lg-2 text-block">--}}
    {{--<img src="https://placehold.it/300x580?text=ads" alt="" class="img-responsive text-center">--}}
    {{--</div>--}}
    {{--<div class="col-lg-8">--}}
    <div class="container container-fluid-custom-mobile-padding">
        @if($title)
            <div class="tt-block-title">
                <h1 class="tt-title">{{ $title }}</h1>
                <div class="tt-description">{{ isset($message) ? $message : trans('message.recent_services') }}</div>
            </div>
        @endif
        <div class="tt-carousel-products row arrow-location-tab arrow-location-tab01 tt-alignment-img tt-layout-product-item slick-animated-show-js">
            @foreach($elements as $element)
                <div class="col-2 col-md-4 col-lg-3">
                    @include('frontend.wokiee.four.partials._service_widget',['element' => $element])
                </div>
            @endforeach
        </div>
    </div>
    {{--</div>--}}
    {{--<div class="col-lg-2 text-block">--}}
    {{--<img src="https://placehold.it/320x580?text=ads" alt="" class="img-responsive text-center">--}}
    {{--</div>--}}
    {{--</div>--}}
</div>
