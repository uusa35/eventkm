@extends('backend.layouts.app')
@section('breadcrumbs')
{{ Breadcrumbs::render('backend.admin.area.edit', $element) }}
@endsection

@section('content')
<div class="portlet box blue">
    @include('backend.partials.forms.form_title')
    <div class="portlet-body">
        @include('backend.partials._admin_instructions',['title' => trans('general.area') ,'message' =>
        trans('message.admin_area_message')])
        <div class="portlet-body form">
            <form class="horizontal-form" role="form" method="POST" action="{{ route('backend.admin.area.update', $element->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-body">
                    <h3 class="form-section">{{ trans('general.edit_area') }}</h3>
                    <div class="portlet box blue ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i> {{ trans('general.main_details') }}
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="name" class="control-label">{{ trans('general.name') }}*</label>
                                            <input id="name" type="text" class="form-control" name="name" value="{{ $element->name }}" placeholder="{{ trans('general.name') }}" required autofocus>
                                            @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('name') }}
                                                </strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('slug_ar') ? ' has-error' : '' }}">
                                            <label for="slug_ar" class="control-label">{{ trans('general.slug_ar') }}*</label>
                                            <input id="slug_ar" type="text" class="form-control" name="slug_ar" value="{{ $element->slug_ar }}" placeholder="{{ trans('general.slug_ar') }}" required autofocus>
                                            @if ($errors->has('slug_ar'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('slug_ar') }}
                                                </strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('slug_en') ? ' has-error' : '' }}">
                                            <label for="slug_en" class="control-label">{{ trans('general.slug_en') }}*</label>
                                            <input id="slug_en" type="text" class="form-control" name="slug_en" value="{{ $element->slug_en }}" placeholder="{{ trans('general.slug_en') }}" required autofocus>
                                            @if ($errors->has('slug_en'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('slug_en') }}
                                                </strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                                            <label for="code" class="control-label">{{ trans('general.code') }}*</label>
                                            <input id="code" type="text" class="form-control" name="code" value="{{ $element->code }}" placeholder="{{ trans('general.code') }}" required autofocus>
                                            @if ($errors->has('code'))
                                                <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('code') }}
                                                </strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        @if(!$countries->isEmpty())
                                        <div class="form-group">
                                            <label for="duration" class="control-label">{{ trans('general.country') }} *</label>
                                            <select class="form-control input-xlarge" name="country_id" id="country" required="required">
                                                @foreach($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @else
                                        <span class="label label-danger">No Countries Listed, Please Create Country First -- All Countries exist already have currency.</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if(!$governate->isEmpty())
                                            <div class="form-group">
                                                <label for="duration" class="control-label">{{ trans('general.governate') }} *</label>
                                                <select class="form-control input-xlarge" name="governate_id" id="governate" required="required">
                                                    @foreach($governates as $governate)
                                                        <option value="{{ $governate->id }}">{{ $governate->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('order') ? ' has-error' : '' }}">
                                            <label for="order" class="control-label">{{ trans('general.order') }}*</label>
                                            <input id="order" type="text" class="form-control" name="order" value="{{ $element->order }}" placeholder="{{ trans('general.order') }}" required autofocus>
                                            @if ($errors->has('order'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('order') }}
                                                </strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('longitude') ? ' has-error' : '' }}">
                                            <label for="longitude" class="control-label">{{ trans('general.longitude') }}*</label>
                                            <input id="longitude" type="text" class="form-control" name="longitude" value="{{ $element->longitude }}" placeholder="{{ trans('general.longitude') }}" autofocus>
                                            @if ($errors->has('longitude'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('longitude') }}
                                                </strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('latitude') ? ' has-error' : '' }}">
                                            <label for="latitude" class="control-label">{{ trans('general.latitude') }}*</label>
                                            <input id="latitude" type="text" class="form-control" name="latitude" value="{{ $element->latitude }}" placeholder="{{ trans('general.latitude') }}" autofocus>
                                            @if ($errors->has('latitude'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('latitude') }}
                                                </strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @include('backend.partials.forms._btn-group')
        </div>


        </form>
    </div>
</div>
@endsection
