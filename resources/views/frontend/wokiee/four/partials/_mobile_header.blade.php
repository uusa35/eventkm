<!-- tt-mobile-header -->
<div class="tt-mobile-header">
    <div class="container-fluid">
        <div class="header-tel-info">
            {{--<i class="icon-f-93"></i> 777 2345 7885; +777 2345 7886--}}
            @mobile
            @include('frontend.wokiee.four.partials._search_form')
            @endmobile
        </div>
    </div>
    <div class="container-fluid tt-top-line">
        <div class="tt-header-row">
            <div class="tt-mobile-parent-menu">
                <div class="tt-menu-toggle stylization-02">
                    <i class="icon-03"></i>
                </div>
            </div>
        {{--<div class="tt-mobile-parent-menu-categories tt-parent-box">--}}
        {{--<button class="tt-categories-toggle">--}}
        {{--<i class="icon-categories"></i>--}}
        {{--</button>--}}
        {{--</div>--}}
        <!-- search -->
        {{--<div class="tt-mobile-parent-search tt-parent-box"></div>--}}
        <!-- /search -->
            <!-- cart -->
            <div class="tt-mobile-parent-cart tt-parent-box"></div>
            <!-- /cart -->
            <!-- account -->
            <div class="tt-mobile-parent-account tt-parent-box"></div>
            <a href="{{ route('frontend.language.change',['locale' => 'en']) }}">
                <img class="img-responsive img-xs" src="{{ asset('images/flags/us.png') }}"
                     style="opacity: 0.7"/></a>
            <!-- /account -->
            <!-- currency -->
            <div class="tt-mobile-parent-multi tt-parent-box"></div>
            <!-- /currency -->
        </div>
    </div>
    <div class="container-fluid tt-top-line">
        <div class="row">
            <div class="tt-logo-container">
                <!-- mobile logo -->
                <a class="tt-logo tt-logo-alignment" href="{{ route('frontend.home') }}">
                    <img class="text-center" src="{{ $settings->logoThumb }}" alt="{{ $settings->description }}">
                </a>
                <!-- /mobile logo -->
            </div>
        </div>
    </div>
</div>
<!-- tt-desktop-header -->
