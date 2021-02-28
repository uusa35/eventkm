@extends('backend.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.admin.country.create') }}
@endsection
@section('content')
    <div class="portlet box blue">
        @include('backend.partials.forms.form_title',['title' => trans('general.new_country')])
        <div class="portlet-body">
            @include('backend.partials._admin_instructions',['title' => trans('general.countries') ,'message' => trans('message.new_country')])
            <div class="portlet-body form">
                <form action="{{ route('backend.admin.country.store') }}" role="form" method="post"
                      class="horizontal-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <h3 class="form-section">{{ trans('general.new_country') }}</h3>
                        <div class="portlet box blue ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i> {{ trans('general.country_main_details') }}
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">{{ trans('general.name') }}</label>
                                                <input type="text" id="name" name="name" class="form-control"
                                                       value="{{ old('name') }}"
                                                       placeholder="{{ trans('general.name') }}" required>
                                                {{--<span class="help-block"> This field has error. </span>--}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">{{ trans('general.slug_ar') }}</label>
                                                <input type="text" id="slug_ar" name="slug_ar" class="form-control"
                                                       value="{{ old('slug_ar') }}"
                                                       placeholder="{{ trans('general.slug_ar') }}" required>
                                                {{--<span class="help-block"> This field has error. </span>--}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">{{ trans('general.slug_en') }}</label>
                                                <input type="text" id="slug_en" name="slug_en" class="form-control"
                                                       value="{{ old('slug_en') }}"
                                                       placeholder="{{ trans('general.slug_en') }}" required>
                                                {{--<span class="help-block"> This field has error. </span>--}}
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">{{ trans('general.calling_code') }}
                                                    *</label>
                                                <input type="number" id="calling_code" name="calling_code" maxlength="3"
                                                       max="999"
                                                       class="form-control" value="{{ old('calling_code') }}"
                                                       placeholder="{{ trans('general.calling_code') }}" required>
                                                <span class="help-block"> ex. 00965 </span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">{{ trans('general.country_code') }}</label>
                                                <input type="text" id="country_code" name="country_code"
                                                       class="form-control"
                                                       placeholder="{{ trans('general.country_code') }}"
                                                       value="{{ old('country_code') }}" required>
                                                <span class="help-block"> country_code ex. KWT </span>
                                            </div>

                                        </div>
                                        {{--                                        <div class="col-md-4">--}}
                                        {{--                                            <div class="form-group">--}}
                                        {{--                                                <label class="control-label">{{ trans('general.shipment_packages') }}--}}
                                        {{--                                                    *</label>--}}
                                        {{--                                                <select name="packages[]" multiple="multiple" class="multi-select tooltips" data-container="body" data-placement="top" data-original-title="{{ trans('message.shipment_package') }}" id="my_multi_select1" required>--}}
                                        {{--                                                    <option>{{ trans('general.choose_shipment_package') }}</option>--}}
                                        {{--                                                    @foreach($shipmentPackages as $package)--}}
                                        {{--                                                        <option value="{{ $package->id }}">{{ $package->slug }}</option>--}}
                                        {{--                                                        @endforeach--}}
                                        {{--                                                </select>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
{{--                                        <div class="col-md-4">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="control-label">{{ trans('general.shipment_packages') }}--}}
{{--                                                    *</label>--}}
{{--                                                <select name="packages[]" class="form-control  tooltips" data-container="body"--}}
{{--                                                        data-placement="top"--}}
{{--                                                        data-original-title="{{ trans('message.shipment_package') }}"--}}
{{--                                                        required>--}}
{{--                                                    <option>{{ trans('general.choose_shipment_package') }}</option>--}}
{{--                                                    @foreach($shipmentPackages as $package)--}}
{{--                                                        <option value="{{ $package->id }}">{{ $package->slug }}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    {{--<div class="col-md-6">--}}
                                    {{--<div class="form-group">--}}
                                    {{--<label class="control-label">Country Background</label>--}}
                                    {{--<input id="bg" type="file" class="form-control" name="bg">--}}
                                    {{--<span class="help-block"> flag size is ['1534', '586'] </span>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    <!--/span-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="portlet box blue ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i> {{ trans('general.country_more_details') }}
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">{{ trans('general.flag_image') }} </label>
                                                <input id="flag" type="file" class="form-control" name="image">
                                                <span class="help-block"> flag size is 400 X 250</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">{{ trans('general.sequence') }}</label>
                                                <input type="number" id="order" name="order" class="form-control"
                                                       maxlength="2"
                                                       max="99"
                                                       placeholder="{{ trans('general.order') }}"
                                                       value="{{ old('order') }}"
                                                       required>
                                                <span class="help-block"> ex. 1 (order is the sequence of the countries that shall appear on app List of Countries in Home Interface)</span>
                                            </div>
                                        </div>

                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">{{ trans('general.currency_symbol_ar') }}
                                                    *</label>
                                                <input type="text" id="currency_symbol_ar" name="currency_symbol_ar"
                                                       class="form-control" value="{{ old('currency_symbol_ar') }}"
                                                       placeholder="{{ trans('general.currency_symbol_ar') }}" required>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">{{ trans('general.currency_symbol_en') }}
                                                    *</label>
                                                <input type="text" id="currency_symbol_en" name="currency_symbol_en"
                                                       class="form-control" value="{{ old('currency_symbol_en') }}"
                                                       placeholder="{{ trans('general.currency_symbol_en') }}" required>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">{{ trans('general.minimum_shipment_charge') }}
                                                    *</label>
                                                <input type="number" id="minimum_shipment_charge"
                                                       name="minimum_shipment_charge"
                                                       class="form-control" value="{{ old('minimum_shipment_charge') }}"
                                                       placeholder="{{ trans('general.minimum_shipment_charge') }}"
                                                       required>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">{{ trans('general.fixed_shipment_charge') }}
                                                    *</label>
                                                <input type="text" id="fixed_shipment_charge"
                                                       name="fixed_shipment_charge"
                                                       class="form-control" value="{{ old('fixed_shipment_charge') }}"
                                                       placeholder="{{ trans('general.fixed_shipment_charge') }}"
                                                       required>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">{{ trans('general.longitude') }}</label>
                                                <input type="number" id="longitude" name="longitude"
                                                       class="form-control"
                                                       value="{{ old('longitude') }}"
                                                       placeholder="{{ trans('general.longitude') }}">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">{{ trans('general.latitude') }}</label>
                                                <input type="number" id="latitude" name="latitude" class="form-control"
                                                       value="{{ old('latitude') }}"
                                                       placeholder="{{ trans('general.latitude') }}">

                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>

                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <div class="portlet box blue ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i> {{ trans('general.country_attributes_details') }}
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4" style="padding-left : 50px;">
                                            <div class="form-group">
                                                <label class="control-label sbold">{{ trans('general.active') }}</label>
                                                <div class="radio-list">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="active" id="optionsRadios1"
                                                               value="1" {{ old('is_active') ? 'checked' : null }}> {{ trans('general.active') }}
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="active" id="optionsRadios2" value="0"
                                                               {{ old('is_active')  ? 'checked' : null  }} checked>
                                                        {{ trans('general.not_active') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="padding-left : 50px;">
                                            <div class="form-group">
                                                <label class="control-label sbold">{{ trans('general.has_currency') }}</label>
                                                <div class="radio-list">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="has_currency" id="optionsRadios1"
                                                               value="1" {{ old('has_currency') ? 'checked' : null }}> {{ trans('general.has_currency') }}
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="has_currency" id="optionsRadios2"
                                                               value="0"
                                                               {{ old('has_currency')  ? 'checked' : null  }}checked>
                                                        {{ trans('general.not_has_currency') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="padding-left : 50px;">
                                            <div class="form-group">
                                                <label class="control-label sbold">{{ trans('general.is_local') }}</label>
                                                <div class="radio-list">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_local" id="optionsRadios1"
                                                               value="1" {{ old('is_local') ? 'checked' : null }}> {{ trans('general.is_local') }}
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_local" id="optionsRadios2"
                                                               value="0"
                                                               {{ old('is_local')  ? 'checked' : null  }} checked>
                                                        {{ trans('general.not_is_local') }}</label>
                                                </div>
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
