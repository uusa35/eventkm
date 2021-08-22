<div class="tt-description text-center">
    <div class="tt-row">
        <ul class="tt-add-info">
            <li>
                <a href="{{ route('frontend.category.show',$element->id) }}" style="font-size: medium; font-weight: bolder;">{{ str_limit($element->name,60,'..') }}</a>
            </li>
        </ul>
        {{--@include('frontend.wokiee.four.partials._rating')--}}
    </div>
    @if($element->caption && !env('EVENTKM'))
        <h2 class="tt-title">
            <a href="{{ route('frontend.category.show',$element->id) }}">{{ str_limit($element->caption,35,'..') }}</a>
        </h2>
    @endif
    {{--    @include('frontend.wokiee.four.partials._widget_price_and_color')--}}
    <div class="tt-product-inside-hover text-center">

        <div class="tt-row-btn">
            @if(isset($isUsers) && $isUsers)
                <a href="{{ route('frontend.service.search', ['user_id' => $element->id]) }}"
                   class="btn btn-small">{{ trans('general.view_services') }}</a>
            @elseif(!env('EVENTKM'))
                <a href="{{ route('frontend.service.search', ['service_category_id' => $element->id]) }}"
                   class="btn btn-small">{{ trans('general.view_companies') }}</a>
{{--                <a href="{{ route('frontend.category.show', $element->id) }}"--}}
{{--                   class="btn btn-small">{{ trans('general.view_companies') }}</a>--}}
            @endif
        </div>
        <div class="tt-row-btn">
            {{--            @include('frontend.wokiee.four.partials._quick_view_product_btn')--}}
            {{--            @auth--}}
            {{--                <a href="#" class="tt-btn-wishlist"></a>--}}
            {{--            @endauth--}}
            {{--<a href="#" class="tt-btn-compare"></a>--}}
        </div>
    </div>
</div>
