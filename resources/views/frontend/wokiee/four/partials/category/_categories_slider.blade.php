@if(isset($elements) && $elements->isNotEmpty())
    <div class="container-indent">
        <div class="container container-fluid-custom-mobile-padding">
            @if($title)
                <div class="tt-block-title">
                    <h1 class="tt-title">
                        {{ $title }}
                    </h1>
                    {{--                    <div class="tt-description">{{ trans('message.our_designers') }}</div>--}}
                </div>
            @endif
            <div
                class="tt-carousel-products row arrow-location-tab arrow-location-tab01 tt-alignment-img tt-layout-product-item slick-animated-show-js"
                data-item="{{ isset($items) ? $items : 4  }}"
            >
                @foreach($elements->pluck('children')->flatten() as $element)
                    <div class="col-lg-3 col-sm-12">
                        @if($element)
                            <div class="tt-product thumbprod-center" style="padding: 10px;">
                                <div class="tt-image-box">
                                    {{--<a href="#" class="tt-btn-quickview" data-toggle="modal"--}}
                                    {{--data-target="#ModalquickView"--}}
                                    {{--data-tooltip="{{ trans('general.quick_view') }}"--}}
                                    {{--data-tposition="{{ app()->isLocale('ar') ? 'right' : 'left' }}"--}}
                                    {{--data-name="{{ $element->name }}"--}}
                                    {{--data-id="{{ $element->id }}"--}}
                                    {{--data-image="{{ $element->imageLargeLink }}"--}}
                                    {{--data-description="{{ $element->description }}"--}}
                                    {{--data-sku="{{ $element->id }}"--}}
                                    {{--data-url="{{ route('frontend.user.show.name', ['id' => $element->id, 'name' => $element->name]) }}"--}}
                                    {{--></a>--}}
                                    {{--<a href="#" class="tt-btn-compare" data-tooltip="Add to Compare"--}}
                                    {{--data-tposition="{{ app()->isLocale('ar') ? 'right' : 'left' }}"--}}
                                    {{--></a>--}}
                                    {{--                    @if($element->isDesigner)--}}
                                    {{--                    <a href="{{ route('frontend.product.search', ['designer_id' => $element->id]) }}">--}}
                                    {{--                    @else--}}
                                    {{--                        <a href="{{ route('frontend.product.search', ['user_id' => $element->id]) }}">--}}
                                    {{--                    @endif--}}
                                    @if($type === 'user')
                                        <a href="{{ route('frontend.user.search', ['user_category_id' => $element->id]) }}">
                                            @elseif($type === 'product')
                                                <a href="{{ route('frontend.product.search', ['product_category_id' => $element->id]) }}">
                                                    @else
                                                        <a href="{{ route('frontend.service.search', ['service_category_id' => $element->id]) }}">
                                                            @endif
                                                            <span class="tt-img">
                                        <img src="{{ $element->imageLargeLink }}" alt="{{ $element->description }}"/>
                                    </span>
                                                        </a>
                                </div>
                                <div class="tt-description">
                                    <div class="tt-row">
                                        <ul class="tt-add-info">
                                            <li>
                                                @if($type === 'user')
                                                    <a href="{{ route('frontend.user.search', ['user_category_id' => $element->id]) }}">
                                                        @elseif($type === 'product')
                                                            <a href="{{ route('frontend.product.search', ['product_category_id' => $element->id]) }}">
                                                                @else
                                                                    <a href="{{ route('frontend.service.search', ['service_category_id' => $element->id]) }}">
                                                                        @endif
                                                    {{ str_limit($element->slug,25) }}</a>
                                                {{--                        @if($element->isDesigner)--}}
                                                {{--                            <a href="{{ route('frontend.product.search', ['designer_id' => $element->id]) }}">{{ $element->slug }}</a>--}}
                                                {{--                        @else--}}
                                                {{--                            <a href="{{ route('frontend.product.search', ['user_id' => $element->id]) }}">{{ $element->slug }}</a>--}}
                                                {{--                        @endif--}}
                                            </li>
                                        </ul>
                                        {{--@include('frontend.wokiee.four.partials._rating')--}}
                                    </div>
                                    <h2 class="tt-title">
                                        @if($type === 'user')
                                            <a href="{{ route('frontend.user.search', ['user_category_id' => $element->id,'name' => $element->name]) }}">
                                                @elseif($type === 'product')
                                                    <a href="{{ route('frontend.product.search', ['product_category_id' => $element->id,'name' => $element->name]) }}">
                                                        @else
                                                            <a href="{{ route('frontend.service.search', ['service_category_id' => $element->id,'name' => $element->name]) }}">
                                        @endif
                                        {{--                @if($element->isDesigner)--}}
                                        {{--                    <a href="{{ route('frontend.product.search', ['designer_id' => $element->id]) }}">{{ str_limit($element->description,100,'...') }}</a>--}}
                                        {{--                @else--}}
                                        {{--                    <a href="{{ route('frontend.product.search', ['user_id' => $element->id]) }}">{{ str_limit($element->description,100,'...') }}</a>--}}
                                        {{--                @endif--}}
                                    </h2>
                                    {{--@include('frontend.wokiee.four.partials._widget_price_and_color')--}}
                                    <div class="tt-product-inside-hover">
                                        {{--<div class="tt-row-btn">--}}
                                        {{--<a href="{{ route('frontend.product.show', $element->id) }}"--}}
                                        {{--class="tt-btn-addtocart thumbprod-button-bg" data-toggle="modal"--}}
                                        {{--data-target="#modalAddToCartProduct">{{ trans('general.view') }}</a>--}}
                                        {{--</div>--}}
                                        @if($element->isDesigner)
                                            <div class="tt-row-btn">
                                                @if($type === 'user')
                                                    <a href="{{ route('frontend.user.search', ['user_category_id' => $element->id,'name' => $element->name]) }}"
                                                       class="btn btn-small">
                                                        @elseif($type === 'product')
                                                            <a href="{{ route('frontend.product.search', ['product_category_id' => $element->id,'name' => $element->name]) }}"
                                                               class="btn btn-small">
                                                                @else
                                                                    <a href="{{ route('frontend.service.search', ['service_category_id' => $element->id,'name' => $element->name]) }}"
                                                                       class="btn btn-small">
                                                                        @endif
                                                                        {{ $element->name }}
                                                                    </a>
                                            </div>
                                            @if($element->surveys->isNotEmpty() && auth()->check())
                                                <div class="tt-row-btn">
                                                    <a href="{{ route('frontend.survey.show',[$element->surveys->first()->id,'user_id' => $element->id]) }}"
                                                       class="btn btn-small">{{ trans('general.make_collection_order') }}</a>
                                                </div>
                                            @endif
                                        @else
                                            <div class="tt-row-btn">
                                                @if($type === 'user')
                                                    <a href="{{ route('frontend.user.search', ['user_category_id' => $element->id,'name' => $element->name]) }}"
                                                       class="btn btn-small">
                                            @elseif($type === 'product')
                                                <a href="{{ route('frontend.product.search', ['product_category_id' => $element->id,'name' => $element->name]) }}"
                                                   class="btn btn-small">
                                                    @else
                                                    <a href="{{ route('frontend.service.search', ['service_category_id' => $element->id,'name' => $element->name]) }}"
                                                    class="btn btn-small">
                                                    @endif
                                                    {{ trans('general.view_details') }}</a>
                                            </div>
                                        @endif
                                        <div class="tt-row-btn">
                                            <a href="#" class="tt-btn-quickview" data-toggle="modal"
                                               data-tooltip="{{ trans('general.quick_view') }}"
                                               data-tposition="{{ app()->isLocale('ar') ? 'right' : 'left' }}"
                                               data-target="#ModalquickView"
                                               data-name="{{ $element->name }}"
                                               data-id="{{ $element->id }}"
                                               data-image="{{ $element->imageLargeLink }}"
                                               data-description="{{ $element->description }}"
                                               data-sku="{{ $element->sku }}"
                                               data-url="{{ route('frontend.user.show.name', ['id' => $element->id, 'name' => $element->name]) }}"
                                            ></a>
                                            @auth
                                                <a href="#" class="tt-btn-wishlist"></a>
                                            @endauth
                                            {{--<a href="#" class="tt-btn-compare"></a>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
