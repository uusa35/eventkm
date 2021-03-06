<a href="#" class="tt-btn-quickview" data-toggle="modal"
   data-target="#ModalquickView"
   data-tooltip="{{ trans('general.quick_view') }}"
   data-tposition="{{ app()->isLocale('ar') ? 'right' : 'left' }}"
   data-name="{{ $element->name }}"
   data-id="{{ $element->id }}"
   data-image="{{ $element->imageLargeLink }}"
   data-notes="{{ $element->notes }}"
   data-description="{{ $element->description }}"
   data-sku="{{ $element->sku }}"
   data-qty="{{ $element->availableQty }}"
   data-price="{{ $element->convertedFinalPrice }}"
   data-currency-name="{{ $currency->symbol }}"
   @if($element->has_attributes)
   @if($element->product_attributes->pluck('color')->isNotEmpty())
   data-colors="@foreach($element->product_attributes->pluck('color')->unique() as $col) {!! $col->name !!}, @endforeach"
   @endif
   @if($element->product_attributes->pluck('size')->isNotEmpty())
   data-sizes="@foreach($element->product_attributes->pluck('size')->unique() as $size) {!! $size->name !!}, @endforeach"
   @endif
   @else
   @if($element->color)
   data-colors="{!! $element->color->name !!}"
   @endif
   @if($element->size)
   data-sizes="{!! $element->size->name !!}"
   @endif
   @endif
   data-url="{{ route('frontend.product.show.name', ['id' => $element->id, 'name' => $element->name]) }}"
></a>
