@extends('backend.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.property.attach', $element) }}
@endsection

@section('content')
    <div class="portlet box blue">
        @include('backend.partials.forms.form_title',['title' => trans('general.attach_property')])
        <div class="portlet-body">
            @include('backend.partials._admin_instructions',['title' => trans('general.property') ,'message' =>
            trans('message.attach_property')])
            <div class="portlet-body form">
                <form class="horizontal-form" role="form" method="POST" action="{{ route('backend.property.attach') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $element->id }}">
                    <input type="hidden" name="id" value="{{ $element->id }}">
                    <div class="form-body">
                        <h3 class="form-section">{{ trans('general.attach_property') }}</h3>
                        <div class="portlet box blue ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i> {{ trans('general.main_details') }}
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="form-body">
                                    <div class="mt-element-step">
                                        <div class="row step-default">
                                            <div class="col-md-6 bg-success mt-step-col {{ Route::currentRouteName() === 'backend.classified.create' ? 'active' : null  }}">
                                                <div class="mt-step-number bg-white font-grey">1</div>
                                                <div class="mt-step-title uppercase font-grey-cascade">
                                                    {{ trans('general.attach_property') }}</div>
                                                <div class="mt-step-content font-grey-cascade">
                                                    {{ trans('message.attach_property') }}</div>
                                            </div>
                                            <div class="col-md-6 bg-grey mt-step-col {{ Route::currentRouteName() === 'backend.property.attach' ? 'active' : null  }}">
                                                <div class="mt-step-number bg-white font-grey">2</div>
                                                <div class="mt-step-title uppercase font-grey-cascade">
                                                    {{ trans('general.add_property') }}</div>
                                                <div class="mt-step-content font-grey-cascade">{{ trans('message.add_property') }}
                                                </div>
                                            </div>
                                            {{--<div class="col-md-4 bg-grey mt-step-col {{ Route::currentRouteName() === 'backend.gallery.create' ? 'active' : null  }}">--}}
                                            {{--<div class="mt-step-number bg-white font-grey">3</div>--}}
                                            {{--<div class="mt-step-title uppercase font-grey-cascade">{{ trans('general.create_gallery') }}
                                        </div>--}}
                                            {{--<div class="mt-step-content font-grey-cascade">{{ trans('general.create_gallery_for_product') }}
                                        </div>--}}
                                            {{--</div>--}}
                                        </div>
                                        <br/>
                                        <br/>
                                    </div>
                                    <br>
                                    @foreach($elements as $group)
                                        <div class="portlet box blue ">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-gift"></i> {{ $group->name }}
                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <div class="form-body">
                                                    <div class="row">
                                                        @if(!$group->is_multi)
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    @foreach($group->properties as $property)
                                                                        <input type="hidden" name="category_group_id[{{ $property->id }}]" value="{{ $group->id }}">
                                                                        <input type="radio"
                                                                               name="properties[{{ $property->id }}]"
                                                                               value="{{ $property->value  ? $property->value : $property->name}}"/>
                                                                        <label for="">{{ $property->name }}</label>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @else
                                                            @foreach($group->properties as $property)
                                                                <div class="col-md-4">
                                                                    <div class="form-group {{ $errors->has($property->name) ? ' has-error' : '' }}">
                                                                        <label for="name_ar"
                                                                               class="control-label">{{ $property->name }}
                                                                            *</label>
                                                                        <input type="hidden" name="category_group_id[{{ $property->id }}]" value="{{ $group->id }}">
                                                                        <input id="name_ar" type="text"
                                                                               class="form-control tooltips"
                                                                               data-container="body"
                                                                               data-placement="top"
                                                                               data-original-title="{{ $property->description }}"
                                                                               name="properties[{{ $property->id }}]"
                                                                               value="{{ $property->value ? $property->value : $property->name }}"
                                                                               placeholder="{{ $property->name }}"
                                                                               autofocus>
                                                                        @if ($errors->has('name_ar'))
                                                                            <span class="help-block">
                                                                            <strong>
                                                                                {{ $errors->first('name_ar') }}
                                                                            </strong>
                                                                        </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-body">
                        <div class="portlet box blue ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i> {{ trans('general.more_details') }}
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @include('backend.partials.forms._btn-group')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="{{ mix('js/datepicker.js') }}"></script>
@endsection
