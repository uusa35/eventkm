@extends('backend.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.product.edit', $element) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                @include('backend.partials.forms.form_title')
                <div class="portlet-body">
                    @include('backend.partials._admin_instructions',['title' => trans('general.products') ,'message' =>
                    trans('message.new_product')])
                    <div class="portlet-body form">
                        <form class="horizontal-form" role="form" method="POST"
                              action="{{ route('backend.product.update', $element->id) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-body">
                                <h3 class="form-section">{{ trans('general.edit_product') }}</h3>
                                <div class="mt-element-step">
                                    <div class="row step-default">
                                        <div
                                            class="col-md-6 bg-success mt-step-col {{ Route::currentRouteName() == 'backend.product.edit' ? 'active' : null  }}">
                                            <div class="mt-step-number bg-white font-grey">1</div>
                                            <div class="mt-step-title uppercase font-grey-cascade">
                                                {{ trans('general.new_product') }}</div>
                                            <div class="mt-step-content font-grey-cascade">
                                                <p>
                                                    {{ trans('message.new_product') }}
                                                </p></div>
                                        </div>
                                        <div
                                            class="col-md-6 bg-grey mt-step-col {{ Route::currentRouteName() == 'backend.attribute.edit' ? 'active' : null  }}">
                                            <div class="mt-step-number bg-white font-grey">2</div>
                                            <div class="mt-step-title uppercase font-grey-cascade">
                                                {{ trans('general.add_attribute') }}</div>
                                            <div class="mt-step-content font-grey-cascade">
                                                <p>{{ trans('message.create_product_attributes') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <br/>
                                </div>
                                <br>
                                {{--name arabic / name english --}}
                                <div class="portlet box blue-dark">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i> {{ trans('general.main_details') }}
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="col-lg-4 col-md-6">
                                                        <div
                                                            class="form-group {{ $errors->has('sku') ? ' has-error' : '' }}">
                                                            <label for="sku"
                                                                   class="control-label required">{{ trans('general.sku') }}
                                                                *</label>
                                                            <input id="sku" type="text" class="form-control tooltips"
                                                                   data-container="body" data-placement="top"
                                                                   data-original-title="{{ trans('message.sku') }}"
                                                                   name="sku" value="{{ $element->sku }}"
                                                                   placeholder="{{ trans('general.sku') }}" required
                                                                   autofocus>
                                                            @if ($errors->has('sku'))
                                                                <span class="help-block">
                                                                <strong>
                                                                    {{ $errors->first('sku') }}
                                                                </strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div
                                                            class="form-group {{ $errors->has('name_ar') ? ' has-error' : '' }}">
                                                            <label for="name_ar"
                                                                   class="control-label required">{{ trans('general.name_arabic') }}
                                                                *</label>
                                                            <input id="name_ar" type="text"
                                                                   class="form-control tooltips" data-container="body"
                                                                   data-placement="top"
                                                                   data-original-title="{{ trans('message.name_ar') }}"
                                                                   name="name_ar" value="{{ $element->name_ar }}"
                                                                   placeholder="{{ trans('general.name_arabic') }}"
                                                                   required autofocus>
                                                            @if ($errors->has('name_ar'))
                                                                <span class="help-block">
                                                                <strong>
                                                                    {{ $errors->first('name_ar') }}
                                                                </strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div
                                                            class="form-group{{ $errors->has('name_en') ? ' has-error' : '' }}">
                                                            <label for="name_en"
                                                                   class="control-label required">{{ trans('general.name_english') }}
                                                                *</label>
                                                            <input id="name_en" type="text"
                                                                   class="form-control tooltips" data-container="body"
                                                                   data-placement="top"
                                                                   data-original-title="{{ trans('message.name_en') }}"
                                                                   name="name_en" value="{{ $element->name_en }}"
                                                                   placeholder="{{ trans('general.name_english') }}"
                                                                   required autofocus>
                                                            @if ($errors->has('name_en'))
                                                                <span class="help-block">
                                                                <strong>
                                                                    {{ $errors->first('name_en') }}
                                                                </strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="col-lg-4 col-md-6">
                                                            <div
                                                                class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                                                <label for="price"
                                                                       class="control-label required">{{ trans('general.price') }}
                                                                    *</label>
                                                                <input id="price" type="text"
                                                                       class="form-control tooltips"
                                                                       data-container="body" data-placement="top"
                                                                       data-original-title="{{ trans('message.price') }}"
                                                                       name="price" value="{{ $element->price }}"
                                                                       placeholder="{{ trans('general.price') }}"
                                                                       maxlength="5" required autofocus>
                                                                @if ($errors->has('price'))
                                                                    <span class="help-block">
                                                                <strong>
                                                                    {{ $errors->first('price') }}
                                                                </strong>
                                                            </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-6">
                                                            <div
                                                                class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                                                                <label for="weight"
                                                                       class="control-label required">{{ trans('general.weight') }}
                                                                    *</label>
                                                                <input id="weight" type="text"
                                                                       class="form-control tooltips"
                                                                       data-container="body"
                                                                       data-placement="top"
                                                                       data-original-title="{{ trans('message.weight') }}"
                                                                       name="weight" value="{{ $element->weight }}"
                                                                       placeholder="{{ trans('general.weight') }}"
                                                                       required
                                                                       autofocus>
                                                                <span class="help-block text-danger">
                                                                    <small>
                                                                    يرجى وضع الرقم باللغة الانجليزية فقط
                                                                    </small>
                                                                    </span>
                                                                @if ($errors->has('weight'))
                                                                    <span class="help-block">
                                                                <strong>
                                                                    {{ $errors->first('weight') }}
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
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    @if(!$categories->isEmpty())
                                                        <div class="col-lg-4 col-md-6">
                                                            <div class="form-group">
                                                                <label
                                                                    class="control-label required">{{ trans('general.categories') }}
                                                                    *</label>
                                                                <select multiple="multiple" class="multi-select"
                                                                        id="my_multi_select1" name="categories[]">
                                                                    @foreach($categories as $category)
                                                                        <option value="{{ $category->id }}"
                                                                                {{ in_array($category->id,$element->categories->pluck('id')->unique()->flatten()->toArray()) ? 'selected' : '' }}
                                                                                style="background-color: {{ $category->isParent ? 'lightblue' : null  }}"
                                                                        >
                                                                            {{ $category->name }}</option>
                                                                        @if($category->children->isNotEmpty() && $category->children->count()  >= 1)
                                                                            @foreach($category->children->unique() as $child)
                                                                                <option value="{{ $child->id }}"
                                                                                        {{ in_array($child->id,$element->categories->pluck('id')->unique()->flatten()->toArray()) ? 'selected' : '' }}
                                                                                        style="padding-left: 15px"
                                                                                >
                                                                                    {{ $child->name }}</option>
                                                                                @if($child->children->isNotEmpty() && $child->children->count() >= 1)
                                                                                    @foreach($child->children->unique() as $subChild)
                                                                                        <option
                                                                                            value="{{ $subChild->id }}"
                                                                                            {{ in_array($subChild->id,$element->categories->pluck('id')->unique()->flatten()->toArray()) ? 'selected' : '' }}
                                                                                            style="padding-left: 35px"
                                                                                        >
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
                                                            <a href="{{ route("backend.admin.image.clear",['model' => 'product', 'id' => $element->id ]) }}"><i
                                                                    class="fa fa-fw fa-times"></i></a>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="file"
                                                                   class="control-label required">{{ trans('general.more_images') }}
                                                                *</label>

                                                            <input class="form-control tooltips"
                                                                   data-container="body"
                                                                   data-placement="top"
                                                                   data-original-title="{{ trans('message.more_iamges') }}"
                                                                   name="images[]" placeholder="images" type="file"
                                                                   multiple/>
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
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12 text-right">
                                                    <button class="btn btn-success tooltips" data-container="body"
                                                            data-placement="top"
                                                            data-original-title="{{ trans('message.speed_saving_product') }}"
                                                            type="submit">{{ trans('general.save') }}</button>
                                                    <div class="help-block">
                                                        {{ trans('message.speed_saving_product') }}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <h2 class="text-center">{{ trans('general.have_more_details_for_your_product') }}</h2>
                                        <hr>
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
                                                    <div class="form-group">
                                                        <label for="single"
                                                               class="control-label">{{ trans('general.color') }}</label>
                                                        <select id="color_id" name="color_id"
                                                                class="form-control tooltips" data-container="body"
                                                                data-placement="top"
                                                                data-original-title="{{ trans('message.color') }}">
                                                            <option
                                                                value="">{{ trans('general.choose_color') }}</option>
                                                            @foreach($colors as $color)
                                                                <option
                                                                    value="{{ $color->id }}" {{ $element->color_id == $color->id ? 'selected' : null  }}>{{ $color->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        {{-- <span class="help-block">
                                                                                                                <strong>{{ trans('message.color_instructions') }}</strong>
                                                        </span> --}}
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="size_id"
                                                               class="control-label">{{ trans('general.size_or_weight') }}</label>
                                                        <select id="size_id" name="size_id"
                                                                class="form-control tooltips" data-container="body"
                                                                data-placement="top"
                                                                data-original-title="{{ trans('message.size') }}">
                                                            <option
                                                                value="">{{ trans('general.choose_size') }}</option>
                                                            @foreach($sizes as $size)
                                                                <option
                                                                    value="{{ $size->id }}" {{ $element->size_id == $size->id ? 'selected' : null  }}>{{ $size->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <div
                                                        class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                                        <label for="quantity"
                                                               class="control-label">{{ trans('general.quantity') }}</label>
                                                        <input id="quantity" type="text"
                                                               class="form-control tooltips"
                                                               data-container="body" data-placement="top"
                                                               data-original-title="{{ trans('message.quantity') }}"
                                                               name="qty" maxlength="5" value="{{ $element->qty }}"
                                                               placeholder="{{ trans('general.quantity') }}"
                                                               autofocus>
                                                        <span class="help-block text-info small">
                                                            {{ trans('message.qty_without_attributes') }}
                                                        </span>
                                                        <span class="help-block text-danger">
                                                                    <small>
                                                                    يرجى وضع الرقم باللغة الانجليزية فقط
                                                                    </small>
                                                                    </span>
                                                        @if ($errors->has('quantity'))
                                                            <span class="help-block">
                                                            <strong>
                                                                {{ $errors->first('quantity') }}
                                                            </strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div
                                                        class="form-group{{ $errors->has('start_sale') ? ' has-error' : '' }}">
                                                        <label for="start_sale"
                                                               class="control-label">{{ trans('general.start_sale_date') }}</label>
                                                        <div class="input-group date form_datetime">
                                                            <input type="text" readonly
                                                                   style="direction: ltr !important;"
                                                                   class="form-control tooltips"
                                                                   data-container="body"
                                                                   data-placement="top"
                                                                   data-original-title="{{ trans('message.start_sale_date') }}"
                                                                   name="start_sale"
                                                                   value="{{ $element->start_sale ? $element->start_sale : \Carbon\Carbon::now()->format('d F Y - h:i') }}"
                                                                   required>
                                                            <span class="input-group-btn"><button
                                                                    class="btn default date-set" type="button"><i
                                                                        class="fa fa-calendar"></i></button></span>
                                                        </div>
                                                        {{-- <span class="help-block">
                                                                                                                            <strong>{{ trans('message.start_sale_date') }}</strong>
                                                        </span> --}}
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label
                                                            class="control-label">{{ trans('general.end_sale_date') }}</label>
                                                        <div class="input-group date form_datetime">
                                                            <input type="text" class="form-control tooltips"
                                                                   data-container="body" data-placement="top"
                                                                   data-original-title="{{ trans('message.end_sale_date') }}"
                                                                   readonly style="direction: ltr !important;"
                                                                   name="end_sale"
                                                                   value="{{ $element->end_sale ? $element->end_sale : \Carbon\Carbon::now()->addDay(1)->format('d F Y - h:i') }}"
                                                                   required>
                                                            <span class="input-group-btn"><button
                                                                    class="btn default date-set" type="button"><i
                                                                        class="fa fa-calendar"></i></button></span>
                                                        </div>
                                                        {{-- <span class="help-block">
                                                                                                                            <strong>{{ trans('message.end_sale_date') }}</strong>
                                                        </span> --}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="description"
                                                                   class="control-label">{{ trans('general.description_arabic') }}</label>
                                                            <textarea type="text" class="form-control tooltips"
                                                                      data-container="body" data-placement="top"
                                                                      data-original-title="{{ trans('message.description_ar') }}"
                                                                      id="description_ar" name="description_ar"
                                                                      aria-multiline="true"
                                                                      maxlength="500">{{ $element->description_ar }}</textarea>
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
                                                                      maxlength="500">{{ $element->description_en }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="brand_id"
                                                               class="control-label">{{ trans('general.brand') }}
                                                        </label>
                                                        <select id="" name="brand_id" class="form-control tooltips"
                                                                data-container="body" data-placement="top"
                                                                data-original-title="{{ trans('message.brand') }}">
                                                            <option
                                                                value="">{{ trans('general.choose_brand') }}</option>
                                                            @foreach($brands as $brand)
                                                                <option
                                                                    value="{{ $brand->id }}" {{ $element->brand_id && $element->brand->id == $brand->id ? 'selected' : null  }}>{{ $brand->slug }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div
                                                        class="form-group{{ $errors->has('order') ? ' has-error' : '' }}">
                                                        <label for="order"
                                                               class="control-label">{{ trans('general.sequence') }}</label>
                                                        <input id="order" type="text"
                                                               class="form-control tooltips"
                                                               data-container="body" data-placement="top"
                                                               data-original-title="{{ trans('message.sequence') }}"
                                                               name="order"
                                                               value="{{ $element->order }}"
                                                               placeholder="{{ trans('general.sequence') }}"
                                                               autofocus>
                                                        <span class="help-block text-danger">
                                                                    <small>
                                                                    يرجى وضع الرقم باللغة الانجليزية فقط
                                                                    </small>
                                                                    </span>
                                                        @if ($errors->has('order'))
                                                            <span class="help-block">
                                                                    <strong>
                                                                        {{ $errors->first('order') }}
                                                                    </strong>
                                                                </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div
                                                        class="form-group{{ $errors->has('sale_price') ? ' has-error' : '' }}">
                                                        <label for="sale_price"
                                                               class="control-label">{{ trans('general.sale_price') }}</label>
                                                        <input id="sale_price" type="text"
                                                               class="form-control tooltips"
                                                               data-container="body" data-placement="top"
                                                               data-original-title="{{ trans('message.sale_price') }}"
                                                               name="sale_price" maxlength="5"
                                                               value="{{ $element->sale_price }}"
                                                               placeholder="{{ trans('general.sale_price') }}"
                                                               autofocus>
                                                        @if ($errors->has('sale_price'))
                                                            <span class="help-block">
                                                                <strong>
                                                                    {{ $errors->first('sale_price') }}
                                                                </strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label
                                                            for="form_control_1">{{ trans('general.image_chart') }}</label>
                                                        <input type="file" class="form-control tooltips"
                                                               data-container="body" data-placement="top"
                                                               data-original-title="{{ trans('message.image_chart') }}"
                                                               name="size_chart_image"
                                                               placeholder="{{ trans('general.image_chart') }}">
                                                        <div class="help-block text-left">
                                                            {{ trans('message.best_fit',['width' => '1080 px', 'height' => '1440']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    @if($element->size_chart_image)
                                                        <img class="img-responsive img-sm"
                                                             src="{{ $element->getProductSizeChartImageAttribute() }}"
                                                             alt="">
                                                        <a href="{{ route("backend.admin.image.clear",['model' => 'product', 'id' => $element->id , 'colName' => 'size_chart_image']) }}"><i
                                                                class="fa fa-fw fa-times"></i></a>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                @if(!env('DESIGNERAAT') || auth()->user()->isSuper)
                                    <div class="portlet box blue ">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i> {{ trans('general.more_details') }}
                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="single"
                                                                   class="control-label">{{ trans('general.shipment_package') }}
                                                            </label>
                                                            <select id="" name="shipment_package_id"
                                                                    class="form-control tooltips"
                                                                    data-container="body"
                                                                    data-placement="top"
                                                                    data-original-title="{{ trans('message.shipment_package') }}"
                                                            >
                                                                <option
                                                                    value="">{{ trans('choose_product_package_grade') }}</option>
                                                                @foreach($shipment_packages as $shipment_package)
                                                                    <option
                                                                        value="{{ $shipment_package->id }}" {{ $element->shipment_package_id && $element->shipment_package_id == $shipment_package->id ? 'selected' : null  }}>
                                                                        {{ $shipment_package->slug_en }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="form-group">
                                                            <label for="file"
                                                                   class="control-label">{{ trans('general.qr') }}
                                                            </label>
                                                            <input class="form-control tooltips"
                                                                   data-container="body"
                                                                   data-placement="top"
                                                                   data-original-title="{{ trans('message.qr') }}"
                                                                   name="qr" placeholder="qr" type="file"/>
                                                            <div class="help-block text-left">
                                                                {{ trans('message.best_fit',['width' => '300 px', 'height' => '300 px']) }}
                                                            </div>
                                                            <div class="help-block text-left">
                                                                {{ trans('general.qr_link') . '  : ' . route('frontend.deep.linking',['id' => $element->id , 'model' => 'product','type' => 'product']) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if($element->qr)
                                                        <div class="col-md-1">
                                                            <img class="img-responsive img-sm"
                                                                 src="{{ asset(env('THUMBNAIL').$element->qr) }}"
                                                                 alt="">
                                                            <a href="{{ route("backend.admin.image.clear",['model' => 'product', 'id' => $element->id , 'colName' => 'qr']) }}"><i
                                                                    class="fa fa-fw fa-times"></i></a>
                                                        </div>
                                                    @endif
                                                    <div class="col-md-6">
                                                        <div
                                                            class="form-group{{ $errors->has('notes_ar') ? ' has-error' : '' }}">
                                                            <label for="notes_ar"
                                                                   class="control-label">{{ trans('general.notes_arabic') }}</label>
                                                            <input id="notes_ar" type="text"
                                                                   class="form-control tooltips"
                                                                   data-container="body"
                                                                   data-placement="top"
                                                                   data-original-title="{{ trans('message.notes_ar') }}"
                                                                   name="notes_ar"
                                                                   value="{{ $element->notes_ar }}"
                                                                   placeholder="{{ trans('general.notes_arabic') }} "
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
                                                    <div class="col-md-6">
                                                        <div
                                                            class="form-group{{ $errors->has('notes_en') ? ' has-error' : '' }}">
                                                            <label for="notes_en"
                                                                   class="control-label">{{ trans('general.notes_english') }}</label>
                                                            <input id="notes_en" type="text"
                                                                   class="form-control tooltips"
                                                                   data-container="body"
                                                                   data-placement="top"
                                                                   data-original-title="{{ trans('message.notes_en') }}"
                                                                   name="notes_en"
                                                                   value="{{ $element->notes_en }}"
                                                                   placeholder="{{ trans('general.notes_english') }}"
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
                                                    <div class="col-md-6">
                                                        <div
                                                            class="form-group{{ $errors->has('keywords') ? ' has-error' : '' }}">
                                                            <label for="keywords"
                                                                   class="control-label">{{ trans('general.keywords') }}</label>
                                                            <input id="keywords" type="text"
                                                                   class="form-control tooltips"
                                                                   data-container="body"
                                                                   data-placement="top"
                                                                   data-original-title="{{ trans('message.keywords') }}"
                                                                   name="keywords"
                                                                   value="{{ $element->keywords }}"
                                                                   placeholder="{{ trans('general.keywords') }}"
                                                                   autofocus>
                                                            @if ($errors->has('keywords'))
                                                                <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('keywords') }}
                                                        </strong>
                                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>


                                                    <div class="col-md-3">
                                                        <div
                                                            class="form-group{{ $errors->has('video_url_one') ? ' has-error' : '' }}">
                                                            <label for="video_url_one"
                                                                   class="control-label">{{ trans('general.video_url_one') }}</label>
                                                            <input id="video_url_one" type="url"
                                                                   class="form-control tooltips"
                                                                   data-container="body"
                                                                   data-placement="top"
                                                                   data-original-title="{{ trans('message.video_url_one') }}"
                                                                   name="video_url_one"
                                                                   value="{{ $element->video_url_one }}"
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
                                                    <div class="col-md-3">
                                                        <div
                                                            class="form-group{{ $errors->has('video_url_two') ? ' has-error' : '' }}">
                                                            <label for="video_url_two"
                                                                   class="control-label">{{ trans('general.video_url_two') }}</label>
                                                            <input id="video_url_two" type="url"
                                                                   class="form-control tooltips"
                                                                   data-container="body"
                                                                   data-placement="top"
                                                                   data-original-title="{{ trans('message.video_url_two') }}"
                                                                   name="video_url_two"
                                                                   value="{{ $element->video_url_two }}"
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
                                                    <div class="col-md-3">
                                                        <div
                                                            class="form-group{{ $errors->has('video_url_three') ? ' has-error' : '' }}">
                                                            <label for="video_url_three"
                                                                   class="control-label">{{ trans('general.video_url_three') }}</label>
                                                            <input id="video_url_three" type="url"
                                                                   class="form-control tooltips"
                                                                   data-container="body"
                                                                   data-placement="top"
                                                                   data-original-title="{{ trans('message.video_url_three') }}"
                                                                   name="video_url_three"
                                                                   value="{{ $element->video_url_three }}"
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
                                                    <div class="col-md-3">
                                                        <div
                                                            class="form-group{{ $errors->has('video_url_four') ? ' has-error' : '' }}">
                                                            <label for="video_url_four"
                                                                   class="control-label">{{ trans('general.video_url_four') }}</label>
                                                            <input id="video_url_four" type="url"
                                                                   class="form-control tooltips"
                                                                   data-container="body"
                                                                   data-placement="top"
                                                                   data-original-title="{{ trans('message.video_url_four') }}"
                                                                   name="video_url_four"
                                                                   value="{{ $element->video_url_four }}"
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
                                                    <div class="col-md-3">
                                                        <div
                                                            class="form-group{{ $errors->has('video_url_five') ? ' has-error' : '' }}">
                                                            <label for="video_url_five"
                                                                   class="control-label">{{ trans('general.video_url_five') }}</label>
                                                            <input id="video_url_five" type="url"
                                                                   class="form-control tooltips"
                                                                   data-container="body"
                                                                   data-placement="top"
                                                                   data-original-title="{{ trans('message.video_url_five') }}"
                                                                   name="video_url_five"
                                                                   value="{{ $element->video_url_five }}"
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
                                                    <div class="col-md-3">
                                                        <div
                                                            class="form-group{{ $errors->has('delivery_time') ? ' has-error' : '' }}">
                                                            <label for="delivery_time"
                                                                   class="control-label">{{ trans('general.delivery_time') }}
                                                            </label>
                                                            <input id="delivery_time" type="number" max="99"
                                                                   maxlength="2"
                                                                   class="form-control tooltips"
                                                                   data-container="body"
                                                                   data-placement="top"
                                                                   data-original-title="{{ trans('message.delivery_time') }}"
                                                                   name="delivery_time"
                                                                   value="{{ $element->delivery_time }}"
                                                                   placeholder="{{ trans('general.delivery_time') }}"
                                                                   autofocus>
                                                            @if ($errors->has('delivery_time'))
                                                                <span class="help-block">
                                                            <strong>
                                                                {{ $errors->first('delivery_time') }}
                                                            </strong>
                                                        </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div
                                                            class="form-group{{ $errors->has('barcode') ? ' has-error' : '' }}">
                                                            <label for="barcode"
                                                                   class="control-label">{{ trans('general.barcode') }}
                                                            </label>
                                                            <input id="barcode" type="text"
                                                                   class="form-control tooltips"
                                                                   data-container="body"
                                                                   data-placement="top"
                                                                   data-original-title="{{ trans('message.barcode') }}"
                                                                   name="barcode"
                                                                   value="{{ $element->barcode }}"
                                                                   placeholder="{{ trans('general.barcode') }}"
                                                                   autofocus>
                                                            @if ($errors->has('barcode'))
                                                                <span class="help-block">
                                                                    <strong>
                                                                        {{ $errors->first('barcode') }}
                                                                    </strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
{{--                                                    @if($element->barcode)--}}
{{--                                                        <div class="col-md-2">--}}
{{--                                                            {!! DNS2D::getBarcodeHTML($element->barcode, 'PDF417',2,1); !!}--}}
{{--                                                        </div>--}}
{{--                                                    @endif--}}
                                                    <div class="col-lg-12">
                                                        @if(!$tags->isEmpty())
                                                            <div class="col-lg-4 col-md-6">
                                                                <div class="form-group">
                                                                    <label
                                                                        class="control-label">{{ trans('general.tags') }}</label>
                                                                    <select multiple="multiple" class="multi-select"
                                                                            id="my_multi_select2" name="tags[]">
                                                                        @foreach($tags as $tag)
                                                                            <option
                                                                                value="{{ $tag->id }}" {{ in_array($tag->id,$element->tags->pluck('id')->unique()->flatten()->toArray()) ? 'selected' : null }}
                                                                            >{{ $tag->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @can('index','video')
                                                            @if(!$videos->isEmpty())
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label
                                                                            class="control-label">{{ trans('general.attach_videos_to_product') }}</label>
                                                                        <select multiple="multiple" class="multi-select"
                                                                                id="my_multi_select3" name="videos[]">
                                                                            @foreach($videos as $video)
                                                                                <option
                                                                                    value="{{ $video->id }}" {{ in_array($video->id,$element->tags->pluck('id')->unique()->flatten()->toArray()) ? 'selected' : null }}
                                                                                >{{ $video->name }}</option>
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
                                    </div>
                                @endif


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
                                                    <div class="col-lg-4 col-md-6">
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
                                                @endcan
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label sbold tooltips"
                                                               data-container="body" data-placement="top"
                                                               data-original-title="{{ trans('message.on_sale') }}">{{ trans('general.on_sale') }}</label></br>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="on_sale" id="optionsRadios3"
                                                                   {{ $element->on_sale ? 'checked' : null  }}
                                                                   value="1">
                                                            {{ trans('general.yes') }}</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="on_sale" id="optionsRadios4"
                                                                   {{ !$element->on_sale ? 'checked' : null  }}
                                                                   value="0">
                                                            {{ trans('general.no') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label sbold tooltips"
                                                               data-container="body" data-placement="top"
                                                               data-original-title="{{ trans('message.on_new') }}">{{ trans('general.on_new') }}</label></br>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="on_new" id="optionsRadios3"
                                                                   {{ $element->on_new ? 'checked' : null  }}
                                                                   value="1">
                                                            {{ trans('general.yes') }}</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="on_new" id="optionsRadios4"
                                                                   {{ !$element->on_new ? 'checked' : null  }}
                                                                   value="0">
                                                            {{ trans('general.no') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label sbold tooltips"
                                                               data-container="body" data-placement="top"
                                                               data-original-title="{{ trans('message.shipment_available') }}">{{ trans('general.shipment_available') }}</label></br>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="shipment_availability"
                                                                   {{ $element->shipment_availability ? 'checked' : null  }}
                                                                   id="optionsRadios3" value="1">
                                                            {{ trans('general.yes') }}</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="shipment_availability"
                                                                   {{ !$element->shipment_availability ? 'checked' : null  }}
                                                                   id="optionsRadios4" value="0">
                                                            {{ trans('general.no') }}</label>
                                                    </div>
                                                </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label sbold tooltips"
                                                                   data-container="body" data-placement="top"
                                                                   data-original-title="{{ trans('message.show_size_chart') }}">{{ trans('general.show_size_chart') }}</label></br>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="show_size_chart"
                                                                       id="optionsRadios3"
                                                                       {{ $element->show_size_chart ? 'checked' : null  }}
                                                                       value="1">
                                                                {{ trans('general.yes') }}</label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="show_size_chart"
                                                                       id="optionsRadios4"
                                                                       {{ !$element->show_size_chart ? 'checked' : null  }}
                                                                       value="0">
                                                                {{ trans('general.no') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label sbold tooltips"
                                                               data-container="body" data-placement="top"
                                                               data-original-title="{{ trans('message.on_homepage') }}">{{ trans('general.on_homepage') }}</label></br>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="on_home" id="optionsRadios3"
                                                                   {{ $element->on_home ? 'checked' : null  }}
                                                                   value="1">
                                                            {{ trans('general.yes') }}</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="on_home" id="optionsRadios4"
                                                                   {{ !$element->on_home ? 'checked' : null  }}
                                                                   value="0">
                                                            {{ trans('general.no') }}</label>
                                                    </div>

                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label sbold tooltips"
                                                               data-container="body" data-placement="top"
                                                               data-original-title="{{ trans('message.available') }}">{{ trans('general.home_delivery_available') }}</label></br>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="home_delivery_availability"
                                                                   {{ $element->home_delivery_availability ? 'checked' : null  }}
                                                                   id="optionsRadios3" value="1">
                                                            {{ trans('general.yes') }}</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="home_delivery_availability"
                                                                   {{ !$element->home_delivery_availability ? 'checked' : null  }}
                                                                   id="optionsRadios4" value="0">
                                                            {{ trans('general.no') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label sbold tooltips"
                                                               data-container="body" data-placement="top"
                                                               data-original-title="{{ trans('message.is_available') }}">{{ trans('general.is_available') }} {{ trans('general.order') }}</label></br>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="is_available"
                                                                   id="optionsRadios3"
                                                                   {{ $element->is_available ? 'checked' : null  }}
                                                                   value="1">
                                                            {{ trans('general.yes') }}</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="is_available"
                                                                   id="optionsRadios4"
                                                                   {{ !$element->is_available ? 'checked' : null  }}
                                                                   value="0">
                                                            {{ trans('general.no') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label sbold tooltips"
                                                               data-container="body" data-placement="top"
                                                               data-original-title="{{ trans('message.has_attributes') }}">{{ trans('general.has_attributes') }}</label></br>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="has_attributes"
                                                                   {{ $element->has_attributes ? 'checked' : null  }}
                                                                   id="optionsRadios8" value="1">
                                                            {{ trans('general.yes') }}</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="has_attributes"
                                                                   id="optionsRadios9"
                                                                   {{ !$element->has_attributes ? 'checked' : null  }} value="0">
                                                            {{ trans('general.no') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label sbold tooltips"
                                                               data-container="body" data-placement="top"
                                                               data-original-title="{{ trans('message.show_attribute') }}">{{ trans('general.show_attribute') }}</label></br>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="show_attribute"
                                                                   {{ $element->show_attribute ? 'checked' : null  }}
                                                                   id="optionsRadios8" value="1">
                                                            {{ trans('general.yes') }}</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="show_attribute"
                                                                   id="optionsRadios9"
                                                                   {{ !$element->show_attribute ? 'checked' : null  }} value="0">
                                                            {{ trans('general.no') }}</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label sbold tooltips"
                                                               data-container="body" data-placement="top"
                                                               data-original-title="{{ trans('message.exclusive') }}">{{ trans('general.exclusive') }}</label></br>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="exclusive" id="optionsRadios3"
                                                                   {{ $element->exclusive ? 'checked' : null  }}
                                                                   value="1">
                                                            {{ trans('general.yes') }}</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="exclusive" id="optionsRadios4"
                                                                   {{ !$element->exclusive ? 'checked' : null  }}
                                                                   value="0">
                                                            {{ trans('general.no') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label sbold tooltips"
                                                               data-container="body" data-placement="top"
                                                               data-original-title="{{ trans('message.is_hot_deal') }}">{{ trans('general.is_hot_deal') }}</label></br>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="is_hot_deal"
                                                                   id="optionsRadios7"
                                                                   {{ $element->is_hot_deal ? 'checked' : null  }}
                                                                   value="1">
                                                            {{ trans('general.yes') }}</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="is_hot_deal"
                                                                   id="optionsRadios8"
                                                                   {{ !$element->is_hot_deal ? 'checked' : null  }}
                                                                   value="0">
                                                            {{ trans('general.no') }}</label>
                                                    </div>

                                                </div>

                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label sbold tooltips"
                                                               data-container="body" data-placement="top"
                                                               data-original-title="{{ trans('message.check_stock') }}">

                                                            {{ trans('general.check_stock') }}</label></br>
                                                        <label class="radio-inline" data-toggle="tooltip"
                                                               data-placement="bottom" data-html="true" title=" If Not whenever a successful order is made. qty will not be decreased
                                        accordingly.">
                                                            <input type="radio" data-toggle="tooltip"
                                                                   {{ $element->check_stock ? 'checked' : null  }}
                                                                   data-placement="bottom" title="hello"
                                                                   name="check_stock" id="optionsRadios5" value="1">
                                                            {{ trans('general.yes') }}</label>
                                                        <label class="radio-inline" data-toggle="tooltip"
                                                               data-placement="bottom" data-html="true"
                                                               title=" if Not Product will be added to cart without checking the current quantity.">
                                                            <input type="radio" name="check_stock"
                                                                   id="optionsRadios6"
                                                                   {{ !$element->check_stock ? 'checked' : null  }}
                                                                   value="0">
                                                            {{ trans('general.no') }}</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label sbold tooltips"
                                                               data-container="body" data-placement="top"
                                                               data-original-title="{{ trans('message.wrap_as_gift') }}">{{ trans('general.wrap_as_gift') }}</label></br>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="wrap_as_gift"
                                                                   {{ $element->wrap_as_gift ? 'checked' : null  }}
                                                                   id="optionsRadios3" value="1">
                                                            {{ trans('general.yes') }}</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="wrap_as_gift"
                                                                   {{ !$element->wrap_as_gift ? 'checked' : null  }}
                                                                   id="optionsRadios4" value="0">
                                                            {{ trans('general.no') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label sbold tooltips"
                                                               data-container="body" data-placement="top"
                                                               data-original-title="{{ trans('message.direct_purchase') }}">{{ trans('general.direct_purchase') }}</label></br>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="direct_purchase"
                                                                   {{ $element->direct_purchase ? 'checked' : null  }}
                                                                   id="optionsRadios3" value="1">
                                                            {{ trans('general.yes') }}</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="direct_purchase"
                                                                   {{ !$element->direct_purchase ? 'checked' : null  }}
                                                                   id="optionsRadios4" value="0">
                                                            {{ trans('general.no') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label sbold tooltips"
                                                               data-container="body" data-placement="top"
                                                               data-original-title="{{ trans('message.tailor_measurement_service') }}">{{ trans('general.tailor_measurement_service') }}</label></br>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="tailor_measurement_service"
                                                                   {{ $element->tailor_measurement_service ? 'checked' : null  }}
                                                                   id="optionsRadios3" value="1">
                                                            {{ trans('general.yes') }}</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="tailor_measurement_service"
                                                                   {{ !$element->tailor_measurement_service ? 'checked' : null  }}
                                                                   id="optionsRadios4" value="0">
                                                            {{ trans('general.no') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions right">
                                {{--<button type="button" class="btn default">Cancel</button>--}}
                                <a href="{!! url()->previous() !!}"
                                   class="btn btn-danger">{{ trans('general.cancel') }}</a>
                                {{--<button type="submit" class="btn btn-warning">--}}
                                {{--<i class="fa fa-check"></i> Save & Go Back--}}
                                {{--</button>--}}

                                <button type="submit" class="btn btn-info">
                                    <i class="fa fa-save"></i> {{ trans("general.save") }}
                                </button>
                            </div>
                        </form>
                        <hr>
                        @include('backend.partials._element_images',['images' => $element->images])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
