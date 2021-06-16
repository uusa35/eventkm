@extends('backend.layouts.app')


@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.video.create') }}
@endsection

@section('content')
    <div class="portlet box blue">
        @include('backend.partials.forms.form_title')
        <div class="portlet-body">
            @include('backend.partials._admin_instructions',['title' => trans('general.videos') ,'message' => trans('message.index_video')])
            <div class="portlet-body form">
                <form class="horizontal-form" role="form" method="POST" action="{{ route('backend.video.store') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <h3 class="form-section">{{ trans('general.new_video') }}</h3>
                        <div class="portlet box blue ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i> {{ trans('general.video_main_details') }}
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group form-md-line-input">
                                                <input type="text" class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.name_ar') }}"
                                                       name="name_ar"
                                                       placeholder="{{ trans('general.name_ar') }}">
                                                <label for="form_control_1"> {{ trans('general.name_ar') }} *</label>
                                                <span class="help-block">please enter proper title</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-md-line-input">
                                                <input type="text" class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.name_en') }}"
                                                       name="name_en"
                                                       placeholder="{{ trans('general.name_en') }}">
                                                <label for="form_control_1">{{ trans('general.name_en') }}*</label>
                                                <span class="help-block">please enter proper title</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-md-line-input">
                                                <input type="text" class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.caption_ar') }}"
                                                       name="caption_ar"
                                                       placeholder="{{ trans('general.caption_ar') }}">
                                                <label for="form_control_1"> {{ trans('general.caption_ar') }} *</label>
                                                <span class="help-block">please enter proper caption</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-md-line-input">
                                                <input type="text" class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.caption_en') }}"
                                                       name="caption_en"
                                                       placeholder="{{ trans('general.caption_en') }}">
                                                <label for="form_control_1">{{ trans('general.caption_en') }}*</label>
                                                <span class="help-block">please enter proper caption</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-md-line-input">
                                                <input type="number" max="99" maxlength="2"
                                                       class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.sequence') }}"
                                                       name="order" placeholder="{{ trans('general.sequence') }}">
                                                <label for="form_control_1">{{ trans('general.sequence') }}*</label>
                                                <span class="help-block">video Order is a number</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-md-line-input tooltips" data-container="body"
                                                 data-placement="top"
                                                 data-original-title="{{ trans('message.url') }}">
                                                <input type="url" class="form-control" name="url"
                                                       placeholder="{{ trans('general.url') }}">
                                                <label for="form_control_1">{{ trans('general.url') }}*</label>
                                                <span class="help-block">full link is only allowed ('https://google.com')</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-md-line-input tooltips" data-container="body"
                                                 data-placement="top"
                                                 data-original-title="{{ trans('message.video_id') }}">
                                                <input type="text" class="form-control" name="video_id"
                                                       placeholder="{{ trans('general.video_id') }}">
                                                <label for="form_control_1">{{ trans('general.video_id') }}*</label>
                                                <span class="help-block">Only Youtube Video ID</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="form_control_1">{{ trans('general.image') }}
                                                    *</label>
                                                <input type="file" class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.image') }}" name="image"
                                                       placeholder="{{ trans('general.image') }}" required>
                                                <div class="help-block text-left">
                                                    {{ trans('message.best_fit',['width' => '1440 px', 'height' => '1080px']) }}
                                                </div>
                                            </div>
                                        </div>
                                        @if(!$products->isEmpty())
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label tooltips"
                                                           data-container="body" data-placement="top"
                                                           data-original-title="{{ trans('message.related_product_group') }}"
                                                    >{{ trans('general.related_product_group') }}
                                                        *</label>
                                                    <select multiple="multiple" class="multi-select"
                                                            id="my_multi_select2" name="products[]">
                                                        @foreach($products as $product)
                                                            <option value="{{ $product->id }}">
                                                                {{ $product->name }} - SKU
                                                                : {{ $product->sku }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>


                        @can('isAdminOrAbove')
                            <div class="portlet box blue ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i> {{ trans('general.more_details') }}
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="md-radio-inline">
                                                    <div class="md-radio tooltips" data-container="body"
                                                         data-placement="top"
                                                         data-original-title="{{ trans('message.active') }}">
                                                        <input type="radio" id="radio51" name="active" value="1"
                                                               class="md-radiobtn" checked>
                                                        <label for="radio51">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> {{ trans('general.active') }}
                                                        </label>
                                                    </div>
                                                    <div class="md-radio">
                                                        <input type="radio" id="radio52" name="active" value="0"
                                                               class="md-radiobtn">
                                                        <label for="radio52">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> {{ trans('general.no') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            @can('isAdminOrAbove')
                                                <div class="col-md-4">
                                                    <div class="md-radio-inline">
                                                        <div class="md-radio tooltips" data-container="body"
                                                             data-placement="top"
                                                             data-original-title="{{ trans('message.on_home') }}">
                                                            <input type="radio" id="radio53" name="on_home" value="1"
                                                                   class="md-radiobtn">
                                                            <label for="radio53">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span> {{ trans('general.on_home') }}
                                                            </label>
                                                        </div>
                                                        <div class="md-radio">
                                                            <input type="radio" id="radio54" name="on_home" value="0"
                                                                   class="md-radiobtn" checked>
                                                            <label for="radio54">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span> {{ trans('general.no') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="active" value="1">
                            <input type="hidden" name="on_home " value="0">
                        @endif
                    </div>
                    @include('backend.partials.forms._btn-group')
                </form>
            </div>
        </div>
@endsection
