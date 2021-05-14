@extends('backend.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.attribute.edit', $element) }}
@endsection
@section('content')
    <div class="portlet box blue">
        @include('backend.partials.forms.form_title',['title' => trans('general.edit_product_attribute')])
        <div class="portlet-body form">
            <form class="horizontal-form" role="form" method="POST"
                  action="{{ route('backend.attribute.update', $element->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                @if(request()->has('product_id'))
                    <input type="hidden" name="product_id" value="{{ $element->product_id }}">
                @endif
                <div class="form-body">
                    <h3 class="form-section">{{ trans('general.edit_product_attribute') }}</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('qty') ? ' has-error' : '' }}">
                                <label for="qty" class="control-label">{{ trans('general.qty') }}*</label>
                                <input id="qty"
                                       type="number"
                                       minlength="1"
                                       maxlength="999"
                                       class="form-control"
                                       value="{{ $element->qty }}"
                                       name="qty"
                                       placeholder="qty arabic"
                                       autofocus>
                                @if ($errors->has('qty'))
                                    <span class="help-block">
                                        <strong>
                                            {{ $errors->first('qty') }}
                                        </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="size_id" class="control-label">{{ trans('general.size') }} *</label>
                                <select class="form-control input-xlarge" name="size_id" id="size_id" required>
                                    @foreach($sizes as $size)
                                        <option value="{{ $size->id }}" {{ $element->size_id === $size->id ? 'selected' : null  }}>{{ $size->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="color_id" class="control-label">{{ trans('general.color') }} *</label>
                                <select class="form-control input-xlarge" name="color_id" id="color_id" required>
                                    @foreach($colors as $color)
                                        <option value="{{ $color->id }}" {{ $element->color_id === $color->id ? 'selected' : null  }}>{{ $color->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('notes_ar') ? ' has-error' : '' }}">
                                <label for="notes_ar" class="control-label">{{ trans('general.notes_ar') }}</label>
                                <input id="notes_ar"
                                       type="text"
                                       class="form-control"
                                       name="notes_ar"
                                       value="{{ $element->notes_ar }}"
                                       placeholder="notes_ar arabic"
                                       autofocus>
                                @if ($errors->has('notes_ar'))
                                    <span class="help-block">
                                        <strong>
                                            {{ $errors->first('notes_ar') }}
                                        </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('notes_en') ? ' has-error' : '' }}">
                                <label for="notes_en" class="control-label">{{ trans('general.notes_en') }}</label>
                                <input id="notes_en"
                                       type="text"
                                       class="form-control"
                                       name="notes_en"
                                       value="{{ $element->notes_en }}"
                                       placeholder="notes_en arabic"
                                       autofocus>
                                @if ($errors->has('notes_en'))
                                    <span class="help-block">
                                        <strong>
                                            {{ $errors->first('notes_en') }}
                                        </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{--@include('backend.partials.forms._btn-group')--}}
                    <div class="form-actions right">
                        <a href="{!! url()->previous() !!}" class="btn default">Cancel</a>
                        <button type="submit" class="btn blue">
                            <i class="fa fa-check"></i> Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
