<div class="tt-wrapper">
    <div class="tt-title text-center">
        {{ $element->name }}
    </div>
    <div class="tt-price">
        @if($element->isOnSale)
            <span class="new-price" style="color : red">{{ $element->convertedSalePrice}}
                {{ $currency->symbol }}</span>
            <span class="old-price pull-left small">{{ $element->convertedPrice }}<span>{{ $currency->symbol }}</span></span>
        @else
            <span class="new-price">{{ $element->convertedPrice }}
                {{ $currency->symbol }}</span>
        @endif
    </div>
</div>
<div class="tt-wrapper">
    {{ $element->description }}
</div>
@if($element->barcode)
    <div class="col-lg-5 col-xs-12" style="margin-left: auto; margin-right: auto;">
        {!!DNS2D::getBarcodeHTML($element->barcode, env('BARCODE_TYPE'),2,1)!!}
    </div>
@endif
