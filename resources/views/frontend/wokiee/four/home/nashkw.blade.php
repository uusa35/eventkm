@extends('frontend.wokiee.four.layouts.app')

@section('body')
    @include('frontend.wokiee.four.partials.slider')
    @include('frontend.wokiee.four.partials._home_grid_main_categories')
{{--    @include('frontend.wokiee.four.partials._all_brands', ['elements' => $brands])--}}
{{--                            @include('frontend.wokiee.four.partials._products_metro_collection',['element' => $bestSaleCollections->first(), 'title' => trans('general.our_selection_from_collections')])--}}
{{--                @include('frontend.wokiee.four.partials._products_slider_collections',['elements' => $bestSaleCollections, 'title' => trans('general.our_selection_from_collections'), 'items' => 2])--}}
    @include('frontend.wokiee.four.partials._collection_slider_with_cover',['title' => trans('general.our_selection_from_collections'), 'elements' => $bestSaleCollections])
    @include('frontend.wokiee.four.partials._users_slider',['title' => trans('general.our_personal_shoppers'), 'elements' => $designers])
    @include('frontend.wokiee.four.partials._users_slider',['title' => trans('general.some_companies'), 'elements' => $companies])
    @include('frontend.wokiee.four.partials._products_slider',['title' => trans('general.new_arrivals'), 'elements' => $newProducts])
    @include('frontend.wokiee.four.partials._products_slider',['title' => trans('general.on_sale_products'), 'elements' => $onSaleProducts])
    {{--        @if(isset($categoriesHome) && $categoriesHome->isNotEmpty())--}}
    {{--            @include('frontend.wokiee.four.partials._five_categories',['elements' => $categoriesHome])--}}
    {{--        @endif--}}
    {{--        @if(isset($tripleCommercials) && $tripleCommercials->isNotEmpty())--}}
    {{--            @include('frontend.wokiee.four.partials._horizontal_three_categories',['elements' => $tripleCommercials])--}}
    {{--        @endif--}}
    @include('frontend.wokiee.four.partials._products_slider_hot_deal', ['elements' => $productHotDeals,'items' => 3])
{{--    @include('frontend.wokiee.four.partials._btn_info')--}}
    @include('frontend.wokiee.four.partials._country_modal')
@endsection
