@extends('frontend.wokiee.four.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('frontend.product.index') }}
@endsection

@section('body')
    <div class="container-indent nomargin">
        {{--<div class="container-fluid-custom container-fluid-custom-mobile-padding">--}}
        <div class="container-indent">
            {{--<div class="container container-fluid-custom-mobile-padding">--}}
            <div class="container">
                <div class="row" style="padding-top: 20px;">
                    {{--<div class="col-md-4 col-lg-3 col-xl-3 leftColumn aside desctop-no-sidebar">--}}
                    @if(!env('EVENTKM'))
                        <div class="col-md-4 col-lg-3 col-xl-3 leftColumn aside">
                            @include('frontend.wokiee.four.partials._search_side_bar',['products' => $elements])
                        </div>
                    @endif
                    <div class="col-md-9">
                        <div class="content-indent">
                            </br>
                            @if(!env('EVENTKM'))
                                @include('frontend.wokiee.four.partials._search_sort_by')
                            @endif
                            <div class="tt-product-listing row">
                                @include('frontend.wokiee.four.partials._products_user_show',['products' => $elements])
                            </div>
                            <div class="text-center tt_product_showmore">
                                <div class="col-lg-12">
                                    @include('frontend.wokiee.four.partials._pagination',['elements' => $elements])
                                </div>
                                {{--<a href="#" class="btn btn-border">LOAD MORE</a>--}}
                                {{--<div class="tt_item_all_js">--}}
                                {{--<a href="#" class="btn btn-border01">NO MORE ITEM TO SHOW</a>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--</div>--}}
        {{--</div>--}}
    </div>
@endsection
