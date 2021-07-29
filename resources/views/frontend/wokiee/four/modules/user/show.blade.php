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
                    <div class="col-lg-12 mb-5 mt-4">
                        @include('frontend.wokiee.four.partials._user_show_information')
                    </div>
                    {{--                <div class="col-md-4 col-lg-3 col-xl-3 leftColumn aside desctop-no-sidebar">--}}
                    @if(env('DESIGNERAAT') || env('EVENTKM') || env('ISTORES') || env('EXPO'))
                        <div class="col-lg-12 mt-5">
                            @if($products->isNotEmpty())
                                @include('frontend.wokiee.four.partials._products_slider',['elements' => $products,'title' => trans('general.products')])
                            @endif
                            @if($services->isNotEmpty())
                                @include('frontend.wokiee.four.partials._services_slider',['elements' => $services,'title' => trans('general.services')])
                            @endif
                        </div>
                        @if($element->branches->where('active', true )->isNotEmpty())
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6 class="text-center">{{ trans('general.branches') }}</h6>
                                </div>
                                @foreach($element->branches->where('active', true) as $branch)
                                    <div class="col-lg-4 mb-3">
                                        <div class="col-lg-12 mb-2">
                                            <td class="td-fixed-element td-sm"><i
                                                    class="fa-dot-circle-o fa fa-fw fa-lg"></i><span
                                                    class="ml-1"></span><span>{{ trans('general.name') }} : </span>
                                                <span class="ml-2"></span></td>
                                            <td>
                                                {{ $branch->name }}
                                            </td>
                                        </div>
                                        @if($branch->address)
                                            <div class="col-lg-12 mb-2">
                                                <td class="td-fixed-element td-sm"><i
                                                        class="fa-map-o fa fa-fw fa-lg"></i><span
                                                        class="ml-1"></span><span>{{ trans('general.address') }} : </span>
                                                    <span class="ml-2"></span></td>
                                                <td>
                                                    <a
                                                        target="_blank"
                                                        href="https://www.google.com/maps/search/?api=1&query={{ $branch->latitude  }},{{ $branch->longitude }}">
                                                        {{ str_limit($branch->address,30,'') }}
                                                    </a>
                                                </td>
                                            </div>
                                        @endif
                                        @if($branch->phone)
                                            <div class="col-lg-12 mb-2">
                                                <td class="td-fixed-element td-sm"><i
                                                        class="fa-dot-circle-o fa fa-fw fa-lg"></i><span
                                                        class="ml-1"></span><span>{{ trans('general.phone') }} : </span>
                                                    <span class="ml-2"></span></td>
                                                <td>
                                                    {{ $branch->phone }}
                                                </td>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endif
                    @if(env('MALLR') || env('DAILY'))
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
                            @elseif($element->isCompany && $services->isNotEmpty())
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
