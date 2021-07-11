@extends('frontend.wokiee.four.layouts.app')

@section('body')
    <div class="tt-coming-soon" style="background: white !important;">
        <div class="container">
            <div class="row	justify-content-center" style="margin : 2%">
                <div class="col-12 tt-coming-soon-content">
                    <a class="" href="{{ url('/') }}">
                        <img style="width: 150px; height: auto; max-height: 400px !important;"
                             src="{{ $settings->getCurrentImageAttribute('logo') }}" alt="">
                    </a>
                    <h1 class="tt-title"
                        style="margin-bottom: 20px; margin-top: 20px; line-height: 30px !important;">{{ $settings->company }}</h1>
                    <div class="description" style="margin-bottom: 50px; margin-top: 20px;">
                        {{ $settings->description }}
                    </div>
                </div>
            </div>
            <div class="row	justify-content-center" style="margin-top: 1%">
                <div class="col-12">
                    <div class="tt-collapse-content text-center">
                        @if($settings->apple)
                            <a href="{{ url($settings->apple) }}">
                                <img src="{{ asset('images/apple.png') }}" alt="{{ $settings->company }}"
                                     class="img-responsive" style="max-width: 200px; margin: 10px;">
                            </a>
                        @endif
                        @if($settings->android)

                            <a href="{{ url($settings->android) }}">
                                <img src="{{ asset('images/android.png') }}" alt="{{ $settings->company }}"
                                     class="img-responsive" style="max-width: 200px; margin: 10px;">
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row	justify-content-center" style="margin-top: 4%">
                <div class="col-lg-12">
                    @if(isset($element) && $element)
                        <p class="card-text text-danger"><h3 class="text-danger">{{ trans('message.not_installed') }}</h3></p>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><img src="{{ $element->getCurrentImageAttribute() }}"
                                                            class="img-responsive"
                                                            style="max-width: 300px;"
                                                            alt="{{ $element->slug }}"></h5>
                                <h5 class="card-title">{{ $element->slug ? $element->slug : $element->name }}</h5>
                                <p class="card-text">{{ $element->description }}</p>
                                </br>
                                @if(request()->has('type'))
                                    @if(env('EXPO') || env('ABATI'))
                                        @ios
                                        <div class="col-12">
                                            <a href="{{ env('APP_DEEP_LINK') }}{{ request()->type }}/{{ $element->id }}"
                                               class="btn btn-primary">{{ trans('general.view_company_on_app') }}</a>
                                        </div>
                                        @elseios
                                        <div class="col-12">
                                            <a href="{{ env('ANDROID_APP_DEEP_LINK') }}{{ request()->type }}/{{ $element->id }}"
                                               class="btn btn-primary">{{ trans('general.view_company_on_app') }}</a>
                                        </div>
                                        @endios
                                    @else
                                        <div class="col-12">
                                            <a href="{{ env('APP_DEEP_LINK') }}{{ request()->type }}/{{ $element->id }}"
                                               class="btn btn-primary">{{ trans('general.view_company_on_app') }}</a>
                                        </div>
                                    @endif
{{--                                    <div class="col-12">--}}
{{--                                        <a href="{{ env('APP_DEEP_LINK') }}{{ request()->type }}/{{ $element->id }}"--}}
{{--                                           class="btn btn-primary">{{ trans('general.view_company_on_app') }}</a>--}}
{{--                                    </div>--}}
                                @else
                                    <div class="col-12">
                                        <a href="{{ env('APP_DEEP_LINK') }}{{ strtolower(class_basename($element)) }}/{{ $element->id }}"
                                           class="btn btn-primary">{{ trans('general.view_company_on_app') }}</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                    @if(!isset($element))
                        @include("frontend.wokiee.four.partials._gallery",['element' => $settings->images])
                    @endif
                </div>

                <div class="col-12">
                    <div class="tt-collapse-content text-center">
                        <ul class="tt-social-icon row	justify-content-center" style="padding: 20px;">
                            @if($settings->facebook)
                                <li><a href="{{ $settings->facebook }}" target="blank"><i
                                                class="fa fa-fw fa-facebook"></i></a>
                                </li>
                            @endif
                            @if($settings->twitter)
                                <li><a href="{{ $settings->twitter }}" target="blank"><i
                                                class="fa fa-fw fa-twitter"></i></a>
                                </li>
                            @endif
                            @if($settings->instagram)
                                <li><a href="{{ $settings->instagram }}" target="blank"><i
                                                class="fa fa-fw fa-instagram"></i></a>
                                </li>
                            @endif
                            @if($settings->whatsapp)
                                <li>
                                    <a href="https://api.whatsapp.com/send?phone={{ $settings->whatsapp }}&text={{ env('APP_NAME') }}"
                                       target="blank"><i class="fa fa-fw fa-whatsapp"></i></a>
                                </li>
                            @endif
                            @if($settings->youtube)
                                <li><a href="{{ $settings->youtube }}" target="blank"><i
                                                class="fa fa-fw fa-youtube"></i></a>
                                </li>
                            @endif
                        </ul>
                        <ul class="tt-social-icon row	justify-content-center " style="padding: 20px;">
                            @foreach($pages as $page)
                                <li>
                                    <a style="color : black;"
                                       href="{{ $page->url ? $page->url : route('frontend.page.show.name',['id' => $page->id ,'name' => $page->title]) }}">{{ $page->title }}</a>
                                </li>
                            @endforeach
                            @if(env('ENABLE_BLOG'))
                                    <li>
                                        <a style="color : black;"
                                           href="{{ route('frontend.post.index') }}">{{ trans('general.blog') }}</a>
                                    </li>
                                @endif
                            @if(env('ENABLE_LANG_SWITCH'))
                                @if(app()->isLocale('en'))
                                    <li>
                                        <a style="color : black;"
                                           href="{{ route('frontend.language.change',['locale' => 'ar']) }}">{{ trans('general.arabic') }}</a>
                                    </li>
                                @else
                                    <li>
                                        <a style="color : black;"
                                           href="{{ route('frontend.language.change',['locale' => 'en']) }}">{{ trans('general.english') }}</a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                        <ul class="tt-social-icon row	justify-content-center" style="padding: 20px;">
                            @auth
                                @can('isAdminOrAbove')
                                    <li>
                                        <a style="color : black;" href="{{ route('backend.home') }}"><i
                                                    class="fa fa-fw fa-dashboard"></i>{{ trans('general.dashboard') }}
                                        </a>
                                    </li>
                                @endcan
                                <li>
                                    <a style="color : black;" href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <i class="fa fa-fw fa-sign-out"></i> {{ trans('general.logout') }} </a>
                                </li>
                            @else
                                <li>
                                    <a style="color : black;"
                                       href="{{ route('login') }}">{{ trans('general.login') }}</a>
                                </li>
                                <li>
                                    <a style="color : black;"
                                       href="{{ route('password.request') }}">{{ trans('general.forget_password') }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-12">
                        <p>
                            &copy; {{ trans("message.copy_right") }} - {{  $settings->company }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
