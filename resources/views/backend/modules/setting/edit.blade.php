@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                @include('backend.partials.forms.form_title')
                <div class="portlet-body form">
                    <form role="form" method="post"
                          class="horizontal-form"
                          action="{{ route('backend.admin.setting.update',$element->id) }}"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="patch">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" name="company_ar" placeholder="..."
                                                   value="{{ $element->company_ar }}">
                                            <label for="form_control_1">{{ trans('general.name_ar') }}*</label>
                                            <span class="help-block">{{ trans('general.company_name_arabic') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group form-md-line-input">
                                        <label for="form_control_1">{{ trans('general.name_en') }}*</label>
                                        <input type="text" class="form-control" name="company_en" placeholder="..."
                                               value="{{ $element->company_en }}">
                                        <span class="help-block">{{ trans('general.company_name_en') }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" name="email" placeholder="..."
                                                   value="{{ $element->email }}">
                                            <label for="form_control_1">{{ trans('general.email') }}</label>
                                            <span class="help-block">{{ trans("general.email") }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-5">
                                        <div class="form-group form-md-line-input">
                                            <label for="form_control_1">{{ trans('general.web_site_logo') }}
                                                <br>{{ trans('message.best_fit',['width' => '1024 px', 'height' => '1024px']) }}
                                            </label>
                                            <span class="help-block">
                                    </span>
                                            <input type="file" class="form-control" name="logo" placeholder="...">
                                        </div>
                                    </div>
                                    @if($element->logo)
                                        <div class="col-md-1">
                                            <img class="img-responsive img-sm"
                                                 src="{{ $element->getCurrentImageAttribute('logo') }}"
                                                 alt="">
                                        </div>
                                    @endif
                                    <div class="col-lg-5">
                                        <div class="form-group form-md-line-input">
                                            <label for="form_control_1">{{ trans('general.app_logo') }}
                                                <br>{{ trans('message.best_fit',['width' => '600 px', 'height' => '221px']) }}
                                            </label>
                                            <span class="help-block">
                                    </span>
                                            <input type="file" class="form-control" name="app_logo" placeholder="...">
                                        </div>
                                    </div>
                                    @if($element->app_logo)
                                        <div class="col-md-1">
                                            <img class="img-responsive img-sm"
                                                 src="{{ $element->getCurrentImageAttribute('app_logo') }}"
                                                 alt="">
                                            <a href="{{ route("backend.admin.image.clear",['model' => 'setting', 'id' => $element->id ,'colName' => 'app_logo']) }}"><i
                                                        class="fa fa-fw fa-times"></i></a>
                                        </div>
                                    @endif
                                    <div class="col-lg-5">
                                        <div class="form-group form-md-line-input">
                                            <label for="form_control_1">{{ trans('general.menu_bg') }}*
                                                <br>{{ trans('message.best_fit',['width' => '1242 px', 'height' => '2688px']) }}
                                            </label>
                                            <span class="help-block">
                                    </span>
                                            <input type="file" class="form-control" name="menu_bg" placeholder="...">
                                        </div>
                                    </div>
                                    @if($element->menu_bg)
                                        <div class="col-lg-1">
                                            <img class="img-responsive img-sm"
                                                 src="{{ asset(env('THUMBNAIL').$element->menu_bg)}}"
                                                 alt="">
                                            <a href="{{ route("backend.admin.image.clear",['model' => 'setting', 'id' => $element->id ,'colName' => 'menu_bg']) }}"><i
                                                        class="fa fa-fw fa-times"></i></a>
                                        </div>
                                    @endif
                                    <div class="col-lg-5">
                                        <div class="form-group form-md-line-input">
                                            <label for="form_control_1">{{ trans('general.mobile_app_home_bg') }}
                                                <br>{{ trans('message.best_fit',['width' => '1242 px', 'height' => '2688px']) }}
                                            </label>
                                            <span class="help-block">
                                    </span>
                                            <input type="file" class="form-control" name="main_bg" placeholder="...">
                                        </div>
                                    </div>
                                    @if($element->main_bg)
                                        <div class="col-lg-1">
                                            <img class="img-responsive img-sm"
                                                 src="{{ $element->getCurrentImageAttribute('main_bg') }}"
                                                 alt="">
                                            <a href="{{ route("backend.admin.image.clear",['model' => 'setting', 'id' => $element->id ,'colName' => 'main_bg']) }}"><i
                                                        class="fa fa-fw fa-times"></i></a>
                                        </div>
                                    @endif
                                    <div class="col-lg-5">
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <input type="file" class="form-control" name="size_chart"
                                                       placeholder="...">
                                                <label for="form_control_1">{{ trans('general.global_size_chart') }}</label>
                                                <div class="help-block text-left">
                                                    {{ trans('message.best_fit',['width' => '1080 px', 'height' => '1440 px']) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($element->size_chart)
                                        <div class="col-md-1">
                                            <img class="img-responsive img-sm"
                                                 src="{{ $element->getCurrentImageAttribute('size_chart') }}"
                                                 alt="">
                                            <a href="{{ route("backend.admin.image.clear",['model' => 'setting', 'id' => $element->id ,'colName' => 'size_chart']) }}"><i
                                                        class="fa fa-fw fa-times"></i></a>
                                        </div>
                                    @endif
                                    <div class="col-lg-5">
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <input type="file" class="form-control" name="shipment_prices"
                                                       placeholder="...">
                                                <label for="form_control_1">{{ trans('general.fixed_shipment_fees') }}</label>
                                                <div class="help-block text-left">
                                                    {{ trans('message.best_fit',['width' => '1080 px', 'height' => '1850 px']) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($element->shipment_prices)
                                        <div class="col-md-1">
                                            <img class="img-responsive img-sm"
                                                 src="{{ $element->getCurrentImageAttribute('shipment_prices') }}"
                                                 alt="">
                                            <a href="{{ route("backend.admin.image.clear",['model' => 'setting', 'id' => $element->id ,'colName' => 'shipment_prices']) }}"><i
                                                        class="fa fa-fw fa-times"></i></a>
                                        </div>
                                    @endif
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label sbold tooltips"
                                                   data-container="body" data-placement="top"
                                                   data-original-title="{{ trans('message.shipment_fuel_percentage') }}">{{ trans('general.shipment_fuel_percentage') }}</label></br>
                                            <input id="shipment_fuel_percentage" type="text"
                                                   class="form-control tooltips"
                                                   data-container="body" data-placement="top"
                                                   data-original-title="{{ trans('message.shipment_fuel_percentage') }}"
                                                   name="shipment_fuel_percentage"
                                                   value="{{ $element->shipment_fuel_percentage }}"
                                                   placeholder="{{ trans('general.shipment_fuel_percentage') }}"
                                                   maxlength="5" autofocus/>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group form-md-line-input">
                                            <label for="form_control_1">{{ trans('general.gift_image') }}
                                                <br>{{ trans('message.best_fit',['width' => '750 px', 'height' => ' 750 px']) }}
                                            </label>
                                            <span class="help-block">
                                    </span>
                                            <input type="file" class="form-control" name="gift_image" placeholder="...">
                                        </div>
                                    </div>
                                    @if($element->gift_image)
                                        <div class="col-md-1">
                                            <img class="img-responsive img-sm"
                                                 src="{{ $element->getCurrentImageAttribute('gift_image') }}"
                                                 alt="">
                                            <a href="{{ route("backend.admin.image.clear",['model' => 'setting', 'id' => $element->id ,'colName' => 'gift_image']) }}"><i
                                                        class="fa fa-fw fa-times"></i></a>
                                        </div>
                                    @endif
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="file"
                                                   class="control-label">{{ trans('general.more_images') }}
                                                *</label>

                                            <input class="form-control tooltips" data-container="body"
                                                   data-placement="top"
                                                   data-original-title="{{ trans('message.more_iamges') }}"
                                                   name="images[]" placeholder="images" type="file"
                                                   multiple/>
                                            <div class="help-block text-left">
                                                {{ trans('message.best_fit',['width' => '1080 px', 'height' => '1440 px']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" name="instagram" placeholder="..."
                                                   value="{{ $element->instagram }}">
                                            <label for="form_control_1">{{ trans('general.instagram') }}</label>
                                            <span class="help-block">{{ trans('general.full_link') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" name="snapchat" placeholder="..."
                                                   value="{{ $element->snapchat }}">
                                            <label for="form_control_1">{{ trans('general.snapchat') }}</label>
                                            <span class="help-block">{{ trans('general.full_link') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" name="twitter" placeholder="..."
                                                   value="{{ $element->twitter }}">
                                            <label for="form_control_1">{{ trans('general.twitter') }}</label>
                                            <span class="help-block">{{ trans('general.full_link') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" name="youtube" placeholder="..."
                                                   value="{{ $element->youtube }}">
                                            <label for="form_control_1">{{ trans('general.youtube') }}</label>
                                            <span class="help-block">{{ trans('general.full_link') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" name="facebook" placeholder="..."
                                                   value="{{ $element->facebook }}">
                                            <label for="form_control_1">{{ trans('general.facebook') }}</label>
                                            <span class="help-block">{{ trans('general.full_link') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" name="phone" placeholder="..."
                                                   value="{{ $element->phone }}">
                                            <label for="form_control_1">{{ trans('general.phone') }}</label>
                                            <span class="help-block">{{ trans('general.full_link') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" name="mobile" placeholder="..."
                                                   value="{{ $element->mobile }}">
                                            <label for="form_control_1">{{ trans('general.mobile') }}</label>
                                            <span class="help-block">{{ trans('general.full_link') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" name="whatsapp" placeholder="..."
                                                   value="{{ $element->whatsapp }}">
                                            <label for="form_control_1">{{ trans('general.whatsapp') }}</label>
                                            <span class="help-block">{{ trans('general.whatsapp') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" name="address_ar" placeholder="..."
                                                   value="{{ $element->address_ar }}">
                                            <label for="form_control_1">{{ trans('general.address_ar') }}</label>
                                            <span class="help-block">{{ trans('general.address_ar') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" name="address_en" placeholder="..."
                                                   value="{{ $element->address_en }}">
                                            <label for="form_control_1">{{ trans('general.address_en') }}</label>
                                            <span class="help-block">{{ trans('general.address_en') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" name="country_ar" placeholder="..."
                                                   value="{{ $element->country_ar }}">
                                            <label for="form_control_1">{{ trans('general.country_ar') }}</label>
                                            <span class="help-block">{{ trans('general.country_ar') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" name="country_en" placeholder="..."
                                                   value="{{ $element->country_en }}">
                                            <label for="form_control_1">{{ trans('general.country_en') }}</label>
                                            <span class="help-block">{{ trans('general.country_en') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" name="longitude" placeholder="..."
                                                   value="{{ $element->longitude }}">
                                            <label for="form_control_1">{{ trans('general.longitude') }}</label>
                                            <span class="help-block">{{ trans('general.longitude') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" name="latitude" placeholder="..."
                                                   value="{{ $element->latitude }}">
                                            <label for="form_control_1">{{ trans('general.latitude') }}</label>
                                            <span class="help-block">{{ trans('general.latitude') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" name="apple" placeholder="..."
                                                   value="{{ $element->apple }}">
                                            <label for="form_control_1">{{ trans('general.apple_url') }} </label>
                                            <span class="help-block">{{ trans('general.full_link') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" name="android" placeholder="..."
                                                   value="{{ $element->android }}">
                                            <label for="form_control_1">{{ trans('general.android_url') }}</label>
                                            <span class="help-block">{{ trans('general.full_link') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" name="gift_fee" placeholder="..."
                                                   value="{{ $element->gift_fee }}">
                                            <label for="form_control_1">{{ trans('general.gift_fee') }}</label>
                                            <span class="help-block">{{ trans('general.gift_fee') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" name="shipment_notes_ar"
                                                   placeholder="..."
                                                   value="{{ $element->shipment_notes_ar }}">
                                            <label for="form_control_1">{{ trans('general.shipment_notes_arabic') }}</label>
                                            <span class="help-block">Shipment Notes that shall appear on cart Ar</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" name="shipment_notes_en"
                                                   placeholder="..."
                                                   value="{{ $element->shipment_notes_en }}">
                                            <label for="form_control_1">{{ trans('general.shipment_notes_english') }}</label>
                                            <span class="help-block">Shipment Notes that shall appear on Cart</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="policy_ar"
                                               class="control-label">{{ trans('general.policy_ar') }}</label>
                                        <span class="help-block">
                                                <strong>
                                                    {{ trans('message.mobile_only_usage') }}
                                                </strong>
                                            </span>
                                        <span class="help-block">
                                                <strong>
                                                    {{ trans('message.policy_ar') }}
                                                </strong>
                                            </span>
                                        <textarea type="text" class="form-control tooltips tinymce "
                                                  data-container="body" data-placement="top"
                                                  data-original-title="{{ trans('message.policy_ar') }}"
                                                  id="policy_ar" name="policy_ar" aria-multiline="true"
                                                  maxlength="500">
                                                {{ $element->policy_ar }}
                                            </textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="policy_en"
                                               class="control-label">{{ trans('general.policy_en') }}</label>
                                        <span class="help-block">
                                                <strong>
                                                    {{ trans('message.mobile_only_usage') }}
                                                </strong>
                                            </span>
                                        <span class="help-block">
                                                <strong>
                                                    {{ trans('message.policy_en') }}
                                                </strong>
                                            </span>
                                        <textarea type="text" class="form-control tooltips tinymce"
                                                  data-container="body" data-placement="top"
                                                  data-original-title="{{ trans('message.policy_en') }}"
                                                  id="policy_en" name="policy_en" aria-multiline="true"
                                                  maxlength="500">{{ $element->policy_en }}</textarea>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="terms_ar"
                                               class="control-label">{{ trans('general.terms_ar') }}</label>
                                        <span class="help-block">
                                                <strong>
                                                    {{ trans('message.mobile_only_usage') }}
                                                </strong>
                                            </span>
                                        <span class="help-block">
                                                <strong>
                                                    {{ trans('message.terms_ar') }}
                                                </strong>
                                            </span>
                                        <textarea type="text" class="form-control tooltips tinymce "
                                                  data-container="body" data-placement="top"
                                                  data-original-title="{{ trans('message.terms_ar') }}"
                                                  id="terms_ar" name="terms_ar" aria-multiline="true"
                                                  maxlength="500">
                                                {{ $element->terms_ar }}
                                            </textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="terms_en"
                                               class="control-label">{{ trans('general.terms_en') }}</label>
                                        <span class="help-block">
                                                <strong>
                                                    {{ trans('message.mobile_only_usage') }}
                                                </strong>
                                            </span>
                                        <span class="help-block">
                                                <strong>
                                                    {{ trans('message.terms_en') }}
                                                </strong>
                                            </span>
                                        <textarea type="text" class="form-control tooltips tinymce"
                                                  data-container="body" data-placement="top"
                                                  data-original-title="{{ trans('message.terms_en') }}"
                                                  id="terms_en" name="terms_en" aria-multiline="true"
                                                  maxlength="500">{{ $element->terms_en }}</textarea>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                <textarea type="text" class="form-control" id="code" name="code"
                                          aria-multiline="true">{{ $element->code }}</textarea>
                                            <label for="form_control_1">Script Codes</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description"
                                               class="control-label">{{ trans('general.description_arabic') }}</label>
                                        <textarea type="text" class="form-control tooltips"
                                                  data-container="body" data-placement="top"
                                                  data-original-title="{{ trans('message.description_ar') }}"
                                                  id="description_ar" name="description_ar"
                                                  aria-multiline="true"
                                                  rows="5"
                                                  maxlength="1000">{{ $element->description_ar }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description"
                                               class="control-label">{{ trans('general.description_english') }}</label>
                                        <textarea type="text" class="form-control tooltips"
                                                  data-container="body" data-placement="top"
                                                  data-original-title="{{ trans('message.description_en') }}"
                                                  id="description_en" name="description_en"
                                                  aria-multiline="true"
                                                  rows="5"
                                                  maxlength="1000">{{ $element->description_en }}</textarea>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('main_theme_color') ? ' has-error' : '' }}">
                                        <label for="main_theme_color"
                                               class="control-label">{{ trans('general.main_theme_color') }}*</label>
                                        <input type="text" id="hue-demo" class="form-control tooltips demo"
                                               data-container="body"
                                               data-placement="top"
                                               data-original-title="{{ trans('message.main_theme_color') }}"
                                               data-control="hue" name="main_theme_color"
                                               value="{{ $element->main_theme_color }}">
                                        @if ($errors->has('main_theme_color'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('main_theme_color') }}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('main_theme_bg_color') ? ' has-error' : '' }}">
                                        <label for="main_theme_bg_color"
                                               class="control-label">{{ trans('general.main_theme_bg_color') }}*</label>
                                        <input type="text" id="hue-demo" class="form-control tooltips demo"
                                               data-container="body"
                                               data-placement="top"
                                               data-original-title="{{ trans('message.main_theme_bg_color') }}"
                                               data-control="hue" name="main_theme_bg_color"
                                               value="{{ $element->main_theme_bg_color}}">
                                        @if ($errors->has('main_theme_bg_color'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('main_theme_bg_color') }}
                                                </strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('header_one_theme_color') ? ' has-error' : '' }}">
                                        <label for="header_one_theme_color"
                                               class="control-label">{{ trans('general.header_one_theme_color') }}
                                            *</label>
                                        <input type="text" id="hue-demo" class="form-control tooltips demo"
                                               data-container="body"
                                               data-placement="top"
                                               data-original-title="{{ trans('message.header_one_theme_color') }}"
                                               data-control="hue" name="header_one_theme_color"
                                               value="{{ $element->header_one_theme_color}}">
                                        @if ($errors->has('header_one_theme_color'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('header_one_theme_color') }}
                                                </strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('header_tow_theme_color') ? ' has-error' : '' }}">
                                        <label for="header_tow_theme_color"
                                               class="control-label">{{ trans('general.header_tow_theme_color') }}
                                            *</label>
                                        <input type="text" id="hue-demo" class="form-control tooltips demo"
                                               data-container="body"
                                               data-placement="top"
                                               data-original-title="{{ trans('message.header_tow_theme_color') }}"
                                               data-control="hue" name="header_tow_theme_color"
                                               value="{{ $element->header_tow_theme_color}}">
                                        @if ($errors->has('header_tow_theme_color'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('header_tow_theme_color') }}
                                                </strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('header_three_theme_color') ? ' has-error' : '' }}">
                                        <label for="header_three_theme_color"
                                               class="control-label">{{ trans('general.header_three_theme_color') }}
                                            *</label>
                                        <input type="text" id="hue-demo" class="form-control tooltips demo"
                                               data-container="body"
                                               data-placement="top"
                                               data-original-title="{{ trans('message.header_three_theme_color') }}"
                                               data-control="hue" name="header_three_theme_color"
                                               value="{{ $element->header_three_theme_color}}">
                                        @if ($errors->has('header_three_theme_color'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('header_three_theme_color') }}
                                                </strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('header_one_theme_bg') ? ' has-error' : '' }}">
                                        <label for="header_one_theme_bg"
                                               class="control-label">{{ trans('general.header_one_theme_bg') }}*</label>
                                        <input type="text" id="hue-demo" class="form-control tooltips demo"
                                               data-container="body"
                                               data-placement="top"
                                               data-original-title="{{ trans('message.header_one_theme_bg') }}"
                                               data-control="hue" name="header_one_theme_bg"
                                               value="{{ $element->header_one_theme_bg}}">
                                        @if ($errors->has('header_one_theme_bg'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('header_one_theme_bg') }}
                                                </strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('header_tow_theme_bg') ? ' has-error' : '' }}">
                                        <label for="header_tow_theme_bg"
                                               class="control-label">{{ trans('general.header_tow_theme_bg') }}*</label>
                                        <input type="text" id="hue-demo" class="form-control tooltips demo"
                                               data-container="body"
                                               data-placement="top"
                                               data-original-title="{{ trans('message.header_tow_theme_bg') }}"
                                               data-control="hue" name="header_tow_theme_bg"
                                               value="{{ $element->header_tow_theme_bg}}">
                                        @if ($errors->has('header_tow_theme_bg'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('header_tow_theme_bg') }}
                                                </strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('header_three_theme_bg') ? ' has-error' : '' }}">
                                        <label for="header_three_theme_bg"
                                               class="control-label">{{ trans('general.header_three_theme_bg') }}
                                            *</label>
                                        <input type="text" id="hue-demo" class="form-control tooltips demo"
                                               data-container="body"
                                               data-placement="top"
                                               data-original-title="{{ trans('message.header_three_theme_bg') }}"
                                               data-control="hue" name="header_three_theme_bg"
                                               value="{{ $element->header_three_theme_bg}}">
                                        @if ($errors->has('header_three_theme_bg'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('header_three_theme_bg') }}
                                                </strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('normal_text_theme_color') ? ' has-error' : '' }}">
                                        <label for="normal_text_theme_color"
                                               class="control-label">{{ trans('general.normal_text_theme_color') }}
                                            *</label>
                                        <input type="text" id="hue-demo" class="form-control tooltips demo"
                                               data-container="body"
                                               data-placement="top"
                                               data-original-title="{{ trans('message.normal_text_theme_color') }}"
                                               data-control="hue" name="normal_text_theme_color"
                                               value="{{ $element->normal_text_theme_color}}">
                                        @if ($errors->has('normal_text_theme_color'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('normal_text_theme_color') }}
                                                </strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('btn_text_theme_color') ? ' has-error' : '' }}">
                                        <label for="btn_text_theme_color"
                                               class="control-label">{{ trans('general.btn_text_theme_color') }}
                                            *</label>
                                        <input type="text" id="hue-demo" class="form-control tooltips demo"
                                               data-container="body"
                                               data-placement="top"
                                               data-original-title="{{ trans('message.btn_text_theme_color') }}"
                                               data-control="hue" name="btn_text_theme_color"
                                               value="{{ $element->btn_text_theme_color}}">
                                        @if ($errors->has('btn_text_theme_color'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('btn_text_theme_color') }}
                                                </strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('btn_text_hover_theme_color') ? ' has-error' : '' }}">
                                        <label for="btn_text_hover_theme_color"
                                               class="control-label">{{ trans('general.btn_text_hover_theme_color') }}
                                            *</label>
                                        <input type="text" id="hue-demo" class="form-control tooltips demo"
                                               data-container="body"
                                               data-placement="top"
                                               data-original-title="{{ trans('message.btn_text_hover_theme_color') }}"
                                               data-control="hue" name="btn_text_hover_theme_color"
                                               value="{{ $element->btn_text_hover_theme_color}}">
                                        @if ($errors->has('btn_text_hover_theme_color'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('btn_text_hover_theme_color') }}
                                                </strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('btn_bg_theme_color') ? ' has-error' : '' }}">
                                        <label for="btn_bg_theme_color"
                                               class="control-label">{{ trans('general.btn_bg_theme_color') }}*</label>
                                        <input type="text" id="hue-demo" class="form-control tooltips demo"
                                               data-container="body"
                                               data-placement="top"
                                               data-original-title="{{ trans('message.btn_bg_theme_color') }}"
                                               data-control="hue" name="btn_bg_theme_color"
                                               value="{{ $element->btn_bg_theme_color}}">
                                        @if ($errors->has('btn_bg_theme_color'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('btn_bg_theme_color') }}
                                                </strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('menu_theme_color') ? ' has-error' : '' }}">
                                        <label for="menu_theme_color"
                                               class="control-label">{{ trans('general.menu_theme_color') }}*</label>
                                        <input type="text" id="hue-demo" class="form-control tooltips demo"
                                               data-container="body"
                                               data-placement="top"
                                               data-original-title="{{ trans('message.menu_theme_color') }}"
                                               data-control="hue" name="menu_theme_color"
                                               value="{{ $element->menu_theme_color}}">
                                        @if ($errors->has('menu_theme_color'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('menu_theme_color') }}
                                                </strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('menu_theme_bg') ? ' has-error' : '' }}">
                                        <label for="menu_theme_bg"
                                               class="control-label">{{ trans('general.menu_theme_bg') }}*</label>
                                        <input type="text" id="hue-demo" class="form-control tooltips demo"
                                               data-container="body"
                                               data-placement="top"
                                               data-original-title="{{ trans('message.menu_theme_bg') }}"
                                               data-control="hue" name="menu_theme_bg"
                                               value="{{ $element->menu_theme_bg}}">
                                        @if ($errors->has('menu_theme_bg'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('menu_theme_bg') }}
                                                </strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('header_theme_color') ? ' has-error' : '' }}">
                                        <label for="header_theme_color"
                                               class="control-label">{{ trans('general.header_theme_color') }}*</label>
                                        <input type="text" id="hue-demo" class="form-control tooltips demo"
                                               data-container="body"
                                               data-placement="top"
                                               data-original-title="{{ trans('message.header_theme_color') }}"
                                               data-control="hue" name="header_theme_color"
                                               value="{{ $element->header_theme_color}}">
                                        @if ($errors->has('main_theme_color'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('main_theme_color') }}
                                                </strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('header_theme_bg') ? ' has-error' : '' }}">
                                        <label for="header_theme_bg"
                                               class="control-label">{{ trans('general.header_theme_bg') }}*</label>
                                        <input type="text" id="hue-demo" class="form-control tooltips demo"
                                               data-container="body"
                                               data-placement="top"
                                               data-original-title="{{ trans('message.header_theme_bg') }}"
                                               data-control="hue" name="header_theme_bg"
                                               value="{{ $element->header_theme_bg}}">
                                        @if ($errors->has('main_theme_color'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('main_theme_color') }}
                                                </strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('footer_theme_color') ? ' has-error' : '' }}">
                                        <label for="footer_theme_color"
                                               class="control-label">{{ trans('general.footer_theme_color') }}*</label>
                                        <input type="text" id="hue-demo" class="form-control tooltips demo"
                                               data-container="body"
                                               data-placement="top"
                                               data-original-title="{{ trans('message.footer_theme_color') }}"
                                               data-control="hue" name="footer_theme_color"
                                               value="{{ $element->footer_theme_color}}">
                                        @if ($errors->has('footer_theme_color'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('footer_theme_color') }}
                                                </strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('footer_bg_theme_color') ? ' has-error' : '' }}">
                                        <label for="footer_bg_theme_color"
                                               class="control-label">{{ trans('general.footer_bg_theme_color') }}
                                            *</label>
                                        <input type="text" id="hue-demo" class="form-control tooltips demo"
                                               data-container="body"
                                               data-placement="top"
                                               data-original-title="{{ trans('message.footer_bg_theme_color') }}"
                                               data-control="hue" name="footer_bg_theme_color"
                                               value="{{ $element->footer_bg_theme_color}}">
                                        @if ($errors->has('footer_bg_theme_color'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('footer_bg_theme_color') }}
                                                </strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('icon_theme_color') ? ' has-error' : '' }}">
                                        <label for="icon_theme_color"
                                               class="control-label">{{ trans('general.icon_theme_color') }}*</label>
                                        <input type="text" id="hue-demo" class="form-control tooltips demo"
                                               data-container="body"
                                               data-placement="top"
                                               data-original-title="{{ trans('message.icon_theme_color') }}"
                                               data-control="hue" name="icon_theme_color"
                                               value="{{ $element->icon_theme_color}}">
                                        @if ($errors->has('icon_theme_color'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('icon_theme_color') }}
                                                </strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('icon_theme_bg') ? ' has-error' : '' }}">
                                        <label for="icon_theme_bg"
                                               class="control-label">{{ trans('general.icon_theme_bg') }}*</label>
                                        <input type="text" id="hue-demo" class="form-control tooltips demo"
                                               data-container="body"
                                               data-placement="top"
                                               data-original-title="{{ trans('message.icon_theme_bg') }}"
                                               data-control="hue" name="icon_theme_bg"
                                               value="{{ $element->footer_theme_color}}">
                                        @if ($errors->has('icon_theme_bg'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('icon_theme_bg') }}
                                                </strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    @can('index', 'commercial')
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label sbold tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.show_commercials') }}">{{ trans('general.show_commercials') }}</label></br>
                                                <label class="radio-inline">
                                                    <input type="radio" name="show_commercials" id="optionsRadios3"
                                                           {{ $element->show_commercials ? 'checked' : null  }}
                                                           value="1">
                                                    {{ trans('general.yes') }}</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="show_commercials" id="optionsRadios4"
                                                           {{ !$element->show_commercials ? 'checked' : null  }}
                                                           value="0">
                                                    {{ trans('general.no') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label sbold tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.splash_on') }}">{{ trans('general.splash_on') }}</label></br>
                                                <label class="radio-inline">
                                                    <input type="radio" name="splash_on" id="optionsRadios3"
                                                           {{ $element->splash_on ? 'checked' : null  }}
                                                           value="1">
                                                    {{ trans('general.yes') }}</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="splash_on" id="optionsRadios4"
                                                           {{ !$element->splash_on ? 'checked' : null  }}
                                                           value="0">
                                                    {{ trans('general.no') }}</label>
                                            </div>

                                        </div>
                                    @endcan
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label sbold tooltips"
                                                   data-container="body" data-placement="top"
                                                   data-original-title="{{ trans('message.cash_on_delivery') }}">{{ trans('general.cash_on_delivery') }}</label></br>
                                            <label class="radio-inline">
                                                <input type="radio" name="cash_on_delivery" id="optionsRadios3"
                                                       {{ $element->cash_on_delivery ? 'checked' : null  }}
                                                       value="1">
                                                {{ trans('general.yes') }}</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="cash_on_delivery" id="optionsRadios4"
                                                       {{ !$element->cash_on_delivery ? 'checked' : null  }}
                                                       value="0">
                                                {{ trans('general.no') }}</label>
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label sbold tooltips"
                                                   data-container="body" data-placement="top"
                                                   data-original-title="{{ trans('message.shipment_fixed_rate') }}">{{ trans('general.shipment_fixed_rate') }}</label></br>
                                            <label class="radio-inline">
                                                <input type="radio" name="shipment_fixed_rate" id="optionsRadios3"
                                                       {{ $element->shipment_fixed_rate ? 'checked' : null  }}
                                                       value="1">
                                                {{ trans('general.yes') }}</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="shipment_fixed_rate" id="optionsRadios4"
                                                       {{ !$element->shipment_fixed_rate ? 'checked' : null  }}
                                                       value="0">
                                                {{ trans('general.no') }}</label>
                                        </div>
                                    </div>
                                    @can('isSuper')
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">{{ trans('general.payment_method') }}
                                                        *</label>
                                                    <select name="payment_method" class="form-control  tooltips"
                                                            data-container="body"
                                                            data-placement="top"
                                                            data-original-title="{{ trans('message.payment_method') }}"
                                                    >
                                                        <option>{{ trans('general.choose_payment_method') }}</option>
                                                        <option value="myfatoorah" {{ $element->payment_method === 'myfatoorah' ? 'selected' : null }}>
                                                            My Fatoorah
                                                        </option>
                                                        <option value="tap" {{ $element->payment_method === 'tap' ? 'selected' : null }}>
                                                            Tap
                                                        </option>
                                                        <option value="upayment" {{ $element->payment_method === 'upayment' ? 'selected' : null }}>
                                                            Upayment
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @include('backend.partials.forms._btn-group')
                    </form>
                </div>
            </div>

            <div class="portlet-body form">
                <div class="col-lg-12">
                    @include('backend.partials._element_images',['images' => $element->images])
                </div>
            </div>
        </div>
    </div>
@endsection
