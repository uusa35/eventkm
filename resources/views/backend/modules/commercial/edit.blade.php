@extends('backend.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.admin.commercial.edit', $element) }}
@endsection
@section('content')
    <div class="portlet box blue">
        @include('backend.partials.forms.form_title',['title' => trans('general.edit_commercial')])
        <div class="portlet-body">
            @include('backend.partials._admin_instructions',['title' => trans('general.commercials') ,'message' => trans('message.edit_commercial')])
            <div class="portlet-body form">
                <form class="horizontal-form" role="form" method="POST"
                      action="{{ route('backend.admin.commercial.update', $element->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-body">
                        <h3 class="form-section">{{ trans('general.edit_commercial') }}</h3>
                        <div class="portlet box blue ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i> {{ trans('general.main_details') }}
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('name_ar') ? ' has-error' : '' }}">
                                                <label for="name_ar"
                                                       class="control-label">{{ trans('general.name_ar') }}*</label>
                                                <input id="name_ar" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.name_ar') }}"
                                                       name="name_ar" value="{{ $element->name_ar }}"
                                                       placeholder="{{ trans('general.name_ar') }}"  autofocus>
                                                @if ($errors->has('name_ar'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('name_ar') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('name_en') ? ' has-error' : '' }}">
                                                <label for="name_en"
                                                       class="control-label">{{ trans('general.name_en') }}*</label>
                                                <input id="name_en" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.name_en') }}"
                                                       name="name_en" value="{{ $element->name_en }}"
                                                       placeholder="{{ trans('general.name_en') }}" autofocus>
                                                @if ($errors->has('name_en'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('name_en') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('caption_ar') ? ' has-error' : '' }}">
                                                <label for="caption_ar"
                                                       class="control-label">{{ trans('general.caption_ar') }}*</label>
                                                <input id="caption_ar" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.caption_ar') }}"
                                                       name="caption_ar" value="{{ $element->caption_ar }}"
                                                       placeholder="{{ trans('general.caption_ar') }}"
                                                       autofocus>
                                                @if ($errors->has('caption_ar'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('caption_ar') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('caption_en') ? ' has-error' : '' }}">
                                                <label for="caption_en"
                                                       class="control-label">{{ trans('general.caption_en') }}*</label>
                                                <input id="caption_en" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.caption_en') }}"
                                                       name="caption_en" value="{{ $element->caption_en }}"
                                                       placeholder="{{ trans('general.caption_en') }}"
                                                       autofocus>
                                                @if ($errors->has('caption_en'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('caption_en') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        @can('isAdminOrAbove')
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group">
                                                    <label for="single"
                                                           class="control-label required">{{ trans('general.owner') }}
                                                        *</label>
                                                    <select name="user_id" class="form-control tooltips"
                                                            data-container="body" data-placement="top"
                                                            data-original-title="{{ trans('message.owner') }}">
                                                        <option
                                                            value="">{{ trans('general.choose_user') }}</option>
                                                        @foreach($users as $user)
                                                            <option
                                                                value="{{ $user->id }}" {{ $element->user_id == $user->id ? 'selected' : null  }}>{{ $user->slug }}
                                                                - {{ $user->id }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @else
                                            <input type="hidden" name="user_id"
                                                   value="{{ auth()->id()}}">
                                        @endcan
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                                                <label for="end_date"
                                                       class="control-label required">{{ trans('general.end_date') }}*</label>
                                                <div class="input-group date form_datetime">
                                                    <input type="text" readonly style="direction: ltr !important;"
                                                           class="form-control tooltips" data-container="body"
                                                           data-placement="top"
                                                           data-original-title="{{ trans('message.end_date') }}"
                                                           name="end_date"
                                                           value="{{ $element->end_date ? $element->end_date : '01 January 2019 - 07:55' }}"
                                                           required>
                                                    <span class="input-group-btn"><button class="btn default date-set"
                                                                                          type="button"><i
                                                                class="fa fa-calendar"></i></button></span>
                                                </div>
                                                <span class="help-block">
                                                <strong>{{ trans('message.end_date') }}</strong>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('order') ? ' has-error' : '' }}">
                                                <label for="order" class="control-label">{{ trans('general.sequence') }}
                                                    *</label>
                                                <input id="order" type="number" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.sequence') }}"
                                                       name="order"
                                                       value="{{ $element->order }}"
                                                       placeholder="{{ trans('general.sequence') }}" maxlength="2"
                                                       autofocus>
                                                @if ($errors->has('order'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('order') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label for="file"
                                                       class="control-label required">{{ trans('general.main_image') }}
                                                    *</label>
                                                <input class="form-control tooltips"
                                                       data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.main_image') }}"
                                                       name="image" placeholder="images" type="file"/>
                                                <div class="help-block text-left">
                                                    {{ trans('message.best_fit',['width' => '1080 px', 'height' => '1440']) }}
                                                </div>
                                                <div class="help-block text-left">
                                                    <a href="{{ url('https://photopea.com') }}" target="_blank">
                                                        {{ trans('general.image_url') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            @if($element->image)
                                                <img class="img-responsive img-sm"
                                                     src="{{ $element->imageThumbLink }}"
                                                     alt="">
                                                <a href="{{ route("backend.admin.image.clear",['model' => 'commercial', 'id' => $element->id ]) }}"><i
                                                        class="fa fa-fw fa-times"></i></a>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="form_control_1">{{ trans('general.url') }}</label>
                                                <input type="text" class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.url') }}" name="url"
                                                       type="url"
                                                       placeholder="{{ trans('general.url') }}">
                                                <div class="help-block text-left">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="form_control_1">{{ trans('general.image_path') }}</label>
                                                <input type="file" class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.path') }}"
                                                       name="path" placeholder="{{ trans('general.path') }}"
                                                >
                                                name="path" placeholder="{{ trans('general.image_path') }}">
                                                <div class="help-block text-left">

                                                </div>
                                            </div>
                                        </div>
                                        @if(!$categories->isEmpty())
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">{{ trans('general.categories') }}
                                                        *</label>
                                                    <select multiple="multiple" class="multi-select"
                                                            id="my_multi_select1" name="categories[]">
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                    {{ in_array($category->id,$element->categories->pluck('id')->unique()->flatten()->toArray()) ? 'selected' : null }}
                                                                    style="background-color: {{ $category->isParent ? 'lightblue' : null  }}">
                                                                {{ $category->name }}</option>
                                                            @if(!$category->children->isEmpty())
                                                                @foreach($category->children as $child)
                                                                    <option value="{{ $child->id }}"
                                                                            {{ in_array($child->id,$element->categories->pluck('id')->unique()->flatten()->toArray()) ? 'selected' : null }}
                                                                            style="padding-left: 15px">
                                                                        {{ $child->name }}</option>
                                                                    @if(!$child->children->isEmpty())
                                                                        @foreach($child->children as $subChild)
                                                                            <option value="{{ $subChild->id }}"
                                                                                    {{ in_array($subChild->id,$element->categories->pluck('id')->unique()->flatten()->toArray()) ? 'selected' : null }}
                                                                                    style="padding-left: 35px">
                                                                                {{ $subChild->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    {{-- <span class="help-block">
                                                                                                                                        <strong>{{ trans('message.categories_instructions') }}</strong>
                                                    </span> --}}
                                                </div>
                                            </div>
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
                                        <div class="col-lg-4 col-md-6">
                                            <div
                                                class="form-group{{ $errors->has('whatsapp') ? ' has-error' : '' }}">
                                                <label for="whatsapp"
                                                       class="control-label">{{ trans('general.whatsapp') }}
                                                    (ex.: 96565XX2XXX)</label>
                                                <input id="whatsapp" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.whatsapp') }}"
                                                       name="whatsapp"
                                                       placeholder="{{ trans('general.mobile_example') }}"
                                                       value="{{ $element->whatsapp }}" autofocus>
                                                @if ($errors->has('whatsapp'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('whatsapp') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div
                                                class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                                <label for="mobile"
                                                       class="control-label">{{ trans('general.mobile') }}
                                                    (ex.: 96565XX2XXX)</label>
                                                <input id="mobile" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.mobile') }}"
                                                       name="mobile"
                                                       placeholder="{{ trans('general.mobile_example') }}"
                                                       value="{{ $element->mobile }}" autofocus>
                                                @if ($errors->has('mobile'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('mobile') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div
                                                class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                                                <label for="website"
                                                       class="control-label">{{ trans('general.website') }}</label>
                                                <input id="website" type="url" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.website') }}"
                                                       name="website"
                                                       placeholder="{{ trans('general.website') }}"
                                                       value="{{ $element->website }}" autofocus>
                                                @if ($errors->has('website'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('website') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div
                                                class="form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
                                                <label for="facebook"
                                                       class="control-label">{{ trans('general.facebook') }}</label>
                                                <input id="facebook" type="url" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.facebook') }}"
                                                       name="facebook"
                                                       placeholder="{{ trans('general.facebook') }}"
                                                       value="{{ $element->facebook }}" autofocus>
                                                @if ($errors->has('facebook'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('facebook') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div
                                                class="form-group{{ $errors->has('instagram') ? ' has-error' : '' }}">
                                                <label for="instagram"
                                                       class="control-label">{{ trans('general.instagram') }}</label>
                                                <input id="instagram" type="url" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.instagram') }}"
                                                       name="instagram"
                                                       placeholder="{{ trans('general.instagram') }}"
                                                       value="{{ $element->instagram }}" autofocus>
                                                @if ($errors->has('instagram'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('instagram') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div
                                                class="form-group{{ $errors->has('youtube') ? ' has-error' : '' }}">
                                                <label for="youtube"
                                                       class="control-label">{{ trans('general.youtube') }}</label>
                                                <input id="youtube" type="url" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.youtube') }}"
                                                       name="youtube"
                                                       placeholder="{{ trans('general.youtube') }}"
                                                       value="{{ $element->youtube }}" autofocus>
                                                @if ($errors->has('youtube'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('youtube') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div
                                                class="form-group{{ $errors->has('twitter') ? ' has-error' : '' }}">
                                                <label for="twitter"
                                                       class="control-label">{{ trans('general.twitter') }}</label>
                                                <input id="twitter" type="url" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.twitter') }}"
                                                       name="twitter"
                                                       placeholder="{{ trans('general.twitter') }}"
                                                       value="{{ $element->twitter }}" autofocus>
                                                @if ($errors->has('twitter'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('twitter') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div
                                                class="form-group{{ $errors->has('longitude') ? ' has-error' : '' }}">
                                                <label for="longitude"
                                                       class="control-label">{{ trans('general.longitude') }}</label>
                                                <input id="longitude" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.longitude') }}"
                                                       name="longitude"
                                                       placeholder="{{ trans('general.longitude') }}"
                                                       value="{{ $element->longitude }}" autofocus>
                                                @if ($errors->has('longitude'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('longitude') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div
                                                class="form-group{{ $errors->has('latitude') ? ' has-error' : '' }}">
                                                <label for="latitude"
                                                       class="control-label">{{ trans('general.latitude') }}</label>
                                                <input id="latitude" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.latitude') }}"
                                                       name="latitude"
                                                       placeholder="{{ trans('general.latitude') }}"
                                                       value="{{ $element->latitude }}" autofocus>
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

                        <div class="portlet box blue ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i> {{ trans('general.more_details') }}
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="form-body">
                                    <div class="row">
                                        @can('isAdminOrAbove')
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label sbold tooltips" data-container="body"
                                                           data-placement="top"
                                                           data-original-title="{{ trans('message.active') }}">{{ trans('general.active') }}</label></br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="active" id="optionsRadios3" {{ $element->active ? 'checked' : null }}
                                                               value="1">
                                                        {{ trans('general.yes') }}</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="active" id="optionsRadios4" value="0" {{ !$element->active ? 'checked' : null }}>
                                                        {{ trans('general.no') }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label sbold tooltips" data-container="body"
                                                           data-placement="top"
                                                           data-original-title="{{ trans('message.on_home') }}">{{ trans('general.on_home') }}</label></br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="on_home" id="optionsRadios3" {{ $element->on_home ? 'checked' : null }}
                                                               value="1">
                                                        {{ trans('general.yes') }}</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="on_home" id="optionsRadios4" {{ !$element->on_home ? 'checked' : null }}
                                                               value="0">
                                                        {{ trans('general.no') }}
                                                    </label>
                                                </div>
                                            </div>
                                        @else
                                            <input type="hidden" value="1" name="active">
                                        @endcan

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label sbold tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.is_double') }}">{{ trans('general.is_double') }}</label></br>
                                                <label class="radio-inline">
                                                    <input type="radio" name="is_double" id="optionsRadios3" value="1" {{ $element->is_double ? 'checked' : null }}>
                                                    {{ trans('general.yes') }}</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="is_double" id="optionsRadios4" {{ !$element->is_double ? 'checked' : null }}
                                                           value="0">
                                                    {{ trans('general.no') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label sbold tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.is_triple') }}">{{ trans('general.is_triple') }}</label></br>
                                                <label class="radio-inline">
                                                    <input type="radio" name="is_triple" id="optionsRadios3" value="1" {{ $element->is_triple ? 'checked' : null }}>
                                                    {{ trans('general.yes') }}</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="is_triple" id="optionsRadios4" {{ !$element->is_triple ? 'checked' : null }}
                                                           value="0">
                                                    {{ trans('general.no') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @include('backend.partials.forms._btn-group')
            </div>
        </div>
    </div>
    </form>
    </div>
    </div>
@endsection
