@extends('backend.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.admin.user.create') }}
@endsection

@section('content')
    <div class="portlet box blue">
        @include('backend.partials.forms.form_title')
        <div class="portlet-body">
            @include('backend.partials._admin_instructions',['title' => trans('general.users') ,'message' => trans('message.admin_user_message')])
            <div class="portlet-body form">
                <form class="horizontal-form" role="form" method="POST" action="{{ route('backend.admin.user.store') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="api_token" value="{{ rand(9999999, 99999999999).str_random(5) }}">
                    <input type="hidden" name="password" value="{{ bcrypt('secret') }}">
                    <div class="form-body">
                        <h3 class="form-section">{{ trans('general.new_user') }}</h3>
                        {{--name arabic / name english --}}
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
                                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label for="name_ar"
                                                       class="control-label required">{{ trans('general.name') }}
                                                    *</label>
                                                <input id="name_ar" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.name') }}" name="name"
                                                       value="{{ old('name') }}"
                                                       placeholder="{{ trans('general.name') }}" required autofocus>
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('name') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('slug_ar') ? ' has-error' : '' }}">
                                                <label for="slug_ar"
                                                       class="control-label required">{{ trans('general.slug_ar') }}
                                                    *</label>
                                                <input id="slug_ar" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.slug_ar') }}"
                                                       name="slug_ar" value="{{ old('slug_ar') }}"
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
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('slug_en') ? ' has-error' : '' }}">
                                                <label for="slug_en"
                                                       class="control-label required">{{ trans('general.slug_en') }}
                                                    *</label>
                                                <input id="slug_en" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.slug_en') }}"
                                                       name="slug_en" value="{{ old('slug_en') }}"
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
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                                <label for="password"
                                                       class="control-label required">{{ trans('general.password') }}
                                                    *</label>
                                                <input id="password" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       minlength="6"
                                                       data-original-title="{{ trans('message.password') }}"
                                                       name="current_password" value="{{ old('current_password') }}"
                                                       placeholder="{{ trans('general.password') }}" required autofocus>
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('password') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="single"
                                                       class="control-label required">{{ trans('general.country') }}
                                                    *</label>
                                                <select id="single" class="form-control tooltips select2"
                                                        data-container="body" data-placement="top"
                                                        data-original-title="{{ trans('message.country_id') }}"
                                                        name="country_id" required>
                                                    <option>{{ trans('general.choose_country') }}</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->slug_en }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="single"
                                                       class="control-label required">{{ trans('general.role') }}
                                                    *</label>
                                                <select id="single" class="form-control tooltips select2"
                                                        data-container="body" data-placement="top"
                                                        data-original-title="{{ trans('message.role_id') }}"
                                                        name="role_id" required>
                                                    <option>{{ trans('general.choose_role') }}</option>
                                                    @if(auth()->user()->isSuper)
                                                        @foreach($roles as $role)
                                                            <option value="{{ $role->id }}">{{ $role->slug_en }}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($roles->where('is_admin', false) as $role)
                                                            <option value="{{ $role->id }}">{{ $role->slug_en }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        {{-- email + mobile --}}

                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label for="email"
                                                       class="control-label required">{{ trans('general.email') }}
                                                    *</label>
                                                <input id="email" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.email') }}" name="email"
                                                       value="{{ old('email') ? old('email') : (env('ESCRAP') ? 'user'.rand(1,9999).'@escrap.com' : null ) }}"
                                                       placeholder="{{ trans('general.email') }}" required autofocus>
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('email') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                                <label for="mobile"
                                                       class="control-label required">{{ trans('general.mobile') }}
                                                    *</label>
                                                <input id="mobile" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.mobile') }}" name="mobile"
                                                       value="{{ old('mobile') }}"
                                                       placeholder="{{ trans('general.mobile_example') }} " autofocus>
                                                @if ($errors->has('mobile'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('mobile') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="form_control_1"
                                                       class="control-label required">{{ trans('general.logo') }}
                                                    *</label>
                                                <input type="file" class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.main_image') }}"
                                                       name="image" placeholder="{{ trans('general.main_image') }}"
                                                       required>
                                                <div class="help-block text-left">
                                                    {{ trans('message.best_fit',['width' => '1000 px', 'height' => '1000 px']) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="file"
                                                       class="control-label required">{{ trans('general.more_images') }}
                                                </label>
                                                <input class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.more_iamges') }}"
                                                       name="images[]" placeholder="images" type="file"
                                                       multiple/>
                                                <div class="help-block text-left small">
                                                    {{ trans('message.best_fit',['width' => '1080 px', 'height' => '1440 px']) }}
                                                </div>
                                            </div>
                                        </div>
                                        @if(!$categories->isEmpty())
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label required">{{ trans('general.categories') }}
                                                        *</label>
                                                    <select multiple="multiple" class="multi-select"
                                                            id="my_multi_select1" name="categories[]">
                                                        @foreach($categories->unique() as $category)
                                                            <option value="{{ $category->id }}"
                                                                    style="background-color: {{ $category->isParent ? 'lightblue' : null  }}">
                                                                {{ $category->name }}</option>
                                                            @if(!$category->children->isEmpty())
                                                                @foreach($category->children as $child)
                                                                    <option value="{{ $child->id }}"
                                                                            style="padding-left: 15px">
                                                                        {{ $child->name }}</option>
                                                                    @if(!$child->children->isEmpty())
                                                                        @foreach($child->children as $subChild)
                                                                            <option value="{{ $subChild->id }}"
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label sbold tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.gender') }}">{{ trans('general.gender') }}</label></br>
                                                <label class="radio-inline">
                                                    <input type="radio" name="is_male" id="optionsRadios1"
                                                           checked value="1">
                                                    {{ trans('general.male') }} </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="is_male" id="optionsRadios2"
                                                           value="0"> {{ trans('general.female') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('backend.partials.forms._btn-group')
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

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description"
                                                       class="control-label">{{ trans('general.description_arabic') }}</label>
                                                <textarea type="text" class="form-control tooltips"
                                                          data-container="body" data-placement="top"
                                                          data-original-title="{{ trans('message.description_arabic') }}"
                                                          id="description_ar" name="description_ar"
                                                          aria-multiline="true"
                                                          maxlength="500" {{ old('description_ar') }}></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description"
                                                       class="control-label">{{ trans('general.description_english') }}</label>
                                                <textarea type="text" class="form-control tooltips"
                                                          data-container="body" data-placement="top"
                                                          data-original-title="{{ trans('message.description_english') }}"
                                                          id="description_en" name="description_en"
                                                          aria-multiline="true"
                                                          maxlength="500">{{ old('description_en') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('service_en') ? ' has-error' : '' }}">
                                                <label for="service_en"
                                                       class="control-label">{{ trans('general.service_en') }}</label>
                                                <input id="service_en" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.service_en') }}"
                                                       name="service_en" value="{{ old('service_en') }}"
                                                       placeholder="{{ trans('general.service_en') }}"
                                                       autofocus>
                                                @if ($errors->has('service_en'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('service_en') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('service_ar') ? ' has-error' : '' }}">
                                                <label for="service_ar"
                                                       class="control-label">{{ trans('general.service_ar') }}</label>
                                                <input id="service_ar" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.service_ar') }}"
                                                       name="service_ar" value="{{ old('service_ar') }}"
                                                       placeholder="{{ trans('general.service_ar') }}"
                                                       autofocus>
                                                @if ($errors->has('service_ar'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('service_ar') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('service_en') ? ' has-error' : '' }}">
                                                <label for="service_en"
                                                       class="control-label">{{ trans('general.service_en') }}</label>
                                                <input id="service_en" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.service_en') }}"
                                                       name="service_en" value="{{ old('service_en') }}"
                                                       placeholder="{{ trans('general.service_en') }}"
                                                       autofocus>
                                                @if ($errors->has('service_en'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('service_en') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('service_ar') ? ' has-error' : '' }}">
                                                <label for="service_ar"
                                                       class="control-label">{{ trans('general.service_ar') }}</label>
                                                <input id="service_ar" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.service_ar') }}"
                                                       name="service_ar" value="{{ old('service_ar') }}"
                                                       placeholder="{{ trans('general.service_ar') }}"
                                                       autofocus>
                                                @if ($errors->has('service_ar'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('service_ar') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                                <label for="address"
                                                       class="control-label">{{ trans('general.address') }}</label>
                                                <input id="address" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.address') }}"
                                                       name="address" placeholder="{{ trans('general.address') }}"
                                                       value="{{ old('address') }}" autofocus>
                                                @if ($errors->has('address'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('address') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                                <label for="phone"
                                                       class="control-label">{{ trans('general.phone') }}</label>
                                                <input id="phone" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.phone') }}" name="phone"
                                                       placeholder="{{ trans('general.phone') }}"
                                                       value="{{ old('phone') }}" autofocus>
                                                @if ($errors->has('phone'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('phone') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('fax') ? ' has-error' : '' }}">
                                                <label for="fax"
                                                       class="control-label">{{ trans('general.fax') }}</label>
                                                <input id="fax" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.fax') }}" name="fax"
                                                       placeholder="{{ trans('general.fax') }}" value="{{ old('fax') }}"
                                                       autofocus>
                                                @if ($errors->has('fax'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('fax') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}">
                                                <label for="area"
                                                       class="control-label">{{ trans('general.area') }}</label>
                                                <input id="area" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.area') }}" name="area"
                                                       placeholder="{{ trans('general.area') }}"
                                                       value="{{ old('area') }}" autofocus>
                                                @if ($errors->has('area'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('area') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('block') ? ' has-error' : '' }}">
                                                <label for="block"
                                                       class="control-label">{{ trans('general.block') }}</label>
                                                <input id="block" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.block') }}" name="block"
                                                       placeholder="{{ trans('general.block') }}"
                                                       value="{{ old('block') }}" autofocus>
                                                @if ($errors->has('block'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('block') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                                                <label for="street"
                                                       class="control-label">{{ trans('general.street') }}</label>
                                                <input id="street" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.street') }}" name="street"
                                                       placeholder="{{ trans('general.street') }}"
                                                       value="{{ old('street') }}" autofocus>
                                                @if ($errors->has('street'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('street') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('building') ? ' has-error' : '' }}">
                                                <label for="building"
                                                       class="control-label">{{ trans('general.building') }}</label>
                                                <input id="building" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.building') }}"
                                                       name="building" placeholder="{{ trans('general.building') }}"
                                                       value="{{ old('building') }}" autofocus>
                                                @if ($errors->has('building'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('building') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('floor') ? ' has-error' : '' }}">
                                                <label for="floor"
                                                       class="control-label">{{ trans('general.floor') }}</label>
                                                <input id="floor" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.floor') }}" name="floor"
                                                       placeholder="{{ trans('general.floor') }}"
                                                       value="{{ old('floor') }}" autofocus>
                                                @if ($errors->has('floor'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('floor') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('apartment') ? ' has-error' : '' }}">
                                                <label for="apartment"
                                                       class="control-label">{{ trans('general.apartment') }}</label>
                                                <input id="apartment" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.apartment') }}"
                                                       name="apartment" placeholder="{{ trans('general.apartment') }}"
                                                       value="{{ old('apartment') }}" autofocus>
                                                @if ($errors->has('apartment'))
                                                    <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('apartment') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        @if(!$products->isEmpty())
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label tooltips"
                                                           data-container="body" data-placement="top"
                                                           data-original-title="{{ trans('message.related_product_group') }}"
                                                    >{{ trans('general.related_product_group') }}
                                                    </label>
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="form_control_1">{{ trans('general.qr') }}</label>
                                                <input type="file" class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.qr') }}" name="qr"
                                                       placeholder="{{ trans('general.qr') }}">
                                                <div class="help-block text-left small">
                                                    {{ trans('message.best_fit',['width' => '500 px', 'height' => '500 px']) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="form_control_1">{{ trans('general.banner') }}</label>
                                                <input type="file" class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.banner') }}" name="banner"
                                                       placeholder="{{ trans('general.banner') }}">
                                                <div class="help-block text-left small">
                                                    {{ trans('message.best_fit',['width' => '1080 px', 'height' => '350 px']) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('bg') ? ' has-error' : '' }}">
                                                <label for="demo"
                                                       class="control-label">{{ trans('general.bg') }}</label>
                                                <input type="file" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.bg') }}"
                                                       data-control="hue" name="bg" value="#ff6161">
                                                <div class="help-block text-left small">
                                                    {{ trans('message.best_fit',['width' => '1080 px', 'height' => '350 px']) }}
                                                </div>
                                                @if ($errors->has('demo'))
                                                    <span class="help-block small">
                                                <strong>
                                                    {{ $errors->first('demo') }}
                                                </strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        @can('index','survey')
                                            @if(!$surveys->isEmpty() && env('MALLR'))
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label tooltips"
                                                               data-container="body" data-placement="top"
                                                               data-original-title="{{ trans('message.surveys') }}"
                                                        >{{ trans('general.surveys') }}
                                                            *</label>
                                                        <select multiple="multiple" class="multi-select"
                                                                id="my_multi_select3" name="surveys[]">
                                                            @foreach($surveys as $survey)
                                                                <option value="{{ $survey->id }}">
                                                                    {{ $survey->name }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                        @endcan
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
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('policy_ar') ? ' has-error' : '' }}">
                                                <label for="policy_ar"
                                                       class="control-label">{{ trans('general.policy_ar') }}</label>
                                                <input id="policy_ar" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.policy_ar') }}"
                                                       name="policy_ar"
                                                       placeholder="{{ trans('general.policy_ar') }}"
                                                       value="{{ old('policy_ar') }}" autofocus>
                                                @if ($errors->has('policy_ar'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('policy_ar') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('policy_en') ? ' has-error' : '' }}">
                                                <label for="policy_en"
                                                       class="control-label">{{ trans('general.policy_en') }}</label>
                                                <input id="policy_en" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.policy_en') }}"
                                                       name="policy_en"
                                                       placeholder="{{ trans('general.policy_en') }}"
                                                       value="{{ old('policy_en') }}" autofocus>
                                                @if ($errors->has('policy_en'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('policy_en') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('cancellation_ar') ? ' has-error' : '' }}">
                                                <label for="cancellation_ar"
                                                       class="control-label">{{ trans('general.cancellation_ar') }}</label>
                                                <input id="cancellation_ar" type="text"
                                                       class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.cancellation_ar') }}"
                                                       name="cancellation_ar"
                                                       placeholder="{{ trans('general.cancellation_ar') }}"
                                                       value="{{ old('cancellation_ar') }}" autofocus>
                                                @if ($errors->has('cancellation_ar'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('cancellation_ar') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('cancellation_en') ? ' has-error' : '' }}">
                                                <label for="cancellation_en"
                                                       class="control-label">{{ trans('general.cancellation_en') }}</label>
                                                <input id="cancellation_en" type="text"
                                                       class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.cancellation_en') }}"
                                                       name="cancellation_en"
                                                       placeholder="{{ trans('general.cancellation_en') }}"
                                                       value="{{ old('cancellation_en') }}" autofocus>
                                                @if ($errors->has('cancellation_en'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('cancellation_en') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('keywords') ? ' has-error' : '' }}">
                                                <label for="keywords"
                                                       class="control-label">{{ trans('general.keywords') }}</label>
                                                <input id="keywords" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.keywords') }}"
                                                       name="keywords"
                                                       placeholder="{{ trans('general.keywords') }}"
                                                       value="{{ old('keywords') }}" autofocus>
                                                @if ($errors->has('keywords'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('keywords') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('path') ? ' has-error' : '' }}">
                                                <label for="path"
                                                       class="control-label">{{ trans('general.path') }}</label>
                                                <input id="path" type="file" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.path') }}"
                                                       name="path" placeholder="{{ trans('general.path') }}"
                                                       value="{{ old('path') }}" autofocus>
                                                @if ($errors->has('path'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('path') }}
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
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                                                <label for="website"
                                                       class="control-label">{{ trans('general.website') }}</label>
                                                <input id="website" type="url" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.website') }}"
                                                       name="website"
                                                       placeholder="{{ trans('general.website') }}"
                                                       value="{{ old('website') }}" autofocus>
                                                @if ($errors->has('website'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('website') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
                                                <label for="facebook"
                                                       class="control-label">{{ trans('general.facebook') }}</label>
                                                <input id="facebook" type="url" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.facebook') }}"
                                                       name="facebook"
                                                       placeholder="{{ trans('general.facebook') }}"
                                                       value="{{ old('facebook') }}" autofocus>
                                                @if ($errors->has('facebook'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('facebook') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('instagram') ? ' has-error' : '' }}">
                                                <label for="instagram"
                                                       class="control-label">{{ trans('general.instagram') }}</label>
                                                <input id="instagram" type="url" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.instagram') }}"
                                                       name="instagram"
                                                       placeholder="{{ trans('general.instagram') }}"
                                                       value="{{ old('instagram') }}" autofocus>
                                                @if ($errors->has('instagram'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('instagram') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('youtube') ? ' has-error' : '' }}">
                                                <label for="youtube"
                                                       class="control-label">{{ trans('general.youtube') }}</label>
                                                <input id="youtube" type="url" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.youtube') }}"
                                                       name="youtube"
                                                       placeholder="{{ trans('general.youtube') }}"
                                                       value="{{ old('youtube') }}" autofocus>
                                                @if ($errors->has('youtube'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('youtube') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('twitter') ? ' has-error' : '' }}">
                                                <label for="twitter"
                                                       class="control-label">{{ trans('general.twitter') }}</label>
                                                <input id="twitter" type="url" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.twitter') }}"
                                                       name="twitter"
                                                       placeholder="{{ trans('general.twitter') }}"
                                                       value="{{ old('twitter') }}" autofocus>
                                                @if ($errors->has('twitter'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('twitter') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('whatsapp') ? ' has-error' : '' }}">
                                                <label for="whatsapp"
                                                       class="control-label">{{ trans('general.whatsapp') }}
                                                    (ex.: 65XX2XXX)</label>
                                                <input id="whatsapp" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.whatsapp') }}"
                                                       name="whatsapp"
                                                       placeholder="{{ trans('general.mobile_example') }}"
                                                       value="{{ old('whatsapp') }}" autofocus>
                                                @if ($errors->has('whatsapp'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('whatsapp') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('iphone') ? ' has-error' : '' }}">
                                                <label for="iphone"
                                                       class="control-label">{{ trans('general.iphone') }}</label>
                                                <input id="iphone" type="url" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.iphone') }}"
                                                       name="iphone" placeholder="{{ trans('general.iphone') }}"
                                                       value="{{ old('iphone') }}" autofocus>
                                                @if ($errors->has('iphone'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('iphone') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('android') ? ' has-error' : '' }}">
                                                <label for="android"
                                                       class="control-label">{{ trans('general.android') }}</label>
                                                <input id="android" type="url" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.android') }}"
                                                       name="android"
                                                       placeholder="{{ trans('general.android') }}"
                                                       value="{{ old('android') }}" autofocus>
                                                @if ($errors->has('android'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('android') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('longitude') ? ' has-error' : '' }}">
                                                <label for="longitude"
                                                       class="control-label">{{ trans('general.longitude') }}</label>
                                                <input id="longitude" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.longitude') }}"
                                                       name="longitude"
                                                       placeholder="{{ trans('general.longitude') }}"
                                                       value="{{ old('longitude') }}" autofocus>
                                                @if ($errors->has('longitude'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('longitude') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('latitude') ? ' has-error' : '' }}">
                                                <label for="latitude"
                                                       class="control-label">{{ trans('general.latitude') }}</label>
                                                <input id="latitude" type="text" class="form-control tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.latitude') }}"
                                                       name="latitude"
                                                       placeholder="{{ trans('general.latitude') }}"
                                                       value="{{ old('latitude') }}" autofocus>
                                                @if ($errors->has('latitude'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('latitude') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        @can('isAdminOrAbove')
                                            <div class="col-md-4">
                                                <div class="form-group{{ $errors->has('balance') ? ' has-error' : '' }}">
                                                    <label for="balance"
                                                           class="control-label">{{ trans('general.balance') }}</label>
                                                    <input id="balance" type="number"
                                                           class="form-control tooltips" data-container="body"
                                                           data-placement="top"
                                                           data-original-title="{{ trans('message.balance') }}"
                                                           name="balance"
                                                           placeholder="{{ trans('general.balance') }}"
                                                           value="{{ old('balance') }}" autofocus>
                                                    @if ($errors->has('balance'))
                                                        <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('balance') }}
                                                        </strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endcan
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('merchant_id') ? ' has-error' : '' }}">
                                                <label for="merchant_id"
                                                       class="control-label">{{ trans('general.merchant_id') }}</label>
                                                <input id="merchant_id" type="text"
                                                       class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.merchant_id') }}"
                                                       name="merchant_id"
                                                       placeholder="{{ trans('general.merchant_id') }}"
                                                       value="{{ old('merchant_id') }}" autofocus>
                                                @if ($errors->has('merchant_id'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('merchant_id') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('video_url_one') ? ' has-error' : '' }}">
                                                <label for="video_url_one"
                                                       class="control-label">{{ trans('general.video_url_one') }}</label>
                                                <input id="video_url_one" type="url"
                                                       class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.video_url_one') }}"
                                                       name="video_url_one" value="{{ old('video_url_one') }}"
                                                       placeholder="{{ trans('general.video_url_one') }}"
                                                       autofocus>
                                                @if ($errors->has('video_url_one'))
                                                    <span class="help-block">
                                                            <strong>
                                                                {{ $errors->first('video_url_one') }}
                                                            </strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('video_url_two') ? ' has-error' : '' }}">
                                                <label for="video_url_two"
                                                       class="control-label">{{ trans('general.video_url_two') }}</label>
                                                <input id="video_url_two" type="url"
                                                       class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.video_url_two') }}"
                                                       name="video_url_two" value="{{ old('video_url_two') }}"
                                                       placeholder="{{ trans('general.video_url_two') }}"
                                                       autofocus>
                                                @if ($errors->has('video_url_two'))
                                                    <span class="help-block">
                                            <strong>
                                                {{ $errors->first('video_url_two') }}
                                            </strong>
                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('video_url_three') ? ' has-error' : '' }}">
                                                <label for="video_url_three"
                                                       class="control-label">{{ trans('general.video_url_three') }}</label>
                                                <input id="video_url_three" type="url"
                                                       class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.video_url_three') }}"
                                                       name="video_url_three"
                                                       value="{{ old('video_url_three') }}"
                                                       placeholder="{{ trans('general.video_url_three') }}"
                                                       autofocus>
                                                @if ($errors->has('video_url_three'))
                                                    <span class="help-block">
                                                            <strong>
                                                                {{ $errors->first('video_url_three') }}
                                                            </strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('video_url_four') ? ' has-error' : '' }}">
                                                <label for="video_url_four"
                                                       class="control-label">{{ trans('general.video_url_four') }}</label>
                                                <input id="video_url_four" type="url"
                                                       class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.video_url_four') }}"
                                                       name="video_url_four" value="{{ old('video_url_four') }}"
                                                       placeholder="{{ trans('general.video_url_four') }}"
                                                       autofocus>
                                                @if ($errors->has('video_url_four'))
                                                    <span class="help-block">
                                                            <strong>
                                                                {{ $errors->first('video_url_four') }}
                                                            </strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group{{ $errors->has('video_url_five') ? ' has-error' : '' }}">
                                                <label for="video_url_five"
                                                       class="control-label">{{ trans('general.video_url_five') }}</label>
                                                <input id="video_url_five" type="url"
                                                       class="form-control tooltips" data-container="body"
                                                       data-placement="top"
                                                       data-original-title="{{ trans('message.video_url_five') }}"
                                                       name="video_url_five" value="{{ old('video_url_five') }}"
                                                       placeholder="{{ trans('general.video_url_five') }}"
                                                       autofocus>
                                                @if ($errors->has('video_url_five'))
                                                    <span class="help-block">
                                                            <strong>
                                                                {{ $errors->first('video_url_five') }}
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label sbold tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.active') }}">{{ trans('general.active') }}</label></br>
                                                <label class="radio-inline">
                                                    <input type="radio" name="active" id="optionsRadios1"
                                                           checked value="1">
                                                    {{ trans('general.yes') }} </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="active" id="optionsRadios2"
                                                           value="0"> {{ trans('general.no') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label sbold tooltips"
                                                       data-container="body" data-placement="top"
                                                       data-original-title="{{ trans('message.on_home') }}">{{ trans('general.on_home') }}</label></br>
                                                <label class="radio-inline">
                                                    <input type="radio" name="on_home" id="optionsRadios1"
                                                           value="1"> {{ trans('general.yes') }} </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="on_home" id="optionsRadios2"
                                                           checked value="0"> {{ trans('general.no') }}
                                                </label>
                                            </div>
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
