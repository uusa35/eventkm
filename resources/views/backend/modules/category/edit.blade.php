@extends('backend.layouts.app')


@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.admin.category.edit', $element) }}
@endsection
@section('content')
    <div class="portlet box blue">
        @include('backend.partials.forms.form_title',['title' => trans('general.edit_category')])
        <div class="portlet-body">
            @include('backend.partials._admin_instructions',['title' => trans('general.categories') ,'message' => trans('message.edit_category')])
            <div class="portlet-body form">
                <form class="horizontal-form" role="form" method="POST"
                      action="{{ route('backend.admin.category.update', $element->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
{{--                    <input type="hidden" name="parent_id"--}}
{{--                           value="{{ request()->has('parent_id') ? request()->parent_id : $element->parent_id}}">--}}
                    <div class="form-body">
                        <h3 class="form-section">{{ trans('general.edit_category') }}</h3>
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
                                                       value="{{ $element->name_ar }}"
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
                                                       value="{{ $element->name_en }}"
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
                                        @can('index','classified')
                                            <div class="col-md-2">
                                                <div class="form-group {{ $errors->has('min') ? ' has-error' : '' }}">
                                                    <label for="min"
                                                           class="control-label">{{ trans('general.min') }}</label>
                                                    <input id="min" type="number" class="form-control" name="min"
                                                           value="{{ $element->min }}"
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
                                                           value="{{ $element->max ? $element->max : 1000 }}"
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
                                            <div class="form-group {{ $errors->has('caption_ar') ? ' has-error' : '' }}">
                                                <label for="caption_ar"
                                                       class="control-label">{{ trans('general.caption_ar') }}*</label>
                                                <input id="caption_ar" type="text" class="form-control"
                                                       name="caption_ar" value="{{ $element->caption_ar }}"
                                                       placeholder="{{ trans('general.caption_ar') }}" required
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
                                                       class="control-label">{{ trans('general.caption_en') }}*</label>
                                                <input id="caption_en" type="text" class="form-control"
                                                       name="caption_en" value="{{ $element->caption_en }}"
                                                       placeholder="{{ trans('general.caption_en') }}" required
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
                                                {{ trans('message.best_fit',['width' => '1000 px', 'height' => '1000px']) }}
                                            </div>
                                        </div>
                                    </div>
                                    @if($element->image)
                                        <div class="col-md-3">
                                            <img class="img-responsive img-sm" src="{{ $element->getCurrentImageAttribute() }}"
                                                 alt="">
                                            <a href="{{ route("backend.admin.image.clear",['model' => 'category', 'id' => $element->id ]) }}"><i
                                                        class="fa fa-fw fa-times"></i></a>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('order') ? ' has-error' : '' }}">
                                                <label for="order" class="control-label">{{ trans('general.sequence') }}
                                                    *</label>
                                                <input id="order" type="number" class="form-control" name="order"
                                                       value="{{ $element->order }}"
                                                       placeholder="{{ trans('general.order') }}" maxlength="2"
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
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="single"
                                                       class="control-label required">{{ trans('general.parent') }}
                                                    *</label>
                                                <select name="parent_id" class="form-control tooltips"
                                                        data-container="body" data-placement="top"
                                                        data-original-title="{{ trans('message.parent') }}">
                                                    <option
                                                        value="0">{{ trans('general.make_parent') }}</option>
                                                    @foreach($categories as $category)
                                                        <option
                                                            value="{{ $category->id }}" {{ $element->parent_id === $category->id ? 'selected' : null  }}>{{ $category->name }}
                                                            - {{ $category->id }}</option>
                                                    @endforeach
                                                </select>
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
                                        @if(!$tags->isEmpty() && !request()->has('parent_id'))
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">{{ trans('general.tags') }}</label>
                                                    <select multiple="multiple" class="multi-select"
                                                            id="my_multi_select2" name="tags[]">
                                                        @foreach($tags as $tag)
                                                            <option value="{{ $tag->id }}"
                                                                    {{ in_array($tag->id,$element->tags->pluck('id')->unique()->flatten()->toArray()) ? 'selected' : null }}
                                                            >{{ $tag->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-md-4">
                                            <div class="form-group tooltips"
                                                 data-container="body" data-placement="top"
                                                 data-original-title="{{ trans('message.active') }}"
                                            >
                                                <label class="control-label sbold">{{ trans('general.active') }}</label></br>
                                                <label class="radio-inline">
                                                    <input type="radio" name="active" id="optionsRadios3"
                                                           {{ $element->active ? 'checked' : null }}
                                                           value="1"> {{ trans('general.yes') }}</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="active" id="optionsRadios4"
                                                           {{ !$element->active ? 'checked' : null }}
                                                           value="0"> {{ trans('general.no') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label sbold">{{ trans('general.is_featured') }}</label></br>
                                                <label class="radio-inline">
                                                    <input type="radio" name="is_featured" id="optionsRadios3"
                                                           {{ $element->is_featured ? 'checked' : null  }}
                                                           value="1"> {{ trans('general.yes') }}</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="is_featured" id="optionsRadios4"
                                                           {{ !$element->is_featured ? 'checked' : null }}
                                                           value="0"> {{ trans('general.no') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label sbold">{{ trans('general.on_home') }}</label></br>
                                                <label class="radio-inline">
                                                    <input type="radio" name="on_home" id="optionsRadios3"
                                                           {{ $element->on_home ? 'checked' : null  }}
                                                           value="1"> {{ trans('general.yes') }}</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="on_home" id="optionsRadios4"
                                                           {{ !$element->on_home ? 'checked' : null }}
                                                           value="0"> {{ trans('general.no') }}</label>
                                            </div>
                                        </div>
                                        @can('index','classified')
                                            @if($categoryGroups->isNotEmpty())
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">{{ trans('general.categoryGroups') }}</label>
                                                        <select multiple="multiple" class="multi-select"
                                                                id="my_multi_select1" name="categoryGroups[]">
                                                            @foreach($categoryGroups as $categoryGroup)
                                                                <option value="{{ $categoryGroup->id }}"
                                                                        {{ in_array($categoryGroup->id,$element->categoryGroups->pluck('id')->unique()->flatten()->toArray()) ? 'selected' : null }}
                                                                >{{ $categoryGroup->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label sbold">{{ trans('general.is_classified') }}</label></br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_classified" id="optionsRadios3"
                                                               {{ $element->is_classified ? 'checked' : null  }}
                                                               value="1"> {{ trans('general.yes') }}</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_classified" id="optionsRadios4"
                                                               {{ !$element->is_classified ? 'checked' : null }}
                                                               value="0"> {{ trans('general.no') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label sbold">{{ trans('general.is_real_estate') }}</label></br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_real_estate" id="optionsRadios3"
                                                               {{ $element->is_real_estate  ? 'checked' : null }}
                                                               value="1"> {{ trans('general.yes') }}</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_real_estate" id="optionsRadios4"
                                                               {{ !$element->is_real_estate ? 'checked' : null }}
                                                               value="0"> {{ trans('general.no') }}</label>
                                                </div>
                                            </div>
                                        @endcan
                                    </div>


                                    <div class="row">
                                        <hr>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label sbold">{{ trans('general.on_new') }}</label></br>
                                                <label class="radio-inline">
                                                    <input type="radio" name="on_new" id="optionsRadios3"
                                                           {{ $element->on_new ? 'checked' : null  }}
                                                           value="1"> {{ trans('general.yes') }}</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="on_new" id="optionsRadios4"
                                                           {{ !$element->on_new ? 'checked' : null }}
                                                           value="0">{{ trans('general.no') }}</label>
                                            </div>
                                        </div>
                                        @can('index','service')
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label sbold">{{ trans('general.is_service') }}</label></br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_service" id="optionsRadios3"
                                                               {{ $element->is_service ? 'checked' : null  }}
                                                               value="1"> {{ trans('general.yes') }}</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_service" id="optionsRadios4"
                                                               {{ !$element->is_service ? 'checked' : null }}
                                                               value="0"> {{ trans('general.no') }}</label>
                                                </div>
                                            </div>
                                        @endcan
                                        @can('index', 'product')
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label sbold">{{ trans('general.is_product') }}</label></br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_product" id="optionsRadios3"
                                                               {{ $element->is_product ? 'checked' : null  }}
                                                               value="1"> {{ trans('general.yes') }}</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_product" id="optionsRadios4"
                                                               {{ !$element->is_product ? 'checked' : null }}
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
                                                               {{ $element->is_commercial ? 'checked' : null  }}
                                                               value="1"> {{ trans('general.yes') }}</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_commercial" id="optionsRadios4"
                                                               {{ !$element->is_commercial ? 'checked' : null }}
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
                                                               {{ $element->is_user ? 'checked' : null  }}
                                                               value="1"> {{ trans('general.yes') }}</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="is_user" id="optionsRadios4"
                                                               {{ !$element->is_user ? 'checked' : null }}
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
