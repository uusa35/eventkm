@extends('backend.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.admin.coupon.index') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                @include('backend.partials.forms.form_title',['title' => trans('general.index_coupon')])
                <div class="portlet-body">
                    @include('backend.partials._admin_instructions',['title' => trans('general.coupons') ,'message' => trans('message.index_coupon')])
                    <table id="dataTable" class="table table-striped table-bordered table-hover" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th>{{ trans('general.id') }}</th>
                            <th>{{ trans('general.is_percentage') }}</th>
                            <th>{{ trans('general.is_consumed') }}</th>
                            <th>{{ trans('general.is_permanent') }}</th>
                            <th>{{ trans('general.code') }}</th>
                            <th>{{ trans('general.minimum_charge') }}</th>
                            <th>{{ trans('general.owner') }}</th>
                            <th>{{ trans('general.due_date') }}</th>
                            <th>{{ trans('general.active') }}</th>
                            <th>{{ trans('general.actions') }}</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>{{ trans('general.id') }}</th>
                            <th>{{ trans('general.is_percentage') }}</th>
                            <th>{{ trans('general.is_consumed') }}</th>
                            <th>{{ trans('general.is_permanent') }}</th>
                            <th>{{ trans('general.code') }}</th>
                            <th>{{ trans('general.minimum_charge') }}</th>
                            <th>{{ trans('general.owner') }}</th>
                            <th>{{ trans('general.due_date') }}</th>
                            <th>{{ trans('general.active') }}</th>
                            <th>{{ trans('general.actions') }}</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($elements as $element)
                            <tr>
                                <td>{{ $element->id }}</td>
                                <td>
                                    <span class="label {{ activeLabel($element->is_percentage) }}">{{ activeText($element->is_percentage,'Percentage') }}</span>
                                </td>
                                <td>
                                    <span class="label {{ activeLabel($element->consumed) }}">{{ activeText($element->consumed,'Consumed') }}</span>
                                </td>
                                <td>
                                    <span class="label {{ activeLabel($element->is_permanent) }}">{{ activeText($element->is_permanent,'is_permanent') }}</span>
                                </td>
                                <td>{{ $element->code }}</td>
                                <td>{{ $element->minimum_charge}}</td>
                                <td>{{ $element->user ? $element->user->name : 'N/A'}}</td>
                                <td>
                                    <span class="label {{ activeLabel($element->active) }}">{{ activeText($element->active,$element->due_date->format('d-M-Y')) }}</span>
                                </td>
                                <td>
                                    <span class="label {{ activeLabel($element->active) }}">{{ activeText($element->active) }}</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn green btn-xs btn-outline dropdown-toggle"
                                                data-toggle="dropdown"> {{ trans('general.actions') }}
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            <li>
                                                <a href="{{ route('backend.admin.coupon.edit',$element->id) }}">
                                                    <i class="fa fa-fw fa-edit"></i> {{ trans('general.edit') }}</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('backend.activate',['model' => 'coupon','id' => $element->id]) }}">
                                                    <i class="fa fa-fw fa-check-circle"></i> {{ trans('general.toggle_active') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a data-toggle="modal" href="#" data-target="#basic" data-title="Delete"
                                                   data-content="Are you sure you want to delete coupon? "
                                                   data-form_id="delete-{{ $element->id }}">
                                                    <i class="fa fa-fw fa-recycle"></i> delete</a>
                                                <form method="post" id="delete-{{ $element->id }}"
                                                      action="{{ route('backend.admin.coupon.destroy',$element->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="delete"/>
                                                    <button type="submit" class="btn btn-del hidden">
                                                        <i class="fa fa-fw fa-times-circle"></i> {{ trans('general.delete') }}
                                                    </button>
                                                </form>
                                            </li>
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
