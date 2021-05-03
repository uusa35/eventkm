@extends('frontend.wokiee.four.layouts.app')

@section('breadcrumbs')
{{--    {{ Breadcrumbs::render('frontend.cart.show',1) }}--}}
@endsection

@section('body')
    <div class="container">
        <h1 class="tt-title-subpages noborder">{{ trans('general.shopping_cart') }}</h1>
        @include('frontend.wokiee.four.partials._cart_items_table')
        @if($elements->isNotEmpty())
            <div class="tt-shopcart-col">
                <div class="row">
                    @include('frontend.wokiee.four.partials._cart_order_user_info_confirmation')
                </div>
            </div>
        @endif
    </div>
@endsection
