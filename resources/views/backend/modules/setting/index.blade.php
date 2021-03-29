@extends('backend.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.admin.setting.index') }}
@endsection

@section('content')
    <div class="portlet light ">
        @include('backend.partials.forms.form_title',['title' => trans('general.edit_setting')])
        <div class="portlet-body">
            <div class="row">
                <div class="col-lg-12">
                    @include('backend.partials._admin_instructions',['title' => trans('general.settings') ,'message' => trans('message.settings')])
                    <div class="col-lg-12">
                        <div class="col-lg-12">
                            <div class="pull-right">
                                <a href="{{ route('backend.admin.setting.edit',$element->id) }}"
                                   class="btn btn-primary">{{ trans('general.edit') }}</a>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="text-uppercase">{{ trans('general.edit_setting') }} </h3>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-striped">
                                        <tbody>
                                        <tr>
                                            <td>{{ trans('general.name_ar') }}</td>
                                            <td>{{ $element->company_ar }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ trans('general.name_en') }}</td>
                                            <td>{{ $element->company_en }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ trans('general.phone') }}</td>
                                            <td>{{ $element->phone ? $element->phone : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ trans('general.mobile') }}</td>
                                            <td>{{ $element->mobile ? $element->mobile : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ trans('general.whatsapp') }}</td>
                                            <td>{{ $element->whatsapp ? $element->whatsapp : 'N/A'}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ trans('general.email') }}</td>
                                            <td>{{ $element->email ? $element->email : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{trans('general.address_ar')}}</td>
                                            <td>{{ $element->address_ar ? $element->address_ar : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ trans('general.address_en') }}</td>
                                            <td>{{ $element->address_en  ? $element->address_en : 'N/A'}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ trans('general.instagram') }}</td>
                                            <td><a href="{{ $element->instagram ? $element->instagram : '#'}}" target="_blank">{{ $element->instagram ? $element->instagram : 'N/A'}}</a></td>
                                        </tr>
                                        <tr>
                                            <td>{{ trans('general.facebook') }}</td>
                                            <td><a href="{{ $element->facebook ? $element->facebook : '#'}}" target="_blank">{{ $element->facebook ? $element->facebook : 'N/A'}}</a></td>
                                        </tr
                                        <tr>
                                            <td>{{ trans("general.twitter") }}</td>
                                            <td><a href="{{ $element->twitter ? $element->twitter : '#'}}" target="_blank">{{ $element->twitter ? $element->twitter : 'N/A'}}</a></td>
                                        </tr>
                                        <tr>
                                            <td>{{ trans('general.snapchat') }}</td>
                                            <td>{{ $element->snapchat ? $element->snapchat : 'N/A'}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ trans('general.youtube') }}</td>
                                            <td><a href="{{ $element->youtube  ? $element->youtube : '#'}}" target="_blank">{{ $element->youtube  ? $element->youtube : 'N/A'}}</a></td>
                                        </tr>
                                        <tr>
                                            <td>{{ trans('general.payment_method') }}</td>
                                            <td><label
                                                    class="label label-primary">{{ strtoupper($element->payment_method) }}</label>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-3">
                            <h5>{{ trans('general.logo') }}</h5>
                            <img src="{{ $element->logoThumb }}"
                                 alt="" class="img-responsive img-thumbnail img-sm">
                        </div>
                        @can('index','product')
                            @if($element->size_chart)
                                <div class="col-lg-3 img-responsive">
                                    <h5>{{ trans('general.size_chart') }}</h5>
                                    <img src="{{ $element->sizeChartImage }}"
                                         alt="" class="img-responsive img-thumbnail">
                                </div>
                            @endif
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
