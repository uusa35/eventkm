@extends('backend.layouts.app')
@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.post.create') }}
@endsection

@section('content')
    <div class="portlet box blue">
        @include('backend.partials.forms.form_title',['title' => trans('general.new_post')])
        <div class="portlet-body">
            @include('backend.partials._admin_instructions',['title' => trans('general.posts') ,'message' => trans('message.new_post')])
            <div class="portlet-body form">
                <form class="horizontal-form" role="form" method="POST" action="{{ route('backend.post.store') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <h3 class="form-section">{{ trans('general.new_post') }}</h3>
                        <div class="portlet box blue ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i> {{ trans('general.post_main_details') }}
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('title_ar') ? ' has-error' : '' }}">
                                                <label for="title_ar"
                                                       class="control-label required">{{ trans('general.title_ar') }}*</label>
                                                <input id="title_ar" type="text" class="form-control" name="title_ar"
                                                       value="{{ old('title_ar') }}"
                                                       placeholder="{{ trans('general.title_ar') }}" required autofocus>
                                                @if ($errors->has('title_ar'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('title_ar') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('title_en') ? ' has-error' : '' }}">
                                                <label for="title_en"
                                                       class="control-label required">{{ trans('general.title_en') }}*</label>
                                                <input id="title_en" type="text" class="form-control" name="title_en"
                                                       value="{{ old('title_en') }}"
                                                       placeholder="{{ trans('general.title_en') }}" required autofocus>
                                                @if ($errors->has('title_en'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('title_en') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('slug_ar') ? ' has-error' : '' }}">
                                                <label for="slug_ar"
                                                       class="control-label required">{{ trans('general.slug_ar') }}*</label>
                                                <input id="slug_ar" type="text" class="form-control" name="slug_ar"
                                                       value="{{ old('slug_ar') }}"
                                                       placeholder="{{ trans('general.slug_ar') }}" required autofocus>
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
                                            <div class="form-group{{ $errors->has('slug_en') ? ' has-error' : '' }}">
                                                <label for="slug_en"
                                                       class="control-label required">{{ trans('general.slug_en') }}*</label>
                                                <input id="slug_en" type="text" class="form-control" name="slug_en"
                                                       value="{{ old('slug_en') }}"
                                                       placeholder="{{ trans('general.slug_en') }}" required autofocus>
                                                @if ($errors->has('slug_en'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('slug_en') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @can('isAdminOrAbove')
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="single"
                                                           class="control-label required">{{ trans('general.owner') }}
                                                        *</label>
                                                    <select name="user_id" class="form-control tooltips"
                                                            data-container="body" data-placement="top"
                                                            data-original-title="{{ trans('message.owner') }}"
                                                            required>
                                                        <option value="">{{ trans('general.choose_user') }}</option>
                                                        @foreach($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->slug }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @else
                                            <input type="hidden" name="user_id" value="{{ auth()->id()}}">
                                        @endcan
                                        <div class="col-md-1">
                                            <div class="form-group{{ $errors->has('order') ? ' has-error' : '' }}">
                                                <label for="order" class="control-label">{{ trans('general.sequence') }}
                                                    *</label>
                                                <input id="order" type="number" class="form-control" name="order"
                                                       value="{{ old('order') }}"
                                                       placeholder="{{ trans('general.order') }}" required autofocus>
                                                @if ($errors->has('order'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('order') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="file"
                                                       class="control-label required">{{ trans('general.main_image') }}
                                                    *</label>

                                                <input class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.main_image') }}"
                                                       name="image" placeholder="images" type="file"
                                                       required/>
                                                <div class="help-block text-left">
                                                    {{ trans('message.best_fit',['width' => '1080 px', 'height' => '1440 px']) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="file"
                                                       class="control-label required">{{ trans('general.more_images') }}
                                                    *</label>

                                                <input class="form-control tooltips"
                                                       data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.more_images') }}"
                                                       name="images[]" placeholder="images" type="file"
                                                       multiple/>
                                                <div class="help-block text-left">
                                                    {{ trans('message.best_fit',['width' => '1080 px', 'height' => '1440']) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="content_ar"
                                                       class="control-label">{{ trans('general.caption_ar') }}</label>
                                                <textarea type="text" class="form-control tooltips tinymce "
                                                          data-container="body" data-placement="top"
                                                          data-original-title="{{ trans('message.caption_ar') }}"
                                                          id="caption_ar" name="caption_ar" aria-multiline="true"
                                                          maxlength="500">
                                                {{ old('caption_ar') }}
                                            </textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="caption_en"
                                                       class="control-label">{{ trans('general.caption_en') }}</label>
                                                <textarea type="text" class="form-control tooltips tinymce"
                                                          data-container="body" data-placement="top"
                                                          data-original-title="{{ trans('message.caption_en') }}"
                                                          id="caption_en" name="caption_en" aria-multiline="true"
                                                          maxlength="500">{{ old('caption_en') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="content_ar"
                                                       class="control-label">{{ trans('general.content_ar') }}</label>
                                                <textarea type="text" class="form-control tooltips tinymce "
                                                          data-container="body" data-placement="top"
                                                          data-original-title="{{ trans('message.content_ar') }}"
                                                          id="content_ar" name="content_ar" aria-multiline="true"
                                                          maxlength="500">
                                                {{ old('content_ar') }}
                                            </textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="content_en"
                                                       class="control-label">{{ trans('general.content_en') }}</label>
                                                <textarea type="text" class="form-control tooltips tinymce"
                                                          data-container="body" data-placement="top"
                                                          data-original-title="{{ trans('message.content_en') }}"
                                                          id="content_en" name="content_en" aria-multiline="true"
                                                          maxlength="500">{{ old('content_en') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portlet box blue ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i> {{ trans('general.post_attributes_details') }}
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="form-body">
                                    <div class="row">
                                        <hr>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label sbold">{{ trans('general.active') }}</label></br>
                                                <label class="radio-inline">
                                                    <input type="radio" name="active" id="optionsRadios3"
                                                           value="1"> {{ trans('general.yes') }}</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="active" id="optionsRadios4" checked
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
