@extends('backend.layouts.app')


@section('content')
    <!-- BREADCRUMBS -->
    <section class="page-section breadcrumbs">
        <div class="container">
            <div class="page-header">
                <h1>Name : {{ $element->name }}</h1>
                <h1>Mobile : {{ $element->mobile }}</h1>
                <h1>Email : {{ $element->email }}</h1>
            </div>
        </div>
    </section>
    <!-- /BREADCRUMBS -->

    <!-- PAGE -->
    <section class="page-section">
        <div class="container">
            <div class="col-lg-12">
                <h3 class="block-title alt text-center"><i class="fa fa-list-alt"></i>{{ $element->name }}</h3>
                <!-- Contact form -->
                <form name="contact-form" method="post" action="{{ route('frontend.survey.store') }}"
                      class="contact-form">
                    @csrf
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group"><input disabled class="form-control" type="text" name="name" value="{{ $element->name }}"
                                                       placeholder="{{ trans('general.name') }}"></div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group"><input disabled class="form-control" type="text" name="mobile" value="{{ $element->mobile }}"
                                                       placeholder="{{ trans('general.mobile') }}"></div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group"><input disabled class="form-control" type="text" name="email" value="{{ $element->email }}"
                                                       placeholder="{{ trans('general.email') }}"></div>
                    </div>
                    @foreach($results as $r)
                        <div class="col-lg-12">
                            @if($r->question->is_multi)
                                <h3 class="block-title alt">
                                    <i class="fa fa-exclamation-circle"></i>
                                    {{ $r->question->name }}
                                </h3>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            {{ $r->answer->name  }}
                                        </div>
                                    </div>
                            @elseif($r->question->is_text)
                                <h3 class="block-title alt"
                                ><i class="fa fa-exclamation-circle"></i>{{ $r->questioned }}</h3>
                                <div class="form-group af-inner">
                                    <label class="sr-only" for="input-message">{{ $r->question->notes }}</label>
                                    <textarea
                                            disabled
                                            name="text[{{ $r->question->id }}]" placeholder="{{ trans('general.answer') }}"
                                            rows="4"
                                            cols="50"
                                            @if($r->question->notes)
                                            data-toggle="tooltip" title="{{ $r->question->notes }}"
                                            @endif
                                            class="form-control placeholder">
                                        {{ $r->answered }}
                                    </textarea>
                                </div>
                            @endif
                        </div>
                    @endforeach
                    <hr class="page-divider">
                    <div class="outer required">
                        <div class="form-group af-inner">
                            <input disabled type="submit" name="submit"
                                   class="form-button form-button-submit btn btn-theme btn-theme-dark"
                                   value="{{ trans('general.submit') }}"/>
                        </div>
                    </div>

                </form>
                <!-- /Contact form -->
            </div>
            <hr class="page-divider small"/>
        </div>
    </section>
    <!-- /PAGE -->
@endsection
