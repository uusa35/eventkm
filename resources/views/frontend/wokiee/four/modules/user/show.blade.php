@extends('frontend.wokiee.four.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('frontend.user.show',$element) }}
@endsection

@section('scripts')
    @parent
    <script type="text"
            src="https://platform-api.sharethis.com/js/sharethis.js#property=5c6ed2597056550011c4ab2a&product=inline-share-buttons"></script>
@endsection


@section('body')
    <div class="container-indent nomargin">
        @include('frontend.wokiee.four.partials._user_show_header')

        <div class="container-indent">
            <div class="container container-fluid-custom-mobile-padding">
                <div class="container">
                    @if(!env('DESIGNERAAT'))
                        <div class="col-lg-12 mb-5 mt-4">
                            @include('frontend.wokiee.four.partials._user_show_information')
                        </div>
                    @endif
                    {{--                <div class="col-md-4 col-lg-3 col-xl-3 leftColumn aside desctop-no-sidebar">--}}
                    @if(env('DESIGNERAAT') || env('EVENTKM') || env('ISTORES'))
                        <div class="col-lg-12 mt-5">
                            @include('frontend.wokiee.four.partials._products_slider',['elements' => $products,'title' => trans('general.products')])
                            @include('frontend.wokiee.four.partials._services_slider',['elements' => $services,'title' => trans('general.services')])
                        </div>
                    @endif
                    @if(ENV('MALLR') || ENV('DAILY'))
                        <div class="col-lg-12" style="padding-top: 20px;">
                            @if(env('MALLR') && isset($element) && $element->isDesigner && isset($collections))
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="text-lg-center">{{ trans('general.collections') }}</h4>
                                    </div>
                                    @foreach($collections as $collection)
                                        <div class="col-lg-3 col-sm-12">
                                            @include('frontend.wokiee.four.partials._collection_widget_cover',['element' => $collection,'title' => trans('general.personal_shopper')])
                                        </div>
                                    @endforeach
                                </div>
                            @elseif($element->isCompany)
                                <div class="row">
                                    @include('frontend.wokiee.four.partials._product_and_services_search_widget',['services' => isset($services) ? $services : null,'products' => isset($products) ? $products : null])
                                </div>
                            @endif
                            @if($element->images->isNotEmpty())
                                <div class="row" style="margin-top: 100px;">
                                    <div class="col-lg-12">
                                        @if(isset($element))
                                            <div class="col-12">
                                                <h4 class="text-lg-center mb-5">
                                                    {{ trans('general.gallery') }}
                                                </h4>
                                            </div>
                                            @include("frontend.wokiee.four.partials._gallery",['element' => $element->images])
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @if(isset($collections) && $collections->isNotEmpty())
                                <div class="text-center tt_product_showmore">
                                    <div class="col-lg-12">
                                        {{ $collections->withPath(request()->getUri())->links() }}
                                        @include('frontend.wokiee.four.partials._pagination',['elements' => $collections])
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
                {{--                </div>--}}
                <div class="sharethis-inline-share-buttons"></div>
            </div>
@endsection
