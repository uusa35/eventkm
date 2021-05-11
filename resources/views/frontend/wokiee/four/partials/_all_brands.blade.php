@if($elements->where('on_home', true)->isNotEmpty())
    <div class="container-indent {!! isset($isGray) ? 'lightGrayBgRow' : '' !!}">
        <div class="container container-fluid-custom-mobile-padding">
            <div class="tt-block-title">
                <h2 class="tt-title">{{ trans('general.brands') }}</h2>
{{--                <div class="tt-description">{{ trans('message.brands_on_home_page') }}</div>--}}
            </div>
            <div class="row tt-img-box-listing">
                @foreach($elements->where('on_home', true) as $b)
                    <div class="col-6 col-sm-4 col-md-3">
                        <a href="{{ route('frontend.user.search',['user_category_id' => $b->id]) }}" class="tt-img-box">
                            <img src="{{ env('IMG_LOADER') }}" data-src="{{ $b->imageThumbLink }}" class="img-sm" alt="{{ $b->slug  }}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
