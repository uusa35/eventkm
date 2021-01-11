<span class="tt-img">
        <img class="" src="{{ $element->imageLargeLink }}" alt="{{ $element->description }}">
</span>
@if($element->images->isNotEmpty())
    <span class="tt-img-roll-over">
        <img class="" src="{{ $element->images->first()->imageLargeLink }}" alt="{{ $element->description }}">
</span>
@endif
<span class="tt-label-location d-none d-md-block">
{{--    @if($element->on_new)--}}
{{--        <span class="tt-label-new">{{ trans('general.new') }}</span>--}}
{{--    @endif--}}
    @if($element->exclusive)
        <span class="tt-label-our-stock pull-right">{{ trans('general.exclusive') }}</span>
    @endif
    @if($element->isOnSale)
        <span class="tt-label-new pull-right">{{ trans('general.on_sale') }}</span>
    @endif
{{--    @if($element->is_available)--}}
{{--        <span class="tt-label-new"--}}
{{--              style="background-color: #978d2f;">{{ trans('general.available_for_booking') }}</span>--}}
{{--    @else--}}
{{--        <span class="tt-label-new"--}}
{{--              style="background-color: #972500;">{{ trans('general.not_available_for_booking') }}</span>--}}
{{--    @endif--}}
{{--    @if($element->is_featured)--}}
{{--        <span class="tt-label-our-fatured">{{ trans('general.featured') }}</span>--}}
{{--    @endif--}}
{{--    @if($element->user)--}}
{{--        <span class="tt-label-new">{{ $element->user->country->slug }}</span>--}}
{{--    @endif--}}
    @if(!$element->hasStock)
        <span class="tt-label-sale pull-right">{{ trans('general.out_of_stock') }}</span>
    @endif
</span>
