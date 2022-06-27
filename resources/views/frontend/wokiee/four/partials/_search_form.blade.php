@if(env('MALLR') || env('DAILY') || env('HTB') || env('NASHKW') || env('BITS') || env('EMAKEUP') || env('HUDA'))
    @include('frontend.wokiee.four.partials._search_menu_products')
@elseif(env('EVENTKM'))
{{--    @include('frontend.wokiee.four.partials._search_menu_services')--}}
@endif
