@extends('backend.layouts.app')


@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.admin.category.create') }}
@endsection
@section('content')
    <div class="portlet box blue">
        @include('backend.partials.forms.form_title',['title' => trans('general.new_category')])
        <div class="portlet-body">
            @include('backend.partials._admin_instructions',['title' => trans('general.categories') ,'message' => trans('message.new_category')])
            <div class="portlet-body form">
                <form class="horizontal-form" role="form" method="POST"
                      action="{{ route('backend.admin.category.store') }}" enctype="multipart/form-data">
                    @csrf
                    @if(request()->has('parent_id'))
                        <input type="hidden" name="parent_id" value="{{ request()->parent_id }}">
                    @endif
                    <div class="form-body">
                        <h3 class="form-section">{{ trans('general.new_category') }}</h3>
                        <div class="portlet box blue ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i> {{ trans('general.category_main_details') }}
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="form-body">
                                    {{--name arabic / name english --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('name_ar') ? ' has-error' : '' }}">
                                                <label for="name_ar"
                                                       class="control-label">{{ trans('general.name_ar') }}*</label>
                                                <input id="name_ar" type="text" class="form-control" name="name_ar"
                                                       value="{{ old('name_ar') }}"
                                                       placeholder="{{ trans('general.name_ar') }}" required autofocus>
                                                @if ($errors->has('name_ar'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('name_ar') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('name_en') ? ' has-error' : '' }}">
                                                <label for="name_en"
                                                       class="control-label">{{ trans('general.name_en') }}*</label>
                                                <input id="name_en" type="text" class="form-control" name="name_en"
                                                       value="{{ old('name_en') }}"
                                                       placeholder="{{ trans('general.name_en') }}" required autofocus>
                                                @if ($errors->has('name_en'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('name_en') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('caption_ar') ? ' has-error' : '' }}">
                                                <label for="caption_ar"
                                                       class="control-label">{{ trans('general.caption_ar') }}</label>
                                                <input id="caption_ar" type="text" class="form-control"
                                                       name="caption_ar" value="{{ old('caption_ar') }}"
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
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('caption_en') ? ' has-error' : '' }}">
                                                <label for="caption_en"
                                                       class="control-label">{{ trans('general.caption_en') }}</label>
                                                <input id="caption_en" type="text" class="form-control"
                                                       name="caption_en" value="{{ old('caption_en') }}"
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
                                        @can('index','classified')
                                            <div class="col-md-2">
                                                <div class="form-group {{ $errors->has('min') ? ' has-error' : '' }}">
                                                    <label for="min"
                                                           class="control-label">{{ trans('general.min') }}</label>
                                                    <input id="min" type="number" class="form-control" name="min"
                                                           value="{{ old('min')  ? old('min') : 1 }}"
                                                           placeholder="{{ trans('general.min') }}" autofocus>
                                                    @if ($errors->has('min'))
                                                        <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('min') }}
                                                </strong>
                                            </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group {{ $errors->has('max') ? ' has-error' : '' }}">
                                                    <label for="max"
                                                           class="control-label">{{ trans('general.max') }}</label>
                                                    <input id="max" type="number" class="form-control" name="max"
                                                           value="{{ old('max') ? old('max') : 50000 }}"
                                                           placeholder="{{ trans('general.max') }}" autofocus>
                                                    @if ($errors->has('max'))
                                                        <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('max') }}
                                                </strong>
                                            </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endcan
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description"
                                                       class="control-label">{{ trans('general.description_ar') }}</label>
                                                <textarea type="text" class="form-control" id="description_ar"
                                                          name="description_ar" aria-multiline="true"
                                                          maxlength="500">{{ old('description_ar') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description"
                                                       class="control-label">{{ trans('general.description_en') }}</label>
                                                <textarea type="text" class="form-control" id="description_en"
                                                          name="description_en" aria-multiline="true"
                                                          maxlength="500">{{ old('description_en') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="file" class="form-control" name="image" placeholder="image">
                                            <label for="form_control_1">{{ trans('general.main_image') }}</label>
                                            <div class="help-block text-left">
                                                {{ trans('message.best_fit',['width' => '1000 px', 'height' => '1000 px']) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_control_1tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.path') }}">{{ trans('general.path') }}</label>
                                                <input type="file" class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.path') }}" name="path"
                                                       placeholder="{{ trans('general.path') }}">
                                                <div class="help-block text-left">
                                                    files shall not exceed 50 MB
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('order') ? ' has-error' : '' }}">
                                                <label for="order" class="control-label">{{ trans('general.sequence') }}
                                                    *</label>
                                                <input id="order" type="number" class="form-control" name="order"
                                                       value="{{ old('order') }}"
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
                                        @can('index','group')
                                            @if(!$categoryGroups->isEmpty())
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">{{ trans('general.categoryGroups') }}</label>
                                                        <select multiple="multiple" class="multi-select"
                                                                id="my_multi_select1" name="categoryGroups[]">
                                                            @foreach($categoryGroups as $categoryGroup)
                                                                <option value="{{ $categoryGroup->id }}">{{ $categoryGroup->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                        @endcan
                                        @if(!$tags->isEmpty() && !request()->has('parent_id'))
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">{{ trans('general.tags') }}</label>
                                                    <select multiple="multiple" class="multi-select"
                                                            id="my_multi_select2" name="tags[]">
                                                        @foreach($tags as $tag)
                                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label sbold">{{ trans('general.active') }}</label></br>
                                                <label class="radio-inline">
                                                    <input type="radio" name="active" id="optionsRadios3" checked
                                                           value="1"> {{ trans('general.yes') }}</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="active" id="optionsRadios4"
                                                           value="0"> {{ trans('general.no') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label sbold">{{ trans('general.is_featured') }}</label></br>
                                                <label class="radio-inline">
                                                    <input type="radio" name="is_featured" id="optionsRadios3"
                                                           value="1"> {{ trans('general.yes') }}</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="is_featured" id="optionsRadios4" checked
                                                           value="0"> {{ trans('general.no') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label sbold">{{ trans('general.on_home') }}</label></br>
                                                <label class="radio-inline">
                                                    <input type="radio" name="on_home" id="optionsRadios3"
                                                           value="1"> {{ trans('general.yes') }}</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="on_home" id="optionsRadios4" checked
                                                           value="0"> {{ trans('general.no') }}</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <hr>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label sbold">{{ trans('general.on_new') }}</label></br>
                                                <label class="radio-inline">
                                                    <input type="radio" name="on_new" id="optionsRadios3"
                                                           value="1"> {{ trans('general.yes') }}</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="on_new" id="optionsRadios4" checked
                                                           value="0">{{ trans('general.no') }}</label>
                                            </div>
                                        </div>
                                        @can('index','service')
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label sbold">{{ trans('general.is_service') }}</label></br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_service" id="optionsRadios3"
                                                               value="1"> {{ trans('general.yes') }}</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_service" id="optionsRadios4"
                                                               checked
                                                               value="0"> {{ trans('general.no') }}</label>
                                                </div>
                                            </div>
                                        @endcan
                                        @can('index','product')
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label sbold">{{ trans('general.is_product') }}</label></br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_product" id="optionsRadios3"
                                                               value="1"> {{ trans('general.yes') }}</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_product" id="optionsRadios4"
                                                               checked
                                                               value="0"> {{ trans('general.no') }}</label>
                                                </div>
                                            </div>
                                        @endcan
                                        @can('index', 'commercial')
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label sbold">{{ trans('general.is_commercial') }}</label></br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_commercial" id="optionsRadios3"
                                                               value="1"> {{ trans('general.yes') }}</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_commercial" id="optionsRadios4"
                                                               checked
                                                               value="0"> {{ trans('general.no') }}</label>
                                                </div>
                                            </div>
                                        @endcan
                                        @can('index', 'user')
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label sbold">{{ trans('general.is_user') }}</label></br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_user" id="optionsRadios3"
                                                               value="1" checked> {{ trans('general.yes') }}</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_user" id="optionsRadios4"
                                                               value="0"> {{ trans('general.no') }}</label>
                                                </div>
                                            </div>
                                        @endcan
                                        @can('index','classified')
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label sbold">{{ trans('general.is_classified') }}</label></br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_classified" id="optionsRadios3"
                                                               value="1"> {{ trans('general.yes') }}</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_classified" id="optionsRadios4"
                                                               checked
                                                               value="0"> {{ trans('general.no') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label sbold">{{ trans('general.is_real_estate') }}</label></br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_real_estate" id="optionsRadios3"
                                                               value="1"> {{ trans('general.yes') }}</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_real_estate" id="optionsRadios4"
                                                               checked
                                                               value="0"> {{ trans('general.no') }}</label>
                                                </div>
                                            </div>
                                        @endcan
                                    </div>

                                </div>
                            </div>
                            @include('backend.partials.forms._btn-group')
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
