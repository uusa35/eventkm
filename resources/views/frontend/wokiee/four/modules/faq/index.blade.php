@extends('frontend.wokiee.four.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('frontend.category.index') }}
@endsection

@section('body')

    <div class="container-indent">
        <div class="container container-fluid-custom-mobile-padding">
            <div class="row justify-content-center">
                <div class="col-xs-12 col-md-12 col-lg-12 col-md-auto">
                    @foreach($elements as $element)
                        <button class="accordionCustome">{{ $element->title }}</button>
                        <div class="panel" style="display : {{ $loop->index == 0 ? 'block' : 'none' }}">
                            <p>{!!  $element->content !!}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
