@extends('frontend.wokiee.four.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('frontend.product.show',$element) }}
@endsection

@section('title')
    <title>{{ $element->name }}</title>
    <meta name="title" content="{{ $element->name .' '. $element->description }}">
    @if(\Str::contains(Route::getCurrentRoute()->getName(), ['product','service']))
        @if($settings->facebook)
            <meta itemProp="facebook" content="{{ $settings->facebook }}"/>
            <meta property="facebook:card" content="{{ $element->imageThumbLink }}">
            <meta property="facebook:url" content="{{ url()->current() }}">
            <meta property="facebook:title" content="{{ $element->company }}">
            <meta property="facebook:description" content="{{ $element->description }}">
            <meta property="facebook:image" content="{{ $element->imageThumbLink }}">
        @endif
        @if($settings->twitter)
            <meta itemProp="twitter" content="{{ $settings->twitter }}"/>
            <meta property="twitter:card" content="{{ $element->imageThumbLink }}">
            <meta property="twitter:url" content="{{ url()->current() }}">
            <meta property="twitter:title" content="{{ $element->name }}">
            <meta property="twitter:description" content="{{ $element->description }}">
            <meta property="twitter:image" content="{{ $element->imageThumbLink }}">
        @endif
        @if($settings->instagram)
            <meta itemProp="instagram" content="{{ $settings->instagram }}"/>
            <meta property="instagram:card" content="{{ $element->imageThumbLink }}">
            <meta property="instagram:url" content="{{ url()->current() }}">
            <meta property="instagram:title" content="{{ $element->name }}">
            <meta property="instagram:description" content="{{ $element->description }}">
            <meta property="instagram:image" content="{{ $element->imageThumbLink }}">
        @endif
    @endif
@show

@section('body')
    <div class="container-indent">
        @include('frontend.wokiee.four.partials._service_show_gallery_mobile')
        <div class="container  container-fluid-mobile">
            <div class="row">
                <div class="col-6 hidden-xs">
                    @include('frontend.wokiee.four.partials._service_show_gallery')
                </div>
                <div class="col-6">
                    <div class="tt-product-single-info">
                        @if(!env('EVENTKM'))
                            @include('frontend.wokiee.four.partials._show_tags')
                        @endif
                        @include('frontend.wokiee.four.partials._show_page_item_title_description_and_prices')
                        @include('frontend.wokiee.four.partials._service_show_is_really_hot_element')
                        @include('frontend.wokiee.four.partials._shipment_and_size_chart_btns')
                        @if($element->canOrder && $element->hasStock)
                            @if($element->direct_purchase)
                                <div class="card bg-danger mb-3 mt-3">
                                    <div class="card-header text-center">
                                        <span class="text-white text-center">{{ trans('message.direct_purchase_product') }}</span>
                                    </div>
                                </div>
                            @endif
                            <div class="tt-swatches-container">
                                @if($element->hasRealAttributes)
                                    <div id="productAttributeApp"></div>
                                @endif
                                {{--                                @if($element->has_attributes && $element->product_attributes->isNotEmpty())--}}
                                {{--                                    @include('frontend.wokiee.four.partials._page_show_sizes',['sizes' => $element->product_attributes->pluck('size')->unique(),'id' => $element->id])--}}
                                {{--                                    @include('frontend.wokiee.four.partials._page_show_colors',['colors' => $element->product_attributes->pluck('color')->unique(),'hidden' => true,'id' => $element->id])--}}
                                {{--                                @endif--}}
                            </div>
                            @include('frontend.wokiee.four.partials._product_show_add_to_cart_btn')
                        @endif
                        @if(auth()->check() && env('ENABLE_FAV'))
                            <div class="tt-wrapper mb-5">
                                <div class="tt-row-btn">
                                    <a class="btn btn-small col-lg-12 {{ $element->isFavorited ? 'active' : null }}"
                                       href="{{ route('frontend.favorite.product.add', $element->id) }}"><i
                                            class="icon-n-072"></i>{{ trans('general.add_to_wish_list') }}</a>
                                    {{--<li><a class="btn-link" href="#"><i class="icon-n-08"></i>ADD TO COMPARE</a></li>--}}
                                </div>
                            </div>
                        @endif

                        <div class="tt-wrapper">
                            @if(!env('BITS'))
                                @include('frontend.wokiee.four.partials._product_show_information_widget')
                            @endif
                            @desktop
                            <div class="sharethis-inline-share-buttons"></div>
                            @enddesktop
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('frontend.wokiee.four.partials._show_page_social_icons')
    @desktop
    @include('frontend.wokiee.four.partials._show_page_related_items',['elements' => $relatedItems])
    @enddesktop
    @include('frontend.wokiee.four.partials._modal_page_show_video')
    @include('frontend.wokiee.four.partials._modal_size_chart')
    @include('frontend.wokiee.four.partials._modal_page_show_shipment')
@endsection

@section('scripts')
    @parent
    @desktop
    <script type="text/javascript"
            src="https://platform-api.sharethis.com/js/sharethis.js#property=5c6ed2597056550011c4ab2a&product=inline-share-buttons"></script>
    @enddesktop
@endsection

