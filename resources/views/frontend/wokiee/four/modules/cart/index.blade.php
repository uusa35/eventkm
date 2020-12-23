@extends('frontend.wokiee.four.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('frontend.cart.index') }}
@endsection

@section('body')
    <div class="container">
        <h1 class="tt-title-subpages noborder">{{ trans('general.shopping_cart') }}</h1>
        @if($elements->isNotEmpty())
            @include('frontend.wokiee.four.partials._cart_items_table')
            <div class="tt-shopcart-col">
                <div class="row">
                    @if(in_array('product',$elements->pluck('options.type')->toArray()))
                        @guest
                            <div class="col-12">
                                <div class="alert alert-info alert-block">
                                    <div class="row" style="padding-top: 10px;">
                                        <div class="col-lg-1">
                                            <h6>
                                                <i class="fa fa-2x fa-exclamation-triangle fa-fw"></i>
                                            </h6>
                                        </div>
                                        <div class="col-lg-11">
                                            <h6>
                                                <a href="{{ route('register') }}" class="align-content-center">
                                                    {{ trans('message.change_address_for_destination') }}
                                                </a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endguest
                    @endif
{{--                    @if(!session()->has('coupon'))--}}
                        <div class="col-md-12 col-lg-12">
                            <div class="tt-shopcart-box">
                                <h4 class="tt-title">
                                    {{ trans('general.add_your_coupon') }}
                                </h4>
                                <p>{{ trans('message.have_a_coupon') }}</p>
                                <form class="form-default" method="post" action="{{ route('frontend.cart.coupon') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="address_zip">{{ trans('general.have_a_coupon') }}<sup></sup></label>
                                        <input type="text" name="code" class="form-control" id="code"
                                               placeholder="{{ trans('general.have_a_coupon') }}" required>
                                    </div>
                                    <button type="submit"
                                            class="btn btn-border">{{ trans('general.apply_coupon') }}</button>
                                </form>
                            </div>
                        </div>
                    {{--@endif--}}
                    {{--<div class="col-md-6 col-lg-4">--}}
                    {{--<div class="tt-shopcart-box">--}}
                    {{--<h4 class="tt-title">--}}
                    {{--NOTE--}}
                    {{--</h4>--}}
                    {{--<p>Add special instructions for your order...</p>--}}
                    {{--<form class="form-default">--}}
                    {{--<textarea class="form-control" rows="7"></textarea>--}}
                    {{--</form>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    @include('frontend.wokiee.four.partials._cart_order_user_info')
                </div>
            </div>
        @endif
    </div>
@endsection
