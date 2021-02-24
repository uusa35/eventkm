@extends('backend.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.admin.address.edit', $element) }}
@endsection
@section('content')
    <div class="portlet box blue">
        @include('backend.partials.forms.form_title',['title' => trans('general.edit_address')])
        <div class="portlet-body">
            @include('backend.partials._admin_instructions',['title' => trans('general.countries') ,'message' => trans('message.edit_address')])
            <div class="portlet-body form">
                <form action="{{ route('backend.admin.address.update', $element->id) }}" role="form" method="post"
                      class="horizontal-form" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" name="user_id" value="{{ $element->user_id }}">
                    <div class="form-body">
                        <h3 class="form-section">{{ trans('general.edit_address') }}</h3>
                        <div class="portlet box blue ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i> {{ trans('general.address_main_details') }}
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label required">{{ trans('general.name') }}
                                                    *</label>
                                                <input type="text" id="name" name="name" class="form-control"
                                                       value="{{ $element->name }}"
                                                       placeholder="{{ trans('general.name') }}" required>
                                                {{--<span class="help-block"> This field has error. </span>--}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label required">{{ trans('general.content') }}
                                                    *</label>
                                                <input type="text" id="content" name="content" class="form-control"
                                                       value="{{ $element->content }}"
                                                       placeholder="{{ trans('general.content') }}" required>
                                                {{--<span class="help-block"> This field has error. </span>--}}
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">{{ trans('general.block') }}</label>
                                                <input type="text" id="block" name="block" class="form-control"
                                                       value="{{ $element->block }}"
                                                       placeholder="{{ trans('general.block') }}">
                                                {{--<span class="help-block"> This field has error. </span>--}}
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">{{ trans('general.street') }}</label>
                                                <input type="text" id="street" name="street" class="form-control"
                                                       value="{{ $element->street }}"
                                                       placeholder="{{ trans('general.street') }}">
                                                {{--<span class="help-block"> This field has error. </span>--}}
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">{{ trans('general.building') }}</label>
                                                <input type="text" id="building" name="building" class="form-control"
                                                       value="{{ $element->building }}"
                                                       placeholder="{{ trans('general.building') }}">
                                                {{--<span class="help-block"> This field has error. </span>--}}
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">{{ trans('general.floor') }}</label>
                                                <input type="text" id="floor" name="floor" class="form-control"
                                                       value="{{ $element->floor }}"
                                                       placeholder="{{ trans('general.floor') }}">
                                                {{--<span class="help-block"> This field has error. </span>--}}
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">{{ trans('general.apartment') }}</label>
                                                <input type="text" id="apartment" name="apartment" class="form-control"
                                                       value="{{ $element->apartment }}"
                                                       placeholder="{{ trans('general.apartment') }}">
                                                {{--<span class="help-block"> This field has error. </span>--}}
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">{{ trans('general.country') }}</label>
                                                <input type="text" id="country" name="country_name" class="form-control"
                                                       value="{{ $element->country_name }}"
                                                       placeholder="{{ trans('general.country') }}">
                                                {{--<span class="help-block"> This field has error. </span>--}}
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">{{ trans('general.area') }}</label>
                                                <input type="text" id="area" name="area" class="form-control"
                                                       value="{{ $element->area }}"
                                                       placeholder="{{ trans('general.area') }}">
                                                {{--<span class="help-block"> This field has error. </span>--}}
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">{{ trans('general.countries') }}
                                                    *</label>
                                                <select name="country_id" class="form-control  tooltips"
                                                        data-container="body"
                                                        data-placement="top"
                                                        data-original-title="{{ trans('message.country') }}"
                                                        required>
                                                    <option>{{ trans('general.choose_country') }}</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}" {{ $element->country_id === $country->id ? 'selected' : null  }}>{{ $country->slug }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('backend.partials.forms._btn-group')
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
@endsection
