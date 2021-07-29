@if(isset($sliders) && $sliders->isNotEmpty())
    <div class="container-indent nomargin">
        <div class="container-fluid">
            <div class="row">
                <div class="slider-revolution revolution-default">
                    <div class="tp-banner-container">
                        <div class="tp-banner revolution">
                            <ul>
                                @foreach($sliders as $s)
                                    {{--                                @if($s->is_video)--}}
                                    {{--                                    @include('frontend.wokiee.four.partials._video_slide',['s' => $s])--}}
                                    {{--                                @else--}}
                                    <li data-thumb="{{ $s->imgThumbLink }}" data-transition="fade"
                                        data-slotamount="1" data-masterspeed="1000" data-saveperformance="off"
                                        data-title="Slide">
                                        @if($s->is_video)
                                            <iframe width="100%" height="100%"
                                                    src="{{ $s->url }}"
                                                    title="YouTube video player" frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen></iframe>
                                        @else
                                            <img src="{{ $s->imageLargeLink }}" alt="{{ $s->title }}"
                                                 data-bgposition="top center" data-bgfit="cover"
                                                 data-bgrepeat="no-repeat">
                                        @endif
                                        <div class="tp-caption tp-caption1 lft stb"
                                             data-x="center"
                                             data-y="center"
                                             data-hoffset="0"
                                             data-voffset="0"
                                             data-speed="600"
                                             data-start="900"
                                             data-easing="Power4.easeOut"
                                             data-endeasing="Power4.easeIn">
                                            {{--                                        @if($s->title)--}}
                                            {{--                                            <div class="tp-caption1-wd-1 tt-base-color">{{ $s->title }}</div>--}}
                                            {{--                                        @endif--}}
                                            {{--                                        @if($s->caption)--}}
                                            {{--                                            <div class="tp-caption1-wd-2 tt-white-color">{{ $s->caption }}</div>--}}
                                            {{--                                        @endif--}}
                                            {{--                                        @if($s->url)--}}
                                            {{--                                            <div class="tp-caption1-wd-4"><a href="{{ $s->url }}"--}}
                                            {{--                                                                             class="btn btn-xl"--}}
                                            {{--                                                                             data-text="{{ $s->title }}">{{ $s->title }}</a>--}}
                                            {{--                                            </div>--}}
                                            {{--                                        @endif--}}
                                            {{--                                        @if($s->path)--}}
                                            {{--                                            <div class="tp-caption1-wd-4"><a--}}
                                            {{--                                                        href="{{ $s->pathLink }}"--}}
                                            {{--                                                        class="btn btn-xl"--}}
                                            {{--                                                        data-text="{{ $s->title }}">{{ $s->title }}</a>--}}
                                            {{--                                            </div>--}}
                                            {{--                                        @endif--}}
                                        </div>
                                    </li>
                                    {{--                                @endif--}}
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
