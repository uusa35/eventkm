<div class="tt-wrapper">
    <div class="tt-label">
        @if($element->exclusive)
            <div class="tt-label tt-label-out-stock" style="padding: 5px;">{{ trans('general.exclusive') }}</div>
        @endif
        @if($element->on_new)
            <div class="tt-label tt-label-new" style="padding: 5px;">{{ trans('general.new') }}</div>
        @endif
        @if($element->isOnSale)
            <div class="tt-label tt-label-sale" style="padding: 5px;">{{ trans('general.on_sale') }}</div>
        @endif
        @if($element->hasStock)
            <span class="tt-label tt-label-new"
                  style="background-color: #978d2f; padding: 5px;">{{ trans('general.available') }}</span>
        @else
            <span class="tt-label tt-label-sale" style="padding: 5px;">{{ trans('general.out_of_stock') }}XX</span>
        @endif
        @if($element->is_featured)
            <div class="tt-label tt-label-our-fatured" style="padding: 5px;">{{ trans('general.featured') }}</div>
        @endif
        {{--        @if($element->user->country)--}}
        {{--            <div class="tt-label tt-label-new">{{ $element->user->country->slug }}</div>--}}
        {{--        @endif--}}
    </div>
</div>
