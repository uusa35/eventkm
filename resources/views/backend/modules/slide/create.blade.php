@extends('backend.layouts.app')


@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.slide.create') }}
@endsection

@section('content')
    <div class="portlet box blue">
        @include('backend.partials.forms.form_title')
        <div class="portlet-body">
            @include('backend.partials._admin_instructions',['title' => trans('general.slides') ,'message' => trans('message.index_slide')])
            <div class="alert alert-danger">
                <ul>
                    <li>
                        Home Slide : width : 1900px x height : 720px
                    </li>
                    <li>
                        Intro Slide : width : 900px x height : 1900px
                    </li>
                </ul>
            </div>
            <div class="portlet-body form">
                <form class="horizontal-form" role="form" method="POST" action="{{ route('backend.slide.store') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="slidable_id" value="{{ request()->slidable_id }}">
                    <input type="hidden" name="slidable_type" value="{{ request()->slidable_type }}">
                    <div class="form-body">
                        <h3 class="form-section">{{ trans('general.new_slide') }}</h3>
                        <div class="portlet box blue ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i> {{ trans('general.slide_main_details') }}
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group form-md-line-input">
                                                <input type="text" class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.title_ar') }}"
                                                       name="title_ar"
                                                       placeholder="{{ trans('general.title_ar') }}"
                                                       value="{{ old('title_ar') }}">
                                                <label for="form_control_1"> {{ trans('general.title_ar') }} *</label>
                                                <span class="help-block">please enter proper title</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-md-line-input">
                                                <input type="text" class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.title_en') }}"
                                                       name="title_en"
                                                       placeholder="{{ trans('general.title_en') }}"
                                                       value="{{ old('title_en') }}">
                                                <label for="form_control_1">{{ trans('general.title_en') }}*</label>
                                                <span class="help-block">please enter proper title</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-md-line-input">
                                                <input type="text" class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.caption_ar') }}"
                                                       name="caption_ar"
                                                       placeholder="{{ trans('general.caption_ar') }}"
                                                       value="{{ old('caption_ar') }}">
                                                <label for="form_control_1"> {{ trans('general.caption_ar') }} </label>
                                                <span class="help-block">please enter proper caption</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-md-line-input">
                                                <input type="text" class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.caption_en') }}"
                                                       name="caption_en"
                                                       placeholder="{{ trans('general.caption_en') }}"
                                                       value="{{ old('caption_en') }}">
                                                <label for="form_control_1">{{ trans('general.caption_en') }}</label>
                                                <span class="help-block">please enter proper caption</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-md-line-input">
                                                <input type="number" max="99" maxlength="2"
                                                       class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.sequence') }}"
                                                       name="order" placeholder="{{ trans('general.sequence') }}"
                                                       value="{{ old('order') }}">
                                                <label for="form_control_1">{{ trans('general.sequence') }}</label>
                                                <span class="help-block">slide Order is a number</span>
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
                                                    {{ trans('message.best_fit',['width' => 'Intro 900/ Home : 1900 px', 'height' => 'Height is 1900 px for Intro / 720 for Home Slide']) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
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
                                        <div class="col-md-4">
                                            <div class="form-group form-md-line-input tooltips" data-container="body"
                                                 data-placement="top"
                                                 data-original-title="{{ trans('message.url') }}">
                                                <input type="url" class="form-control" name="url"
                                                       placeholder="{{ trans('general.url') }}">
                                                <label for="form_control_1">{{ trans('general.url') }}</label>
                                                <span
                                                    class="help-block">full link is only allowed ('https://google.com')</span>
                                            </div>
                                        </div>
                                        @can('isAdminOrAbove')
                                            @if(env('HAS_MOBILE_APP'))
                                                <div class="col-lg-12">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="single"
                                                                   class="control-label required">{{ trans('general.connect_slide_with_element') }}
                                                                *</label>
                                                            <select name="module" class="form-control tooltips"
                                                                    data-container="body" data-placement="top"
                                                                    data-original-title="{{ trans('message.type') }}"
                                                            >
                                                                <option
                                                                    value="null">{{ trans('general.type') }}</option>
                                                                <option
                                                                    value="product">{{ trans('general.product') }}</option>
                                                                <option
                                                                    value="service">{{ trans('general.service') }}</option>
                                                                <option
                                                                    value="user">{{ trans('general.user') }}</option>
                                                                <option
                                                                    value="category">{{ trans('general.category') }}</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    @if($users->isNotEmpty())
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="single"
                                                                       class="control-label required">{{ trans('general.choose_user') }}
                                                                    *</label>
                                                                <select name="user_id" class="form-control tooltips"
                                                                        data-container="body" data-placement="top"
                                                                        data-original-title="{{ trans('message.choose_user') }}"
                                                                >
                                                                    <option
                                                                        value="NULL">{{ trans('general.choose_user') }}</option>
                                                                    @foreach($users as $u)
                                                                        <option
                                                                            value="{{ $u->id }}">{{ $u->slug_ar }}
                                                                            - {{ $u->slug_en }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endif


                                                    @if($products->isNotEmpty())
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="single"
                                                                       class="control-label required">{{ trans('general.choose_product') }}
                                                                    *</label>
                                                                <select name="product_id" class="form-control tooltips"
                                                                        data-container="body" data-placement="top"
                                                                        data-original-title="{{ trans('message.choose_product') }}"
                                                                >
                                                                    <option
                                                                        value="null">{{ trans('general.choose_product') }}</option>
                                                                    @foreach($products as $u)
                                                                        <option
                                                                            value="{{ $u->id }}">{{ $u->name_ar }}
                                                                            - {{ $u->name_en }} - {{ $u->sku }} - Id : {{ $u->id }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endif


                                                    @if($services->isNotEmpty())
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="single"
                                                                       class="control-label required">{{ trans('general.choose_service') }}
                                                                    *</label>
                                                                <select name="service_id" class="form-control tooltips"
                                                                        data-container="body" data-placement="top"
                                                                        data-original-title="{{ trans('message.choose_service') }}"
                                                                >
                                                                    <option
                                                                        value="null">{{ trans('general.choose_service') }}</option>
                                                                    @foreach($services as $u)
                                                                        <option
                                                                            value="{{ $u->id }}">{{ $u->name_ar }}
                                                                            - {{ $u->name_en }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if($categories->isNotEmpty())
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="single"
                                                                       class="control-label required">{{ trans('general.choose_category') }}
                                                                    *</label>
                                                                <select name="category_id" class="form-control tooltips"
                                                                        data-container="body" data-placement="top"
                                                                        data-original-title="{{ trans('message.choose_category') }}"
                                                                >
                                                                    <option
                                                                        value="null">{{ trans('general.choose_category') }}</option>
                                                                    @foreach($categories as $u)
                                                                        <option
                                                                            value="{{ $u->id }}">{{ $u->name_ar }}
                                                                            - {{ $u->name_en }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        @endcan

                                    </div>
                                </div>
                            </div>
                        </div>
                        @can('isAdminOrAbove')
                            <div class="portlet box blue ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i> {{ trans('general.slide_attributes_details') }}
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
                                                               class="md-radiobtn" >
                                                        <label for="radio51">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> {{ trans('general.active') }}
                                                        </label>
                                                    </div>
                                                    <div class="md-radio">
                                                        <input type="radio" id="radio52" name="active" value="0"
                                                               class="md-radiobtn" >
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
                                                                   class="md-radiobtn" >
                                                            <label for="radio53">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span> {{ trans('general.on_home') }}
                                                            </label>
                                                        </div>
                                                        <div class="md-radio">
                                                            <input type="radio" id="radio54" name="on_home" value="0"
                                                                   class="md-radiobtn" >
                                                            <label for="radio54">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span> {{ trans('general.no') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endcan
                                            @can('isAdminOrAbove')
                                                <div class="col-md-4">
                                                    <div class="md-radio-inline">
                                                        <div class="md-radio tooltips" data-container="body"
                                                             data-placement="top"
                                                             data-original-title="{{ trans('message.is_intro') }}">
                                                            <input type="radio" id="radio55" name="is_intro" value="1"
                                                                   class="md-radiobtn" >
                                                            <label for="radio55">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span
                                                                    class="box"></span> {{ trans('general.is_intro') }}
                                                            </label>
                                                        </div>
                                                        <div class="md-radio">
                                                            <input type="radio" id="radio56" name="is_intro" value="0"
                                                                   class="md-radiobtn">
                                                            <label for="radio56">
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
                            <input type="hidden" name="is_intro" value="0">
                        @endcan
                    </div>
                    @include('backend.partials.forms._btn-group')
                </form>
            </div>
        </div>
@endsection
