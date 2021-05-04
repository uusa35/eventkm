@extends('backend.layouts.app')
@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.branch.edit', $element) }}
@endsection

@section('content')
    <div class="portlet box blue">
        @include('backend.partials.forms.form_title')
        <div class="portlet-body">
            @include('backend.partials._admin_instructions',['title' => trans('general.branches') ,'message' => trans('message.admin_branch_message')])
            <div class="portlet-body form">
                <form class="horizontal-form" role="form" method="POST"
                      action="{{ route('backend.branch.update', $element->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-body">
                        <h3 class="form-section">{{ trans('general.edit_branch') }}</h3>
                        <div class="portlet box blue ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i> {{ trans('general.main_details') }}
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group{{ $errors->has('name_ar') ? ' has-error' : '' }}">
                                                <label for="name_ar"
                                                       class="control-label">{{ trans('general.name_ar') }}*</label>

                                                <input id="name_ar" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.name_ar') }}"
                                                       name=" name_ar" value="{{ $element->name_ar }}"
                                                       placeholder="{{ trans('general.name_ar') }}"
                                                       required autofocus>
                                                @if ($errors->has('name_ar'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('name_ar') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group{{ $errors->has('name_en') ? ' has-error' : '' }}">
                                                <label for="name_en"
                                                       class="control-label">{{ trans('general.name_en') }}*</label>

                                                <input id="name_en" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.name_en') }}"
                                                       name=" name_en" value="{{ $element->name_en }}"
                                                       placeholder="{{ trans('general.name_en') }}"
                                                       value="{{ $element->name_en }}"
                                                       required autofocus>
                                                @if ($errors->has('name_en'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('name_en') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group{{ $errors->has('address_ar') ? ' has-error' : '' }}">
                                                <label for="address_ar"
                                                       class="control-label">{{ trans('general.address_ar') }}*
                                                </label>

                                                <input id="address_ar" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.address_ar') }}"
                                                       name=" address_ar" value="{{ $element->address_ar }}"
                                                       placeholder="{{ trans('general.address_ar') }}" required
                                                       autofocus>
                                                @if ($errors->has('address_ar'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('address_ar') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group{{ $errors->has('address_en') ? ' has-error' : '' }}">
                                                <label for="address_en"
                                                       class="control-label">{{ trans('general.address_en') }}*
                                                </label>

                                                <input id="address_en" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.address_en') }}"
                                                       name=" address_en" value="{{ $element->address_en }}"
                                                       placeholder="{{ trans('general.address_en') }}" required
                                                       autofocus>
                                                @if ($errors->has('address_en'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('address_en') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div
                                                class="form-group{{ $errors->has('description_ar') ? ' has-error' : '' }}">
                                                <label for="description_ar"
                                                       class="control-label">{{ trans('general.description_ar') }}
                                                    * </label>

                                                <input id="description_ar" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.description_ar') }}"
                                                       name=" description_ar" value="{{ $element->description_ar }}"
                                                       placeholder="{{ trans('general.description_ar') }}" required
                                                       autofocus>
                                                @if ($errors->has('description_ar'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('description_ar') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div
                                                class="form-group{{ $errors->has('description_en') ? ' has-error' : '' }}">
                                                <label for="description_en"
                                                       class="control-label">{{ trans('general.description_en') }}
                                                    * </label>

                                                <input id="description_en" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.description_en') }}"
                                                       name=" description_en" value="{{ $element->description_en }}"
                                                       placeholder="{{ trans('general.description_en') }}" required
                                                       autofocus>
                                                @if ($errors->has('description_en'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('description_en') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                                <label for="phone" class="control-label">{{ trans('general.phone') }}
                                                    *</label>

                                                <input id="phone" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.phone') }}" name=" phone"
                                                       value="{{ $element->phone }}"
                                                       placeholder="{{ trans('general.phone') }} " required autofocus>
                                                @if ($errors->has('phone'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('phone') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                                <label for="mobile" class="control-label">{{ trans('general.mobile') }}
                                                    *</label>

                                                <input id="mobile" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.mobile') }}"
                                                       name=" mobile" value="{{ $element->mobile }}"
                                                       placeholder="{{ trans('general.mobile') }}" required autofocus>
                                                @if ($errors->has('mobile'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('mobile') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group{{ $errors->has('longitude') ? ' has-error' : '' }}">
                                                <label for="longitude"
                                                       class="control-label">{{ trans('general.longitude') }}*</label>

                                                <input id="longitude" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.longitude') }}"
                                                       name=" longitude" value="{{ $element->longitude }}"
                                                       placeholder="{{ trans('general.longitude') }}" autofocus>
                                                @if ($errors->has('longitude'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('longitude') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group{{ $errors->has('latitude') ? ' has-error' : '' }}">
                                                <label for="latitude"
                                                       class="control-label">{{ trans('general.latitude') }}*</label>

                                                <input id="latitude" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.latitude') }}"
                                                       name=" latitude" value="{{ $element->latitude }}"
                                                       placeholder="{{ trans('general.latitude') }}" autofocus>
                                                @if ($errors->has('latitude'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('latitude') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        {{--                                        <div class="col-lg-6">--}}
                                        {{--                                            <div class="form-group">--}}
                                        {{--                                                <label for="area_id">{{ trans('general.area') }}</label>--}}
                                        {{--                                                <select name="area_id" id="area_id" class="form-control tooltips" data-container="body" data-placement="top" data-original-title="{{ trans('message.are') }}">--}}
                                        {{--                                                    @foreach($areas as $area)--}}
                                        {{--                                                        <option value=" {{ $area->id }}">{{ $area->name }}</option>--}}
                                        {{--                                                    @endforeach--}}
                                        {{--                                                </select>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}

                                        @can('isAdminOrAbove')
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="user_id">{{ trans('general.user') }}</label>
                                                    <select name="user_id" id="user_id" class="form-control tooltips"
                                                            data-container="body" data-placement="top"
                                                            data-original-title="{{ trans('message.user') }}">
                                                        @foreach($users as $user)
                                                            <option value=" {{ $user->id }}"
                                                                {{ $element->user_id == $user->id ? 'selected' : null  }}
                                                            >{{ $user->slug }} - {{ $user->id }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @else
                                            <input type="hidden" value="{{ auth()->id() }}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portlet box blue ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i> {{ trans('general.more_details') }}
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="form-body">
                                    <div class="row">
                                        <hr>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label sbold tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.active') }}">{{ trans('general.active') }}</label></br>
                                                <label class="radio-inline">
                                                    <input type="radio" name="active" id="optionsRadios3"
                                                           {{ $element->active ? 'checked' : '' }}
                                                           value="1"> {{ trans('general.yes') }}</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="active" id="optionsRadios4"
                                                           {{ !$element->active ? 'checked' : '' }}
                                                           value="0"> {{ trans('general.no') }}</label>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    @include('backend.partials.forms._btn-group')
                </form>
            </div>
        </div>
@endsection
