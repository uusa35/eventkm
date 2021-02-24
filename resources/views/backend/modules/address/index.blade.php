@extends('backend.layouts.app')

@section('breadcrumbs')
{{ Breadcrumbs::render('backend.admin.address.index') }}
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light ">
            @include('backend.partials.forms.form_title',['title' => trans('general.countries')])
            <div class="portlet-body">
                @include('backend.partials._admin_instructions',['title' => trans('general.countries') ,'message' => trans('message.index_address')])
                <table id="dataTable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>{{ trans('general.id') }}</th>
                            <th>{{ trans('general.name') }}</th>
                            <th>{{ trans('general.content') }}</th>
                            <th>{{ trans('general.block') }}</th>
                            <th>{{ trans('general.street') }}</th>
                            <th>{{ trans('general.building') }}</th>
                            <th>{{ trans('general.floor') }}</th>
                            <th>{{ trans('general.apartment') }}</th>
                            <th>{{ trans('general.area') }}</th>
                            <th>{{ trans('general.governate') }}</th>
                            <th>{{ trans('general.country') }}</th>
                            <th>{{ trans('general.active') }}</th>
                            <th>{{ trans('general.actions') }}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>{{ trans('general.id') }}</th>
                            <th>{{ trans('general.name') }}</th>
                            <th>{{ trans('general.content') }}</th>
                            <th>{{ trans('general.block') }}</th>
                            <th>{{ trans('general.street') }}</th>
                            <th>{{ trans('general.building') }}</th>
                            <th>{{ trans('general.floor') }}</th>
                            <th>{{ trans('general.apartment') }}</th>
                            <th>{{ trans('general.area') }}</th>
                            <th>{{ trans('general.governate') }}</th>
                            <th>{{ trans('general.country') }}</th>
                            <th>{{ trans('general.active') }}</th>
                            <th>{{ trans('general.actions') }}</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($elements as $element)
                        <tr>
                            <td>{{ $element->id }}</td>
                            <td>{{ $element->name }}</td>
                            <td>{{ $element->content }}</td>
                            <td>{{ $element->block }}</td>
                            <td>{{ $element->street }}</td>
                            <td>{{ $element->building }}</td>
                            <td>{{ $element->floor }}</td>
                            <td>{{ $element->apartment }}</td>
                            <td>{{ $element->area }}</td>
                            <td>{{ $element->governate ? $element->governate->slug : trans('general.not_available')}}</td>
                            <td>{{ $element->country_name }}</td>
                            <td>
                                <span class="label {{ activeLabel($element->active) }}">{{ activeText($element->active) }}</span>
                            </td>
                            <td>
                                <div class="btn-group pull-right">
                                    <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> {{ trans('general.actions') }}
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="{{ route('backend.admin.address.edit',$element->id) }}">
                                                <i class="fa fa-fw fa-edit"></i>{{ trans('general.edit') }}</a>
                                        </li>
                                        @if($elements->where('active', true)->count() > 1)
                                        <li>
                                            <a href="{{ route('backend.activate',['model' => 'address','id' => $element->id]) }}">
                                                <i class="fa fa-fw fa-check-circle"></i> {{ trans('general.toggle_active') }}</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
