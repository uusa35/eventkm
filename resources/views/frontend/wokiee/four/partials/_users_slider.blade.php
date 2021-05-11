@if(isset($elements) && $elements->isNotEmpty())
    <div class="container-indent {!! isset($isGray) ? 'lightGrayBgRow' : '' !!}">
        <div class="container container-fluid-custom-mobile-padding">
            @if($title)
                <div class="tt-block-title">
                    <h1 class="tt-title">
                        @if($elements->first()->isDesigner)
                            <a href="{{ route('frontend.user.index', ['type' => 'is_designer']) }}" class="url-normal">{{ $title }}</a>
                        @else

                            <a href="{{ route('frontend.user.index', ['type' => 'is_company']) }}" class="url-normal">{{ $title }}</a>
                        @endif
                    </h1>
                    {{--                    <div class="tt-description">{{ trans('message.our_designers') }}</div>--}}
                </div>
            @endif
            <div class="tt-carousel-products row arrow-location-tab arrow-location-tab01 tt-alignment-img tt-layout-product-item slick-animated-show-js"
                 data-item="{{ isset($items) ? $items : 4  }}"
            >
                @foreach($elements as $element)
                    <div class="col-lg-3 col-sm-12">
                        @include('frontend.wokiee.four.partials._user_widget',['element' => $element])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
