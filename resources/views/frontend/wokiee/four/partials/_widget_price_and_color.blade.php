<div style="min-height: 8rem;">
    <div class="tt-row text-center">
        <div class="tt-price col-lg-12">
            @if($element->isOnSale)
                <span class="new-price">{{ $element->convertedSalePrice}}<span>{{ $currency->symbol }}</span></span>
                {{--            <span class="old-price d-md-block pull-right small">{{ $element->convertedPrice }}<span>{{ $currency->symbol }}</span></span>--}}
            @else
                <span class="sale-price">{{ $element->convertedPrice }}<span>{{ $currency->symbol }}</span></span>
            @endif
        </div>
    </div>
    @if($element->hasRealAttributes)
        <div class="tt-option-block">
            <ul class="tt-options-swatch">
                @foreach($element->product_attributes->pluck('color')->unique('id') as $color)
                    <li><a class="options-color" style="background-color: {{ $color->code }};"
                           href="{{ route('frontend.product.show.name', ['id' => $element->id, 'name' => $element->name]) }}"></a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="tt-option-block">
            <ul class="tt-options-swatch js-change-img">
                @foreach($element->product_attributes->pluck('size')->unique('id')->take(2) as $size)
                    <li>
                        <a href="{{ route('frontend.product.show.name', ['id' => $element->id, 'name' => $element->name]) }}"
                           class="options-color-img"
                           data-src="images/product/product-03-05.jpg"
                           data-src-hover="images/product/product-03-05-hover.jpg"
                           data-tooltip="{{ strlen($size->name) > 2 ? $size->name : trans('general.size')  }}"
                           data-tposition="top">
                            <h6 style="color : lightgrey; padding-top: 5px">{{ strtoupper(substr($size->name,0,2)) }}</h6>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @elseif($element->show_attribute)
        @if($element->color)
            <div class="tt-option-block">
                <ul class="tt-options-swatch">
                    <li><a class="options-color" style="background-color: {{ $element->color->code }};"
                           href="{{ route('frontend.product.show.name', ['id' => $element->id, 'name' => $element->name]) }}"></a>
                    </li>
                </ul>
            </div>
        @endif
        @if($element->size)
            <div class="tt-option-block">
                <ul class="tt-options-swatch js-change-img">
                    <li>
                        <a href="{{ route('frontend.product.show.name', ['id' => $element->id, 'name' => $element->name]) }}"
                           class="options-color-img"
                           data-src="images/product/product-03-05.jpg"
                           data-src-hover="images/product/product-03-05-hover.jpg"
                           data-tooltip="{{ strlen($element->size->name) > 2 ? $element->size->name : trans('general.size')  }}"
                           data-tposition="top">
                            <h6 style="color : lightgrey; padding-top: 5px">{{ strtoupper(substr($element->size->name,0,2)) }}</h6>
                        </a>
                    </li>
                </ul>
            </div>
        @endif
    @endif
</div>

