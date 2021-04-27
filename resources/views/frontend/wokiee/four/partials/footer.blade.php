<footer>
    @if(!env('EVENTKM'))
        {{--<footer class="nomargin">--}}
        <div class="tt-footer-default tt-color-scheme-02">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-9">
                        {{--<div class="tt-newsletter-layout-01">--}}
                        {{--<div class="tt-newsletter">--}}
                        {{--<div class="tt-mobile-collapse">--}}
                        {{--<h4 class="tt-collapse-title">--}}
                        {{--BE IN TOUCH WITH US:--}}
                        {{--</h4>--}}
                        {{--<div class="tt-collapse-content">--}}
                        {{--<form id="newsletterform" class="form-inline form-default" method="post" novalidate="novalidate" action="#">--}}
                        {{--<div class="form-group">--}}
                        {{--<input type="text" name="email" class="form-control" placeholder="Enter your e-mail">--}}
                        {{--<button type="submit" class="btn">JOIN US</button>--}}
                        {{--</div>--}}
                        {{--</form>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </div>

                    <div class="col-md-auto">
                        <ul class="tt-social-icon">
                            @include('frontend.wokiee.four.partials._social_icons_home')
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="tt-footer-col ">
        <div class="container">
            <div class="row">
                @if($settings->apple || $settings->android)
                    <div class="col-md-6 col-lg-2 col-xl-3">
                        <div class="tt-mobile-collapse">
                            <h4 class="tt-collapse-title">
                                {{ trans('general.find_us_on_stores') }}
                            </h4>
                            <div class="tt-collapse-content text-center">
                                <ul class="tt-list">
                                    @if($settings->apple)
                                        <li>
                                            <a href="{{ url($settings->apple) }}">
                                                <img src="{{ asset('images/apple.png') }}"
                                                     alt="{{ $settings->company }}"
                                                     class="img-responsive" style="max-width: 150px;">
                                            </a>
                                        </li>
                                    @endif
                                    @if($settings->android)
                                        <li>
                                            <a href="{{ url($settings->android) }}">
                                                <img src="{{ asset('images/android.png') }}"
                                                     alt="{{ $settings->company }}"
                                                     class="img-responsive" style="max-width: 150px;">
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-md-6 col-lg-2 col-xl-3">
                    <div class="tt-mobile-collapse">
                        <h4 class="tt-collapse-title">
                            {{ trans('general.my_account') }}
                        </h4>
                        <div class="tt-collapse-content">
                            <ul class="tt-list">
                                @foreach($pages->where('on_footer', true) as $page)
                                    <li>
                                        <a href="{{ $page->url ? $page->url : route('frontend.page.show.name',['id' => $page->id ,'name' => $page->title]) }} }}">{{ $page->slug }}</a>
                                    </li>
                                @endforeach
                                @if($faqs->isNotEmpty())
                                    <li><a href="{{ route('frontend.faq.index') }}">{{ trans('general.faqs') }}</a></li>
                                @endif
                                @guest
                                    <li><a href="{{ route('register') }}">{{ trans('general.register') }}</a></li>
                                @endguest
                                @auth
                                    @if(!auth()->user()->isClient)
                                        <li><a href="{{ route('backend.home') }}">
                                                {{ trans('general.control_panel') }}
                                            </a>
                                        </li>
                                    @endif
                                    <li><a href="{{ route('frontend.order.index') }}">
                                            {{ trans('general.history_orders') }}
                                        </a>
                                    </li>
                                    @if(env('ENABLE_FAV'))
                                        <li><a href="{{ route('frontend.favorite.index') }}">
                                                {{ trans('general.wish_list') }}
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a href="{{ url('/logout') }}" class="dropdown-toggle"
                                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            {{ trans('general.sign_out') }}
                                        </a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </div>
                @if(trans()->has('message.footer_about_us'))
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="tt-mobile-collapse">
                            <h4 class="tt-collapse-title">
                                {{ trans("general.about_us") }}
                            </h4>
                            <div class="tt-collapse-content">
                                <p>
                                    {!! trans('message.footer_about_us')  !!}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="tt-newsletter">
                        <div class="tt-mobile-collapse">
                            <h4 class="tt-collapse-title">
                                {{ trans('general.contact_us_info') }}
                            </h4>
                            <div class="tt-collapse-content">
                                <address>
                                    @if($settings->address)
                                        <p><i class="fa fa-fw fa-map-marker"></i> {{ $settings->address }}</p>
                                    @endif
                                    @if($settings->phone)
                                        <p><i class="fa fa-fw fa-phone"></i> {{ $settings->phone }}</p>
                                    @endif
                                    @if($settings->mobile)
                                        <p><i class="fa fa-fw fa-mobile"></i> {{ $settings->mobile }}</p>
                                    @endif
                                    @if($settings->instagram && env('EVENTKM'))
                                        <p><i class="fa fa-fw fa-instagram"></i><a
                                                href="{{ $settings->instagram }}"> {{ $settings->company }}</a>
                                        </p>
                                    @endif
                                    @if($settings->whatsapp)
                                        <p><i class="fa fa-fw fa-whatsapp"></i> <a
                                                href="https://api.whatsapp.com/send?phone={{ $settings->whatsapp }}&text={{ env('APP_NAME') }}">{{ $settings->whatsapp }}</a>
                                        </p>
                                    @endif
                                    @if($settings->latitude && $settings->longitude)
                                        <p><i class="fa fa-fw fa-location-arrow"></i> <a
                                                href="https://www.google.com/maps/search/?api=1&query={{ $settings->latitude  }},{{ $settings->longitude }}">
                                                {{ trans('general.location') }}
                                            </a></p>
                                    @endif
                                    @if($settings->email)
                                        <p><span>{{ trans('general.mail') }}:</span> <a
                                                href="mailto:{{ $settings->email }}">{{ $settings->email }}</a>
                                        </p>
                                        <p>
                                            @endif
                                            @if(!str_contains(trans('message.duty_time_message'),'message.'))
                                                <span>{{ trans('general.duty_time') }}:</span> {!! trans('message.duty_time_message')  !!}
                                            @endif
                                        </p>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tt-footer-custom">
        <div class="container">
            <div class="tt-row">
                <div class="tt-col-left">
                    <div class="tt-col-item tt-logo-col">
                        <!-- logo -->
                        <a class="tt-logo tt-logo-alignment" href="{{ route('frontend.home') }}">
                            <img src="{{ $settings->logoLarge }}" alt="">
                        </a>
                        <!-- /logo -->
                    </div>
                    <div class="tt-col-item">
                        <!-- copyright -->
                        <div class="tt-box-copyright">
                            &copy; {!! trans("message.copy_right")  !!} - {{ $settings->company }}
                        </div>
                        <!-- /copyright -->
                    </div>
                </div>
                <div class="tt-col-right">
                    <div class="tt-col-item tt-logo-col">
                            <img src="{{ asset('images/knet-visa.png') }}" alt="" style="width: 200px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<a href="#" class="tt-back-to-top">{{ trans('general.back_to_top') }}</a>
@if($settings->whatsapp)
    <a href="https://api.whatsapp.com/send?phone={{ $settings->whatsapp }}&text={{ env('APP_NAME') }}"
       target="_blank"
       class="tt-bottom-left tt-btn-quickview"
       data-toggle="tooltip"
       data-tooltip="{{ trans('general.contactus') }}"
       style="position: fixed; bottom: 50px; {!! app()->getLocale() === 'ar' ? 'right' : 'left' !!}: 5px; background-color: {!! $settings->btn_bg_theme_color !!}; padding : 13px; border-radius: 5px"><i
            style="color : white" class="fa fa-fw fa-whatsapp fa-2x"></i></a>
@endif
