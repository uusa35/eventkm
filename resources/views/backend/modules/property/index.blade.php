@extends('backend.layouts.app')
@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.admin.property.index') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                @include('backend.partials.forms.form_title',['title' => trans('general.index_property')])
                <div class="portlet-body">
                    @include('backend.partials._admin_instructions',['title' => trans('general.property') ,'message' => trans('message.index_property')])
                    <table id="dataTable" class="table table-striped table-bordered table-hover" cellspacing="0">
                        <thead>
                        <tr>
                            <th>{{ trans('general.id') }}</th>
                            <th>{{ trans('general.name_ar') }}</th>
                            <th>{{ trans('general.name_en') }}</th>
                            <th>{{ trans('general.value') }}</th>
                            <th>{{ trans('general.is_text') }}</th>
                            <th>{{ trans('general.is_checkbox') }}</th>
                            <th>{{ trans('general.category_group') }}</th>
                            <th>{{ trans('general.sequence') }}</th>
                            <th>{{ trans('general.active') }}</th>
                            <th>{{ trans('general.actions') }}</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>{{ trans('general.id') }}</th>
                            <th>{{ trans('general.name_ar') }}</th>
                            <th>{{ trans('general.name_en') }}</th>
                            <th>{{ trans('general.value') }}</th>
                            <th>{{ trans('general.is_text') }}</th>
                            <th>{{ trans('general.is_checkbox') }}</th>
                            <th>{{ trans('general.category_group') }}</th>
                            <th>{{ trans('general.sequence') }}</th>
                            <th>{{ trans('general.active') }}</th>
                            <th>{{ trans('general.actions') }}</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($elements as $element)
                            <tr>
                                <td> {{$element->id}}</td>
                                <td> {{$element->name_ar }} </td>
                                <td> {{$element->name_en }} </td>
                                <td><span class="btn btn-info btn-lg">{{$element->value }} </span></td>
                                <td>
                                    <span class="label {{ activeLabel($element->is_text) }}">{{ activeText($element->is_text) }}</span>
                                </td>
                                <td>
                                    <span class="label {{ activeLabel($element->is_checkbox) }}">{{ activeText($element->is_checkbox) }}</span>
                                </td>
                                <td>
                                    @if($element->categoryGroups->isNotEmpty())
                                        <ul>
                                            @foreach($element->categoryGroups as $group)
                                                <li>{{ $group->name }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <label class="label label-default">N/A</label>
                                    @endif
                                </td>
                                <td> {{$element->order }} </td>
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
                                                <a href="{{ route('backend.admin.property.edit',$element->id) }}">
                                                    <i class="fa fa-fw fa-edit"></i> {{ trans('general.edit') }}</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('backend.activate',['model' => 'property','id' => $element->id]) }}">
                                                    <i class="fa fa-fw fa-check-circle"></i> {{ trans('general.toggle_active') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a data-toggle="modal" href="#" data-target="#basic" data-title="Delete"
                                                   data-content="Are you sure you want to delete day {{ $element->name }}? "
                                                   data-form_id="delete-{{ $element->id }}">
                                                    <i class="fa fa-fw fa-recycle"></i> {{ trans('general.delete') }}
                                                </a>
                                                <form method="post" id="delete-{{ $element->id }}"
                                                      action="{{ route('backend.admin.property.destroy',$element->id) }}">
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