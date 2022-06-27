<div class="tt-color-scheme-01">
    <div class="container">
        <div class="tt-header-row tt-top-row">
            <div class="tt-col-left">
                <div class="tt-box-info">
                    <ul>
                        @if(auth()->user() && !env('EVENTKM'))
                            <li><a href="{{ route('register') }}">
                                    <i class="fa fa-fw fa-user"></i>
                                    {{ trans('general.register') }}</a></li>
                            <li><a href="{{ route('login') }}">
                                    <i class="fa fa-fw fa-lock"></i>
                                    {{ trans('general.login') }}</a></li>
                        @endguest
                        @if(env('ENABLE_LANG_SWITCH'))
                            @if(app()->isLocale('ar'))
                                <li>
                                    {{--                                <i class="fa fa-fw fa-language"></i>--}}
                                    <a href="{{ route('frontend.language.change',['locale' => 'en']) }}">
                                        <img class="img-responsive img-xs" src="{{ asset('images/flags/us.png') }}"
                                             style="opacity: 0.7"/>
                                        {{ trans('general.english') }}</a></li>
                            @else
                                <li>
                                    {{--                                <i class="fa fa-fw fa-language"></i>--}}
                                    <a href="{{ route('frontend.language.change',['locale' => 'ar']) }}">
                                        <img class="img-responsive img-xs" src="{{ asset('images/flags/kw.png') }}"
                                             style="opacity: 0.7"/>
                                        {{ trans('general.arabic') }}</a></li>
                            @endif
                        @endif
                    </ul>
                </div>
            </div>
            @if($settings && !env('EVENTKM'))
                <div class="tt-col-right ml-auto">
                    <ul class="tt-social-icon">
                        @include('frontend.wokiee.four.partials._social_icons_home')
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- tt-mobile menu -->
