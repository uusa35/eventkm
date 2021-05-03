@extends('frontend.wokiee.four.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('frontend.home') }}
@endsection

@section('body')

    <div class="container-indent">
        <div class="container container-fluid-custom-mobile-padding">
            <div class="row justify-content-center">
                <div class="col-xs-12 col-md-10 col-lg-8 col-md-auto">
                    <div class="tt-post-single">
                        {{--                        <div class="tt-tag"><a href="#">FASHION</a></div>--}}
                        <h1 class="tt-title">
                            {{ trans('general.our_policies') }}
                        </h1>
                        <div class="tt-post-content">
                            <!-- slider -->
                            <p class="text-left text-justify">
                                {!! $element->policy !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

