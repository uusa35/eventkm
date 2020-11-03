@extends('frontend.wokiee.four.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('frontend.post.index') }}
@endsection


@section('body')
    <div class="container-indent nomargin">
        {{--<div class="container-fluid-custom container-fluid-custom-mobile-padding">--}}
        <div class="container-indent">
            <div class="container container-fluid-custom-mobile-padding">
                <h1 class="tt-title-subpages noborder">{{ trans("general.blog") }}</h1>
                <div class="row">
                    <div class="col-12">
                        <div class="tt-listing-post tt-half">
                            @if($elements->isNotEmpty())
                                @foreach($elements as $element)
                                <div class="tt-post">
                                    <div class="tt-post-img" style="max-width: 200px;">
                                        <a href="{{ route('frontend.post.show.name', ['id' => $element->id, 'name' => $element->slug]) }}"><img src="images/loader.svg"
                                                                             data-src="{{ $element->imageLargeLink }}"
                                                                                                                                                style="max-width: 200px"
                                                                             alt="{{ $element->title }}"></a>
                                    </div>
                                    <div class="tt-post-content" style="max-width: 100rem">
{{--                                        <div class="tt-tag"><a href="blog-single-post.html">FASHION</a></div>--}}
                                        <h2 class="tt-title"><a
                                                    href="{{ route('frontend.post.show.name', ['id' => $element->id, 'name' => $element->slug]) }}">
                                                {{ $element->title }}</a></h2>
                                        <div class="tt-description">
                                            {!!  $element->caption ? $element->caption : str_limit($element->content, 500) !!}
                                        </div>
                                        <div class="tt-meta">
                                            <div class="tt-autor">
                                                {{ trans('general.by') }} <span> {{ $element->user->slug }} </span> {{ $element->created_at->diffForHumans() }}
                                            </div>
                                            <div class="tt-comments d-none">
                                                <a href="#"><i class="tt-icon icon-f-88"></i>{{ $element->comments->count() }}</a>
                                            </div>
                                        </div>
                                        <div class="tt-btn">
                                            <a href="{{ route('frontend.post.show.name', ['id' => $element->id, 'name' => $element->slug]) }}" class="btn">{{ trans('general.read_more') }}..</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="text-center tt_product_showmore">
                                    <div class="col-lg-12">
                                        @include('frontend.wokiee.four.partials._pagination',['elements' => $elements])
                                    </div>
                                    {{--<a href="#" class="btn btn-border">LOAD MORE</a>--}}
                                    {{--<div class="tt_item_all_js">--}}
                                    {{--<a href="#" class="btn btn-border01">NO MORE ITEM TO SHOW</a>--}}
                                    {{--</div>--}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
