@extends('frontend.wokiee.four.layouts.app')

@section('body')
    @include('frontend.wokiee.four.partials.slider')
{{--    @include('frontend.wokiee.four.partials._products_slider',['title' => trans('general.new_arrivals'), 'elements' => $newProducts])--}}
{{--    @include('frontend.wokiee.four.partials._all_brands', ['elements' => $brands])--}}
{{--    @include('frontend.wokiee.four.partials._products_slider',['title' => trans('general.on_sale_products'), 'elements' => $onSaleProducts])--}}
    @include('frontend.wokiee.four.partials._users_slider',['title' => trans('general.celebrities'), 'elements' => $celebrities])
    @include('frontend.wokiee.four.partials._users_slider',['title' => trans('general.elites'), 'elements' => $elites])
    @include('frontend.wokiee.four.partials._users_slider',['title' => trans('general.designers'), 'elements' => $designers])

{{--            @if(isset($categoriesHome) && $categoriesHome->isNotEmpty())--}}
{{--                @include('frontend.wokiee.four.partials._five_categories',['elements' => $categoriesHome])--}}
{{--            @endif--}}
    {{--        @if(isset($tripleCommercials) && $tripleCommercials->isNotEmpty())--}}
    {{--            @include('frontend.wokiee.four.partials._horizontal_three_categories',['elements' => $tripleCommercials])--}}
    {{--        @endif--}}
{{--    @include('frontend.wokiee.four.partials._btn_info')--}}
    @include('frontend.wokiee.four.partials._country_modal')
@endsection
