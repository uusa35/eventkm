@extends('frontend.wokiee.four.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('frontend.survey.show',$element) }}
@endsection

@section('body')
    <div class="container-indent nomargin">
        @if(env('MALLR'))
            @include('frontend.wokiee.four.partials._user_show_header',['element' => $user])
        @endif
        <div class="container-indent">
            @if(env('MALLR'))
                <div class="container container-fluid-custom-mobile-padding">
                    <div class="col-12">
                        <div class="tt-add-info">
                            <div class="tt-table-responsive">
                                <table class="tt-table-shop-01">
                                    {{--<table class="table table-responsive">--}}
                                    <tr>
                                        <td class="td-fixed-element td-sm"><i class="icon-f-02 fa fa-fw fa-lg"></i><span
                                                    class="ml-1"></span><span>{{ trans('general.sku') }} : </span>
                                            <span class="ml-2"></span></td>
                                        <td>
                                            {{ $user->id }}
                                        </td>
                                    </tr>
                                    @if($user->country)
                                        <tr>
                                            <td class="td-fixed-element td-sm"><i
                                                        class="icon-f-02 fa fa-fw fa-lg"></i><span
                                                        class="ml-1"></span><span>{{ trans('general.country') }} : </span>
                                                <span class="ml-2"></span></td>
                                            <td>
                                                {{ $user->country->name }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if($user->description)
                                        <tr>
                                            <td class="td-fixed-element td-sm"><i
                                                        class="icon-f-02 fa fa-fw fa-lg"></i><span
                                                        class="ml-1"></span><span>{{ trans('general.description') }} : </span>
                                                <span class="ml-2"></span></td>
                                            <td>
                                                {{ $user->description }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if($user->notes)
                                        <tr>
                                            <td class="td-fixed-element td-sm"><i
                                                        class="icon-f-07 fa fa-fw fa-lg"></i><span
                                                        class="ml-1"></span><span>{{ trans('general.notes') }} : </span>
                                                <span class="ml-2"></span></td>
                                            <td>
                                                {{ $user->notes }}
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


            <div class="container container-fluid-custom-mobile-padding">
                <h1 class="tt-title-subpages noborder">
                    {{ trans('general.collection_order') }}
                </h1>
                @if($element->description)
                    <h3 class="tt-title-subpages noborder">
                        {{ $element->description }}
                    </h3>
                @endif

                @if($element->is_order)
                    <h3 class="tt-title-subpages noborder">
                        {{ trans('general.service_price') }} : {{ $element->final_price }} {{ trans('general.kd') }}
                    </h3>
                @endif
                <form name="contact-form" method="post" action="{{ route('frontend.survey.store') }}"
                      class="contact-form form-default">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ request()->user_id }}">
                    <input type="hidden" name="survey_id" value="{{ $element->id }}">
                    <div class="row">
                        <div class="col-lg-4 col-xs-12">
                            <div class="form-group">
                                <input class="form-control" type="text" name="name" required
                                       value="{{ auth()->check() ? auth()->user()->slug : old('name')}}"
                                       placeholder="{{ trans('general.name') }}"/></div>
                        </div>
                        <div class="col-lg-4 col-xs-12">
                            <div class="form-group">
                                <input class="form-control" type="number" name="mobile" required minlength="5"
                                       value="{{ auth()->check() ? auth()->user()->mobile : old('mobile')}}"
                                       placeholder="{{ trans('general.mobile') }}"/>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12">
                            <div class="form-group">
                                <input class="form-control" type="text" name="email"
                                       value="{{ auth()->check() ? auth()->user()->email : old('email')}}"
                                       placeholder="{{ trans('general.email') }}"/></div>
                        </div>
                        <div class="col-lg-12 col-xs-12">
                            <div class="form-group">
                                <textarea class="form-control" type="text" name="notes"
                                          value="{{ old('notes')}}"
                                          placeholder="{{ trans('general.notes') }}"></textarea>
                            </div>
                        </div>
                    </div>
                    @foreach($element->questions as $q)
                        <div class="col-lg-12">
                            @if($q->is_multi)
                                <h3 class="block-title alt">
                                    <i class="fa fa-fw fa-dot-circle-o"></i>
                                    @if($q->notes)
                                        <small>
                                            {{ $q->notes }}
                                        </small>
                                    @endif
                                    {{ $q->name }}
                                </h3>
                                @foreach($q->answers as $a)
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input type="radio" name="question_id[{{ $q->id }}]"
                                                   value="{{ $a->value }}">
                                            @if($a->icon)
                                                &nbsp;<i class="fa fa-fw fa-{{ $a->icon }}"></i>
                                            @endif
                                            @if($a->name)
                                                <label class="label "
                                                       for="question_id[{{ $q->id }}]">&nbsp;&nbsp;{{ str_limit($a->name,20,'') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @elseif($q->is_text)
                                <h3 class="block-title alt"
                                    @if($q->notes)
                                    data-toggle="tooltip" title="{{ $q->notes }}"
                                        @endif
                                ><i class="fa fa-fw fa-dot-circle-o"></i>
                                    {{ $q->name }}
                                </h3>
                                <div>
                                    @if($q->notes)
                                        <small>
                                            {{ $q->notes }}
                                        </small>
                                    @endif
                                </div>
                                <div class="form-group af-inner">
                                    <label class="sr-only" for="input-message">{{ $q->notes }}</label>
                                    <input
                                            type="text"
                                            name="question_id[{{ $q->id }}]"
{{--                                            placeholder="{{ trans('general.answer') }}"--}}
                                            rows="4"
                                            cols="50"
                                            @if($q->notes)
                                            data-toggle="tooltip" title="{!! $q->notes !!}"
                                            @endif
                                            class="form-control placeholder"/>
                                </div>
                            @elseif($q->is_dropdown)
                                <h3 class="block-title alt"
                                    @if($q->notes)
                                    data-toggle="tooltip" title="{{ $q->notes }}"
                                        @endif
                                ><i class="fa fa-fw fa-dot-circle-o"></i>{{ $q->name }}</h3>
                                <div class="form-group af-inner">
                                    <label class="sr-only" for="input-message">{{ $q->notes }}</label>
                                    <select name="question_id[{{ $q->id }}]" id="" class="form-control">
                                        @foreach($q->answers->sortBy('order') as $a)
                                            <option value="{{ $a->value }}">{{ $a->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>
                    @endforeach
                    <hr class="page-divider">
                    <div class="outer required">
                        <div class="form-group af-inner">
                            <input type="submit" name="submit"
                                   class="form-button form-button-submit btn btn-theme btn-theme-dark"
                                   value="{{ $element->is_paid ? trans('general.confirm_order_pay') : trans('general.submit')}}"/>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection


