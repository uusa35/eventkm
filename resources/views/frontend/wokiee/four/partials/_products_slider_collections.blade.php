<div class="container-indent">
    <div class="container-fluid-custom">
        <div class="tt-block-title">
            <h2 class="tt-title">{{ $title }}</h2>
            <div class="tt-description">{{ trans('message.hot_deal_products') }}</div>
        </div>
        <div
            class="tt-carousel-products row arrow-location-tab arrow-location-tab01 tt-alignment-img tt-layout-product-item slick-animated-show-js"
            data-item="{{ isset($items) ? $items : 4  }}"
        >
            <div class="col-lg-12">
                <div class="tt-product-listing-masonry">
                    <div class="tt-product-init tt-add-item">
                        @foreach($groupOne->take(5) as $product)
                            @include('frontend.wokiee.four.partials._product_widget_metro',['element' => $product, 'double' => $loop->first])
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="tt-product-listing-masonry">
                    <div class="tt-product-init tt-add-item">
                        @foreach($groupTwo->take(5) as $product)
                            @include('frontend.wokiee.four.partials._product_widget_metro',['element' => $product, 'double' => $loop->first])
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="tt-product-listing-masonry">
                    <div class="tt-product-init tt-add-item">
                        @foreach($groupThree->take(5) as $product)
                            @include('frontend.wokiee.four.partials._product_widget_metro',['element' => $product, 'double' => $loop->first])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


