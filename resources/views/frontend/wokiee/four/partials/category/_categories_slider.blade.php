@if(isset($elements) && $elements->isNotEmpty())
    <div class="container-indent {!! isset($isGray) ? 'lightGrayBgRow' : '' !!}">
        <div class="container container-fluid-custom-mobile-padding">
            @if($title)
                <div class="tt-block-title">
                    <h1 class="tt-title">
                        <a href="{{ route('frontend.category.index') }}">{{ $title }}</a>
                    </h1>
                    {{--                    <div class="tt-description">{{ trans('message.our_designers') }}</div>--}}
                </div>
            @endif
            <div
                class="tt-carousel-products row arrow-location-tab arrow-location-tab01 tt-alignment-img tt-layout-product-item slick-animated-show-js"
                data-item="{{ isset($items) ? $items : 4  }}">
                @foreach($elements as $element)
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
                                                                        {{ str_limit($element->name,25) }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <h2 class="tt-title">
                                        @if($type === 'user')
                                            <a href="{{ route('frontend.user.search', ['user_category_id' => $element->id,'name' => $element->name]) }}">
                                                @elseif($type === 'product')
                                                    <a href="{{ route('frontend.product.search', ['product_category_id' => $element->id,'name' => $element->name]) }}">
                                                        @else
                                                            <a href="{{ route('frontend.service.search', ['service_category_id' => $element->id,'name' => $element->name]) }}">
                                        @endif
                                        {{ $element->caption }}
                                    </h2>
                                    <div class="tt-product-inside-hover">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                    @if($element->children->isNotEmpty())
                        @foreach($element->children as $child)
                            <div class="col-lg-3 col-sm-12">
                                @if($child)
                                    <div class="tt-product thumbprod-center" style="padding: 10px;">
                                        <div class="tt-image-box">
                                            {{--<a href="#" class="tt-btn-quickview" data-toggle="modal"--}}
                                            {{--data-target="#ModalquickView"--}}
                                            {{--data-tooltip="{{ trans('general.quick_view') }}"--}}
                                            {{--data-tposition="{{ app()->isLocale('ar') ? 'right' : 'left' }}"--}}
                                            {{--data-name="{{ $child->name }}"--}}
                                            {{--data-id="{{ $child->id }}"--}}
                                            {{--data-image="{{ $child->imageLargeLink }}"--}}
                                            {{--data-description="{{ $child->description }}"--}}
                                            {{--data-sku="{{ $child->id }}"--}}
                                            {{--data-url="{{ route('frontend.user.show.name', ['id' => $child->id, 'name' => $child->name]) }}"--}}
                                            {{--></a>--}}
                                            {{--<a href="#" class="tt-btn-compare" data-tooltip="Add to Compare"--}}
                                            {{--data-tposition="{{ app()->isLocale('ar') ? 'right' : 'left' }}"--}}
                                            {{--></a>--}}
                                            {{--                    @if($child->isDesigner)--}}
                                            {{--                    <a href="{{ route('frontend.product.search', ['designer_id' => $child->id]) }}">--}}
                                            {{--                    @else--}}
                                            {{--                        <a href="{{ route('frontend.product.search', ['user_id' => $child->id]) }}">--}}
                                            {{--                    @endif--}}
                                            @if($type === 'user')
                                                <a href="{{ route('frontend.user.search', ['user_category_id' => $child->id]) }}">
                                                    @elseif($type === 'product')
                                                        <a href="{{ route('frontend.product.search', ['product_category_id' => $child->id]) }}">
                                                            @else
                                                                <a href="{{ route('frontend.service.search', ['service_category_id' => $child->id]) }}">
                                                                    @endif
                                                                    <span class="tt-img">
                                        <img src="{{ $child->imageLargeLink }}" alt="{{ $child->description }}"/>
                                    </span>
                                                                </a>
                                        </div>
                                        <div class="tt-description">
                                            <div class="tt-row">
                                                <ul class="tt-add-info">
                                                    <li>
                                                        @if($type === 'user')
                                                            <a href="{{ route('frontend.user.search', ['user_category_id' => $child->id]) }}">
                                                                @elseif($type === 'product')
                                                                    <a href="{{ route('frontend.product.search', ['product_category_id' => $child->id]) }}">
                                                                        @else
                                                                            <a href="{{ route('frontend.service.search', ['service_category_id' => $child->id]) }}">
                                                                                @endif
                                                                                {{ str_limit($child->name,25) }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <h2 class="tt-title">
                                                @if($type === 'user')
                                                    <a href="{{ route('frontend.user.search', ['user_category_id' => $child->id,'name' => $child->name]) }}">
                                                        @elseif($type === 'product')
                                                            <a href="{{ route('frontend.product.search', ['product_category_id' => $child->id,'name' => $child->name]) }}">
                                                                @else
                                                                    <a href="{{ route('frontend.service.search', ['service_category_id' => $child->id,'name' => $child->name]) }}">
                                                @endif
                                                {{ $child->caption }}
                                            </h2>
                                            <div class="tt-product-inside-hover">
                                                <div class="tt-row-btn">
                                                    @if($type === 'user')
                                                        <a href="{{ route('frontend.user.search', ['user_category_id' => $child->id,'name' => $child->name]) }}"
                                                           class="btn btn-small">
                                                            @elseif($type === 'product')
                                                                <a href="{{ route('frontend.product.search', ['product_category_id' => $child->id,'name' => $child->name]) }}"
                                                                   class="btn btn-small">
                                                                    @else
                                                                        <a href="{{ route('frontend.service.search', ['service_category_id' => $child->id,'name' => $child->name]) }}"
                                                                           class="btn btn-small">
                                                                            @endif
                                                                            {{ trans('general.view_details') }}</a>
                                                </div>
                                                <div class="tt-row-btn">
                                                    <a href="#" class="tt-btn-quickview" data-toggle="modal"
                                                       data-tooltip="{{ trans('general.quick_view') }}"
                                                       data-tposition="{{ app()->isLocale('ar') ? 'right' : 'left' }}"
                                                       data-target="#ModalquickView"
                                                       data-name="{{ $child->name }}"
                                                       data-id="{{ $child->id }}"
                                                       data-image="{{ $child->imageLargeLink }}"
                                                       data-description="{{ $child->description }}"
                                                       data-sku="{{ $child->sku }}"
                                                       data-url="{{ route('frontend.user.show.name', ['id' => $child->id, 'name' => $child->name]) }}"
                                                    ></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif
