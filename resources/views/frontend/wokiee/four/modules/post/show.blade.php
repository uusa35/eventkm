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
                                        <span class="account-number"> <i
                                                class="icon-g-89"></i> {{ $element->views }}</span>
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
    {{--    Comments--}}
    <div class="container-indent">
        <div class="container container-fluid-custom-mobile-padding">
            <div class="row justify-content-center">
                <div class="col-xs-12 col-md-10 col-lg-8 col-md-auto">
                    <h6 class="tt-title-border">({!! $element->comments->count() !!}
                        ) {{ trans('general.comments') }}</h6>
                    <div class="tt-comments-layout">
                        @foreach($comments as $comment)
                            <div class="tt-item" >
                                <div class="tt-comments-level-1" >
                                    <div class="tt-avatar"><img
                                            src="{{ $comment->owner->imageThumbLink ? $comment->owner->imageThumbLink : "https://ui-avatars.com/api/name=". $comment->owner->name ."&background=0D8ABC&color=fff" }}"
                                            alt="{{ $comment->owner->name }}"></div>
                                    <div class="tt-content" style="width: 100%">
                                        <div class="tt-comments-title">
                                            <span
                                                class="username">{{ trans('general.by') }} <span>{{ $comment->owner->name }}</span></span>
                                            <span class="time">{{ $comment->created_at->format('Y-m-d h:i A') }}</span>
                                        </div>
                                        <p>
                                            {!! $comment->content !!}
                                        </p>
                                        @if(auth()->check() && auth()->id() === $comment->user_id)
                                            <form method="post" action="{{ route('frontend.comment.destroy', $comment->id) }}">
                                                @csrf
                                                @method('delete')
                                                <button  type="submit"
                                                         style="background-color: transparent; border: none"
                                                   class="tt-btn pull-left"><i style="color: red" class="fa fa-times-rectangle-o fa-fw"></i></button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    replay form--}}
    <div class="container-indent">
        <div class="container container-fluid-custom-mobile-padding">
            <div class="row justify-content-center">
                <div class="col-xs-12 col-md-10 col-lg-8 col-md-auto">
                    <div class="form-single-post">
                        <h6 class="tt-title-border">
                            {{ $comments->render('pagination::bootstrap-4') }}
                        </h6>
                        <h6 class="tt-title-border">{{ trans('general.leave_a_reply') }}</h6>
                        <div class="form-default">
                            <form method="post" action="{{ route('frontend.comment.store') }}">
                                @csrf
                                <input type="hidden" name="commentable_id" value="{{ $element->id }}">
                                <input type="hidden" name="commentable_type" value="post">
                                <div class="form-group">
                                    <label for="inputName" class="control-label">{{ trans('general.title') }} *</label>
                                    <input type="text" class="form-control" name="title"
                                           placeholder="{{ trans('general.title') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="textarea" class="control-label">{{ trans('general.ur_comment') }}
                                        *</label>
                                    <textarea class="form-control" name="content" id="textarea"
                                              placeholder="{{ trans('general.write_a_comment') }}" rows="8"
                                              required></textarea>
                                </div>
                                @auth
                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                    <div class="form-group">
                                        <button type="submit"
                                                class="btn">{{ trans('general.post_ur_comment') }}</button>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <a href="{{ route('register') }}">{{ trans('general.register') }}</a>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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

