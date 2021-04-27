@extends('backend.layouts.app')


@section('content')
    <div class="portlet box blue">
        @include('backend.partials.forms.form_title')
        <div class="portlet-body form">
            <form class="horizontal-form" role="form" method="POST"
                  action="{{ route('backend.admin.faq.update', $element->id) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="put">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('title_ar') ? ' has-error' : '' }}">
                                <label for="title_ar" class="control-label">title Arabic*</label>
                                <input id="title_ar"
                                       type="text"
                                       class="form-control"
                                       name="title_ar"
                                       value="{{ $element->title_ar }}"
                                       placeholder="name in arabic"
                                       required autofocus>
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
                                <label for="title_en" class="control-label">title English*</label>
                                <input id="title_en"
                                       type="text"
                                       class="form-control"
                                       name="title_en"
                                       value="{{ $element->title_en }}"
                                       placeholder="name in english"
                                       required autofocus>
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
                            <div class="form-group">
                                <label for="description" class="control-label">content arabic</label>
                                <textarea type="text" class="form-control tinymce" id="content_ar" name="content_ar"
                                          aria-multiline="true" maxlength="500">{{ $element->content_ar }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description" class="control-label">content english</label>
                                <textarea type="text" class="form-control tinymce" id="content_en" name="content_en"
                                          aria-multiline="true" maxlength="500">{{ $element->content_en }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label sbold tooltips"
                                       data-container="body" data-placement="top"
                                       data-original-title="{{ trans('message.active') }}">{{ trans('general.active') }}</label></br>
                                <label class="radio-inline">
                                    <input type="radio" name="active"
                                           id="optionsRadios3"
                                           {{ $element->active ? 'checked' : null  }}
                                           value="1">
                                    {{ trans('general.yes') }}</label>
                                <label class="radio-inline">
                                    <input type="radio" name="active"
                                           id="optionsRadios4"
                                           {{ !$element->active ? 'checked' : null  }}
                                           value="0">
                                    {{ trans('general.no') }}
                                </label>
                            </div>
                        </div>
                    </div>
                @include('backend.partials.forms._btn-group')
            </form>
        </div>
    </div>
@endsection
