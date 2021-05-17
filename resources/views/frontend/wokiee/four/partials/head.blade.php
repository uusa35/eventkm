@section('title')
    <title>{{ $settings->company_ar .' '. $settings->company_en }}</title>
    <meta name="title" content="{{ $settings->company_ar .' '. $settings->company_en }}">
    @show
<!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
    <meta http-equiv="Content-type" charset="utf-8" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="{{ config('app.name') }}" content="E-commerce">
    <meta name="theme-color" content="{{ $settings->main_theme_color }}">
    <meta name="keywords" content="{{ trans('general.app_keywords') }}"/>
    <meta name="author" content="{{ $settings->company_ar }}">
    <meta name="country" content="{{ $settings->country }}">
    <meta name="mobile" content="{{ $settings->mobile }}">
    <meta name="phone" content="{{ $settings->phone }}">
    <meta name="logo" content="{{ $settings->logoThumb }}">
    <meta name="email" content="{{ $settings->email }}">
    <meta name="address" content="{{ $settings->address }}">
    <meta name="name" content="{{ $settings->company }}">
    <meta name="lang" content="{{ app()->getLocale() }}">
    <meta name="description" content="{{ $settings->company . ' '.  $settings->description }}"/>
    <input type="hidden" value="{{ app()->getLocale() }}" id="appLang"/>
    <meta itemProp="name" content="{{ $settings->company }}"/>
    <meta itemProp="description" content="{{ $settings->company . ' '.  $settings->description }}"/>
    <meta itemProp="image" content="{{ $settings->logoThumb }}"/>
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $settings->comapny_ar . ' '. $settings->company_en }}">
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:title" content="{{ $settings->comapny_ar . ' '. $settings->company_en }}">
    <meta property="og:description" content="{{ $settings->description }}">
    <meta property="og:image" content="{{ $settings->logoThumb }}">
    @if($settings->whatsapp)
        <meta itemProp="whatsapp" content="{{ $settings->whatsapp }}"/>
    @endif
    @if($settings->android)
        <meta itemProp="android" content="{{ $settings->android }}"/>
    @endif
    <meta itemProp="apple" content="{{ $settings->apple }}"/>
    @if(Route::getCurrentRoute() && !\Str::contains(Route::getCurrentRoute()->getName(), ['product','service']))
        @if($settings->facebook)
            <meta itemProp="facebook" content="{{ $settings->facebook }}"/>
            <meta itemProp="facebook" content="{{ $settings->facebook }}"/>
            <meta property="facebook:card" content="{{ $settings->logoThumb }}">
            <meta property="facebook:url" content="{{ $settings->facebook }}">
            <meta property="facebook:title" content="{{ $settings->company }}">
            <meta property="facebook:description" content="{{ $settings->description }}">
            <meta property="facebook:image" content="{{ $settings->logoThumb }}">
        @endif
        @if($settings->twitter)
            <meta itemProp="twitter" content="{{ $settings->twitter }}"/>
            <meta property="twitter:card" content="{{ $settings->logoThumb }}">
            <meta property="twitter:url" content="{{ $settings->twitter }}">
            <meta property="twitter:title" content="{{ $settings->company }}">
            <meta property="twitter:description" content="{{ $settings->description }}">
            <meta property="twitter:image" content="{{ $settings->logoThumb }}">
        @endif
    @endif
    @if($settings->latitude)
        <meta itemProp="latitude" content="{{ $settings->latitude }}"/>
    @endif
    @if($settings->longitude)
        <meta itemProp="longitude" content="{{ $settings->longitude }}"/>
    @endif

    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="{{ $settings->logo ? $settings->getCurrentImageAttribute('logo') : $settings->getCurrentImageAttribute('app_logo') }}"/>
{{--    <link--}}
{{--        href="{{ $settings->logo ? $settings->getCurrentImageAttribute('logo') : $settings->getCurrentImageAttribute('app_logo') }}"--}}
{{--        rel="shortcut icon" type="image/jpg"/>--}}
    <link rel="shortcut icon" href="{{ asset('images/logo.ico') }}"/>
    <link href="{{ $settings->logoThumb }}" rel="shortcut icon" type="image/png">
    @if(env('ESCRAP'))
        <meta name="google-site-verification" content="SR81NY4elhoRSNXOc1cHIIpu80aTPeiDiipsk4CMvRo"/>
    @elseif(env('EVENTKM'))
        <meta name="google-site-verification" content="zf7iPSnuJgFO519GO36uRJRgzZGHJCN0oAOjwm3fORk"/>
    @elseif(env('ABATI'))
        <meta name="google-site-verification" content="fy3pTvV0z024nR79nukGxw-tnOmJ2F5BnMeayo-g4-c"/>
    @elseif(env('MALLR'))
        <meta name="google-site-verification" content="jr-GtLYg64G51nUppCuaH_p0C4NkAcofU5bPIkI9jG0"/>
    @endif
    {{--@if(env('ONE_SIGNAL_APP_ID'))--}}
    {{--    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>--}}
    {{--    <script>--}}
    {{--        var OneSignal = window.OneSignal || [];--}}
    {{--        OneSignal.push(function() {--}}
    {{--            OneSignal.init({--}}
    {{--                appId: `{!! env('ONE_SIGNAL_APP_ID') !!}`,--}}
    {{--            });--}}
    {{--        });--}}
    {{--    </script>--}}
    {{--@endif--}}
