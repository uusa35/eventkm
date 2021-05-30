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
                                    <div class="form-group">
                                        <label for="form_control_1">{{ trans('general.name_ar') }}*</label>
                                        <input type="text" class="form-control" name="company_ar" placeholder="..."
                                               value="{{ $element->company_ar }}">
                                        <span class="help-block">{{ trans('general.company_name_arabic') }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="form_control_1">{{ trans('general.name_en') }}*</label>
                                        <input type="text" class="form-control" name="company_en" placeholder="..."
                                               value="{{ $element->company_en }}">
                                        <span class="help-block">{{ trans('general.company_name_en') }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="form_control_1">{{ trans('general.email') }}</label>
                                        <input type="text" class="form-control" name="email" placeholder="..."
                                               value="{{ $element->email }}">
                                        <span class="help-block">{{ trans("general.email") }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="form_control_1">{{ trans('general.web_site_logo') }}</label>
                                            <input type="file" class="form-control" name="logo" placeholder="...">
                                            <div class="help-block text-left">
                                                {{ trans('message.best_fit',['width' => '1024 px', 'height' => '1024px']) }}
                                            </div>
                                            <div class="help-block text-left">
                                                <a href="{{ url('http://photopea.com') }}" target="_blank"
                                                   class="text-info">
                                                    {{ trans('general.image_url') }}
                                                </a>
                                            </div>
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
                                        <div class="form-group">
                                            <label for="form_control_1">{{ trans('general.app_logo') }}
                                            </label>
                                            <input type="file" class="form-control" name="app_logo" placeholder="...">
                                            <span class="help-block">
                                                {{ trans('message.best_fit',['width' => '600 px', 'height' => '221px']) }}</span>
                                            <span class="help-block">
                                            <a href="{{ url('http://photopea.com') }}" target="_blank"
                                               class="text-info">
                                                {{ trans('general.image_url') }}
                                            </a></span>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        @if($element->app_logo)
                                            <a href="{{ $element->getCurrentImageAttribute('app_logo') }}">
                                                <img class="img-responsive img-sm"
                                                     src="{{ $element->getCurrentImageAttribute('app_logo') }}"
                                                     alt="">
                                            </a>
                                            <a href="{{ route("backend.admin.image.clear",['model' => 'setting', 'id' => $element->id ,'colName' => 'app_logo']) }}"><i
                                                    class="fa fa-fw fa-times"></i></a>
                                        @endif
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="form_control_1">{{ trans('general.menu_bg') }}*
                                            </label>
                                            <input type="file" class="form-control" name="menu_bg" placeholder="...">
                                            <span class="help-block">
                                                {{ trans('message.best_fit',['width' => '1242 px', 'height' => '2688px']) }}
                                    </span>
                                            <span class="help-block text-left">
                                                <a href="{{ url('http://photopea.com') }}" target="_blank"
                                                   class="text-info">
                                                    {{ trans('general.image_url') }}
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        @if($element->menu_bg)
                                            <a href="{{ asset(env('THUMBNAIL').$element->menu_bg)}}">
                                                <img class="img-responsive img-sm"
                                                     style="max-height: 100px; max-width : 100px;"
                                                     src="{{ asset(env('THUMBNAIL').$element->menu_bg)}}"
                                                     alt="">
                                            </a>
                                            <a href="{{ route("backend.admin.image.clear",['model' => 'setting', 'id' => $element->id ,'colName' => 'menu_bg']) }}"><i
                                                    class="fa fa-fw fa-times"></i></a>
                                        @endif
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="form_control_1">{{ trans('general.mobile_app_home_bg') }}
                                            </label>
                                            <input type="file" class="form-control" name="main_bg" placeholder="...">
                                            <span class="help-block">
                                                {{ trans('message.best_fit',['width' => '1242 px', 'height' => '2688px']) }}
                                            </span>
                                            <span class="help-block text-left">
                                                <a href="{{ url('http://photopea.com') }}" target="_blank"
                                                   class="text-info">
                                                    {{ trans('general.image_url') }}
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    @if($element->main_bg)
                                        <div class="col-lg-1">
                                            <a href="{{ $element->getCurrentImageAttribute('main_bg') }}">
                                                <img class="img-responsive img-sm"
                                                     style="max-height: 100px; max-width : 100px;"
                                                     src="{{ $element->getCurrentImageAttribute('main_bg') }}"
                                                     alt="">
                                            </a>
                                            <a href="{{ route("backend.admin.image.clear",['model' => 'setting', 'id' => $element->id ,'colName' => 'main_bg']) }}"><i
                                                    class="fa fa-fw fa-times"></i></a>
                                        </div>
                                    @endif
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label
                                                for="form_control_1">{{ trans('general.global_size_chart') }}</label>
                                            <input type="file" class="form-control" name="size_chart"
                                                   placeholder="...">
                                            <div class="help-block text-left">
                                                {{ trans('message.best_fit',['width' => '1080 px', 'height' => '1440 px']) }}
                                            </div>
                                            <span class="help-block text-left">
                                                <a href="{{ url('http://photopea.com') }}" target="_blank"
                                                   class="text-info">
                                                    {{ trans('general.image_url') }}
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        @if($element->size_chart)
                                            <a href="{{ $element->getCurrentImageAttribute('size_chart') }}">
                                                <img class="img-responsive img-sm"
                                                     style="max-height: 100px; max-width : 100px;"
                                                     src="{{ $element->getCurrentImageAttribute('size_chart') }}"
                                                     alt="">
                                            </a>
                                            <a href="{{ route("backend.admin.image.clear",['model' => 'setting', 'id' => $element->id ,'colName' => 'size_chart']) }}"><i
                                                    class="fa fa-fw fa-times"></i></a>
                                        @endif
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label
                                                for="form_control_1">{{ trans('general.fixed_shipment_fees') }}</label>
                                            <input type="file" class="form-control" name="shipment_prices"
                                                   placeholder="...">
                                            <div class="help-block text-left">
                                                {{ trans('message.best_fit',['width' => '1080 px', 'height' => '1850 px']) }}
                                            </div>
                                            <span class="help-block text-left">
                                                <a href="{{ url('http://photopea.com') }}" target="_blank"
                                                   class="text-info">
                                                    {{ trans('general.image_url') }}
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        @if($element->shipment_prices)
                                            <a href="{{ $element->getCurrentImageAttribute('shipment_prices') }}">
                                                <img class="img-responsive img-sm"
                                                     style="max-height: 100px; max-width : 100px;"
                                                     src="{{ $element->getCurrentImageAttribute('shipment_prices') }}"
                                                     alt="">
                                            </a>
                                            <a href="{{ route("backend.admin.image.clear",['model' => 'setting', 'id' => $element->id ,'colName' => 'shipment_prices']) }}"><i
                                                    class="fa fa-fw fa-times"></i></a>
                                        @endif
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="form_control_1">{{ trans('general.gift_image') }}
                                            </label>
                                            <input type="file" class="form-control" name="gift_image" placeholder="...">
                                            <span class="help-block">
                                                {{ trans('message.best_fit',['width' => '750 px', 'height' => ' 750 px']) }}</span>
                                            <span class="help-block text-left">
                                                <a href="{{ url('http://photopea.com') }}" target="_blank"
                                                   class="text-info">
                                                    {{ trans('general.image_url') }}
                                                </a>
                                            </span>
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
                                            <span class="help-block text-left">
                                                <a href="{{ url('http://photopea.com') }}" target="_blank"
                                                   class="text-info">
                                                    {{ trans('general.image_url') }}
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="form_control_1">{{ trans('general.instagram') }}</label>
                                        <input type="text" class="form-control" name="instagram" placeholder="..."
                                               value="{{ $element->instagram }}">
                                        <span class="help-block">{{ trans('general.full_link') }}</span>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="form_control_1">{{ trans('general.snapchat') }}</label>
                                        <input type="text" class="form-control" name="snapchat" placeholder="..."
                                               value="{{ $element->snapchat }}">
                                        <span class="help-block">{{ trans('general.full_link') }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="form_control_1">{{ trans('general.twitter') }}</label>
                                        <input type="text" class="form-control" name="twitter" placeholder="..."
                                               value="{{ $element->twitter }}">
                                        <span class="help-block">{{ trans('general.full_link') }}</span>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="form_control_1">{{ trans('general.youtube') }}</label>
                                        <input type="text" class="form-control" name="youtube" placeholder="..."
                                               value="{{ $element->youtube }}">
                                        <span class="help-block">{{ trans('general.full_link') }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="form_control_1">{{ trans('general.facebook') }}</label>
                                        <input type="text" class="form-control" name="facebook" placeholder="..."
                                               value="{{ $element->facebook }}">
                                        <span class="help-block">{{ trans('general.full_link') }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="form_control_1">{{ trans('general.phone') }}</label>
                                        <input type="text" class="form-control" name="phone" placeholder="..."
                                               value="{{ $element->phone }}">
                                        <span class="help-block">{{ trans('general.full_link') }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="form_control_1">{{ trans('general.mobile') }}</label>
                                        <input type="text" class="form-control" name="mobile" placeholder="..."
                                               value="{{ $element->mobile }}">
                                        <span class="help-block">{{ trans('general.full_link') }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="form_control_1">{{ trans('general.whatsapp') }}</label>
                                        <input type="text" class="form-control" name="whatsapp" placeholder="..."
                                               value="{{ $element->whatsapp }}">
                                        <span class="help-block">{{ trans('general.whatsapp') }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="form_control_1">{{ trans('general.address_ar') }}</label>
                                        <input type="text" class="form-control" name="address_ar" placeholder="..."
                                               value="{{ $element->address_ar }}">
                                        <span class="help-block">{{ trans('general.address_ar') }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="form_control_1">{{ trans('general.address_en') }}</label>
                                        <input type="text" class="form-control" name="address_en" placeholder="..."
                                               value="{{ $element->address_en }}">
                                        <span class="help-block">{{ trans('general.address_en') }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="form_control_1">{{ trans('general.country_ar') }}</label>
                                        <input type="text" class="form-control" name="country_ar" placeholder="..."
                                               value="{{ $element->country_ar }}">
                                        <span class="help-block">{{ trans('general.country_ar') }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="form_control_1">{{ trans('general.country_en') }}</label>
                                        <input type="text" class="form-control" name="country_en" placeholder="..."
                                               value="{{ $element->country_en }}">
                                        <span class="help-block">{{ trans('general.country_en') }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="form_control_1">{{ trans('general.longitude') }}</label>
                                        <input type="text" class="form-control" name="longitude" placeholder="..."
                                               value="{{ $element->longitude }}">
                                        <span class="help-block">{{ trans('general.longitude') }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="form_control_1">{{ trans('general.latitude') }}</label>
                                        <input type="text" class="form-control" name="latitude" placeholder="..."
                                               value="{{ $element->latitude }}">
                                        <span class="help-block">{{ trans('general.latitude') }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="form_control_1">{{ trans('general.apple_url') }} </label>
                                        <input type="text" class="form-control" name="apple" placeholder="..."
                                               value="{{ $element->apple }}">
                                        <span class="help-block">{{ trans('general.full_link') }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="form_control_1">{{ trans('general.android_url') }}</label>
                                        <input type="text" class="form-control" name="android" placeholder="..."
                                               value="{{ $element->android }}">
                                        <span class="help-block">{{ trans('general.full_link') }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="form_control_1">{{ trans('general.gift_fee') }}</label>
                                        <input type="text" class="form-control" name="gift_fee" placeholder="..."
                                               value="{{ $element->gift_fee }}">
                                        <span class="help-block">{{ trans('general.gift_fee') }}</span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label
                                            for="form_control_1">{{ trans('general.shipment_notes_arabic') }}</label>
                                        <input type="text" class="form-control" name="shipment_notes_ar"
                                               placeholder="..."
                                               value="{{ $element->shipment_notes_ar }}">
                                        <span class="help-block">Shipment Notes that shall appear on cart Ar</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label
                                            for="form_control_1">{{ trans('general.shipment_notes_english') }}</label>
                                        <input type="text" class="form-control" name="shipment_notes_en"
                                               placeholder="..."
                                               value="{{ $element->shipment_notes_en }}">
                                        <span class="help-block">Shipment Notes that shall appear on Cart</span>
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
                                    <div class="form-group">
                                <textarea type="text" class="form-control" id="code" name="code"
                                          aria-multiline="true">{{ $element->code }}</textarea>
                                        <label for="form_control_1">Script Codes</label>
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
                                    <div
                                        class="form-group {{ $errors->has('main_theme_bg_color') ? ' has-error' : '' }}">
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
                                    <div
                                        class="form-group {{ $errors->has('header_one_theme_color') ? ' has-error' : '' }}">
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
                                    <div
                                        class="form-group {{ $errors->has('header_tow_theme_color') ? ' has-error' : '' }}">
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
                                    <div
                                        class="form-group {{ $errors->has('header_three_theme_color') ? ' has-error' : '' }}">
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
                                    <div
                                        class="form-group {{ $errors->has('header_one_theme_bg') ? ' has-error' : '' }}">
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
                                    <div
                                        class="form-group {{ $errors->has('header_tow_theme_bg') ? ' has-error' : '' }}">
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
                                    <div
                                        class="form-group {{ $errors->has('header_three_theme_bg') ? ' has-error' : '' }}">
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
                                    <div
                                        class="form-group {{ $errors->has('normal_text_theme_color') ? ' has-error' : '' }}">
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
                                    <div
                                        class="form-group {{ $errors->has('btn_text_theme_color') ? ' has-error' : '' }}">
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
                                    <div
                                        class="form-group {{ $errors->has('btn_text_hover_theme_color') ? ' has-error' : '' }}">
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
                                    <div
                                        class="form-group {{ $errors->has('btn_bg_theme_color') ? ' has-error' : '' }}">
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
                                    <div
                                        class="form-group {{ $errors->has('header_theme_color') ? ' has-error' : '' }}">
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
                                    <div
                                        class="form-group {{ $errors->has('footer_theme_color') ? ' has-error' : '' }}">
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
                                    <div
                                        class="form-group {{ $errors->has('footer_bg_theme_color') ? ' has-error' : '' }}">
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
                                               value="{{ $element->icon_theme_bg}}">
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
                                    @can('isSuper')
                                        <div class="row">
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
                                                           data-original-title="{{ trans('message.pickup_from_branch') }}">{{ trans('general.pickup_from_branch') }}</label></br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="pickup_from_branch"
                                                               id="optionsRadios5"
                                                               {{ $element->pickup_from_branch ? 'checked' : null  }}
                                                               value="1">
                                                        {{ trans('general.yes') }}</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="pickup_from_branch"
                                                               id="optionsRadios6"
                                                               {{ !$element->pickup_from_branch ? 'checked' : null  }}
                                                               value="0">
                                                        {{ trans('general.no') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label sbold tooltips"
                                                           data-container="body" data-placement="top"
                                                           data-original-title="{{ trans('message.global_custome_delivery') }}">{{ trans('general.global_custome_delivery') }}</label></br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="global_custome_delivery"
                                                               id="optionsRadios3"
                                                               {{ $element->global_custome_delivery ? 'checked' : null  }}
                                                               value="1">
                                                        {{ trans('general.yes') }}</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="global_custome_delivery"
                                                               id="optionsRadios4"
                                                               {{ !$element->global_custome_delivery ? 'checked' : null  }}
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
                                                        <input type="radio" name="shipment_fixed_rate"
                                                               id="optionsRadios3"
                                                               {{ $element->shipment_fixed_rate ? 'checked' : null  }}
                                                               value="1">
                                                        {{ trans('general.yes') }}</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="shipment_fixed_rate"
                                                               id="optionsRadios4"
                                                               {{ !$element->shipment_fixed_rate ? 'checked' : null  }}
                                                               value="0">
                                                        {{ trans('general.no') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label sbold tooltips"
                                                           data-container="body" data-placement="top"
                                                           data-original-title="{{ trans('message.multi_cart_merchant') }}">{{ trans('general.multi_cart_merchant') }}</label></br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="multi_cart_merchant"
                                                               id="optionsRadios3"
                                                               {{ $element->multi_cart_merchant ? 'checked' : null  }}
                                                               value="1">
                                                        {{ trans('general.yes') }}</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="multi_cart_merchant"
                                                               id="optionsRadios4"
                                                               {{ !$element->multi_cart_merchant ? 'checked' : null  }}
                                                               value="0">
                                                        {{ trans('general.no') }}</label>
                                                </div>
                                            </div>
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
                                                        <option
                                                            value="myfatoorah" {{ $element->payment_method === 'myfatoorah' ? 'selected' : null }}>
                                                            My Fatoorah
                                                        </option>
                                                        <option
                                                            value="tap" {{ $element->payment_method === 'tap' ? 'selected' : null }}>
                                                            Tap
                                                        </option>
                                                        <option
                                                            value="upayment" {{ $element->payment_method === 'upayment' ? 'selected' : null }}>
                                                            Upayment
                                                        </option>
                                                        <option
                                                            value="ibooky" {{ $element->payment_method === 'ibooky' ? 'selected' : null }}>
                                                            IBooky
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
