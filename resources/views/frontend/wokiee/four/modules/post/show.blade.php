@extends('frontend.wokiee.four.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('frontend.post.show',$element) }}
@endsection

@section('title')
    <title>{{ $element->name }}</title>
    <meta name="title" content="{{ $element->name .' '. $element->description }}">
    @if(\Str::contains(Route::getCurrentRoute()->getName(), ['product','service']))
        @if($settings->facebook)
            <meta itemProp="facebook" content="{{ $settings->facebook }}"/>
            <meta property="facebook:card" content="{{ $element->imageThumbLink }}">
            <meta property="facebook:url" content="{{ url()->current() }}">
            <meta property="facebook:title" content="{{ $element->company }}">
            <meta property="facebook:description" content="{{ $element->description }}">
            <meta property="facebook:image" content="{{ $element->imageThumbLink }}">
        @endif
        @if($settings->twitter)
            <meta itemProp="twitter" content="{{ $settings->twitter }}"/>
            <meta property="twitter:card" content="{{ $element->imageThumbLink }}">
            <meta property="twitter:url" content="{{ url()->current() }}">
            <meta property="twitter:title" content="{{ $element->name }}">
            <meta property="twitter:description" content="{{ $element->description }}">
            <meta property="twitter:image" content="{{ $element->imageThumbLink }}">
        @endif
        @if($settings->instagram)
            <meta itemProp="instagram" content="{{ $settings->instagram }}"/>
            <meta property="instagram:card" content="{{ $element->imageThumbLink }}">
            <meta property="instagram:url" content="{{ url()->current() }}">
            <meta property="instagram:title" content="{{ $element->name }}">
            <meta property="instagram:description" content="{{ $element->description }}">
            <meta property="instagram:image" content="{{ $element->imageThumbLink }}">
        @endif
    @endif
@show

@section('body')

    <div class="container-indent">
        <div class="container container-fluid-custom-mobile-padding">
            <div class="row justify-content-center">
                <div class="col-xs-12 col-md-10 col-lg-8 col-md-auto">
                    <div class="tt-post-single">
                        {{--                        <div class="tt-tag"><a href="#">FASHION</a></div>--}}
                        <h1 class="tt-title">
                            {{ $element->title }}
                        </h1>
                        <div class="tt-autor">{{ trans('general.by') }}
                            <span>{{ $element->user->name }}</span> {{ $element->created_at->diffForHumans() }}</div>
                        <div class="tt-post-content">
                            <!-- slider -->
                            <div class="tt-slider-blog-single slick-animated-show-js">
                                <div><img src="{{ $element->imageLargeLink }}" alt="{{ $element->title }}"></div>
                                @if($element->images->isNotEmpty())
                                    @foreach($element->images as $img)
                                        @if($img->image)
                                            <div><img src="{{ $img->imageLargeLink }}" alt="{{ $element->title }}">
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <div class="tt-slick-row">
                                <div class="item">
                                    <div class="tt-slick-quantity">
                                        <span class="account-number"> <i class="icon-g-89"></i> {{ $element->views }}</span>
                                    </div>
                                </div>
                                <div class="item d-none">
                                    <div class="tt-slick-button">
                                        <button type="button" class="slick-arrow slick-prev">Previous</button>
                                        <button type="button" class="slick-arrow slick-next">Next</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /slider -->
                            <h2 class="tt-title text-left">{{ $element->title }}</h2>
                            <p class="text-left">
                                {!! $element->content !!}
                            </p>
                        </div>
                        <div class="post-meta d-none">
							<span class="item hidden">
								<span>Tag:</span> <span><a href="#">FASHION</a></span>, <span><a
                                            href="#">STYLE</a></span>
							</span>
                        </div>
                    </div>
                </div>
            </div>
            @desktop
            <div class="sharethis-inline-share-buttons"></div>
            @enddesktop
        </div>
    </div>
    @include('frontend.wokiee.four.partials._show_page_social_icons')
@endsection

@section('scripts')
    @parent
    @desktop
    <script type="text/javascript"
            src="https://platform-api.sharethis.com/js/sharethis.js#property=5c6ed2597056550011c4ab2a&product=inline-share-buttons"></script>
    @enddesktop
@endsection

