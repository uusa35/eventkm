<div class="tt-description text-center">
    @if(env('SHOW_COMPANY'))
        <div class="tt-row">
            <ul class="tt-add-info">
                <li>
                    <a href="{{ route('frontend.product.search',['user_id' => $element->user_id]) }}">{{ str_limit($element->user->slug,15,'..') }}</a>
                </li>
                {{--            @if($element->brand)--}}
                {{--                <li>--}}
                {{--                    <a href="{{ route('frontend.product.search', ['brand_id' => $element->brand->id]) }}">{{ $element->brand->slug }}</a>--}}
                {{--                </li>--}}
                {{--            @endif--}}
            </ul>
            {{--@include('frontend.wokiee.four.partials._rating')--}}
        </div>
    @endif
    @if(!env('EVENTKM'))
        <h2 class="tt-title">
            <a href="{{ route('frontend.product.show.name',['id' => $element->id , 'name' => $element->name]) }}">{{ str_limit($element->name,15,'..') }}</a>
        </h2>
    @endif
    @include('frontend.wokiee.four.partials._widget_price_and_color')
    <div class="tt-product-inside-hover text-center">
        <div class="tt-row-btn">
            {{--            @if(isset($view) && $view)--}}
            <a href="{{ route('frontend.product.show.name',['id' => $element->id , 'name' => $element->name]) }}"
               class="btn btn-small mb-2">
                <i class="icon-g-89"></i>
                {{ trans('general.view_details') }}
            </a>
            {{--            @else--}}
            {{--                <a href="#"--}}
            {{--                   id="addToCartBtn"--}}
            {{--                   data-toggle="modal"--}}
            {{--                   data-id="{{ $element->id }}"--}}
            {{--                   data-target="#addToCart-{{ $element->id }}"--}}
            {{--                   class="btn btn-small mb-2">--}}
            {{--                    <i class="fa fa-fw fa-lg fa-eye"></i>--}}
            {{--                    {{ trans('general.view_details') }}--}}
            {{--                </a>--}}
            {{--            @endif--}}
        </div>
        {{--        @if(isset($collection) && !is_null($collection))--}}
        {{--            <div class="tt-row-btn">--}}
        {{--                <a href="{{ route('frontend.product.show.name',['id' => $element->id,'name'=> $element->name,'collection_id' => $collection_id]) }}"--}}
        {{--                   class="btn btn-small">--}}
        {{--                    {{ $collection_id }}--}}
        {{--                    <i class="fa fa-fw fa-lg icon-f-46"></i>--}}
        {{--                    {{ trans('general.add_collection_item_to_cart') }}--}}
        {{--                </a>--}}
        {{--            </div>--}}
        {{--        @else--}}
        {{--            <br>--}}
        {{--            <div class="tt-row-btn">--}}
        {{--                <a href="{{ route('frontend.product.show.name', ['id' => $element->id, 'name' => $element->name]) }}"--}}
        {{--                   class="btn btn-small">{{ trans('general.view_details') }}</a>--}}
        {{--            </div>--}}
        {{--        @endif--}}
        <div class="tt-row-btn">
            @include('frontend.wokiee.four.partials._quick_view_product_btn')
            @auth
                <a href="#" class="tt-btn-wishlist"></a>
            @endauth
            {{--<a href="#" class="tt-btn-compare"></a>--}}
        </div>
    </div>
</div>
