@extends('backend.layouts.app')
@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.slide.index') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                @include('backend.partials.forms.form_title',['title' => trans('general.slides')])
                <div class="portlet-body">
                    @include('backend.partials._admin_instructions',['title' => trans('general.slides') ,'message' => trans('message.index_slide')])
                    <table id="dataTable" class="table table-striped table-bordered table-hover" cellspacing="0">
                        <thead>
                        <tr>
                            <th>{{ trans('general.id') }}</th>
                            <th>{{ trans('general.url') }}</th>
                            <th>{{ trans('general.sequence') }}</th>
                            <th>{{ trans('general.image') }}</th>
                            <th>{{ trans('general.active') }}</th>
                            <th>{{ trans('general.created_at') }}</th>
                            <th>{{ trans('general.file') }}</th>
                            <th class="none">{{ trans('general.type') }}</th>
                            <th class="none">{{ trans('general.type_id') }}</th>
                            <th>{{ trans('general.actions') }}</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>{{ trans('general.id') }}</th>
                            <th>{{ trans('general.url') }}</th>
                            <th>{{ trans('general.sequence') }}</th>
                            <th>{{ trans('general.image') }}</th>
                            <th>{{ trans('general.active') }}</th>
                            <th>{{ trans('general.created_at') }}</th>
                            <th>{{ trans('general.file') }}</th>
                            <th class="none">{{ trans('general.type_id') }}</th>
                            <th>{{ trans('general.actions') }}</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($elements as $element)
                            <tr>
                                <td>{{ $element->id }}</td>
                                <td>
                                    {{ str_limit($element->url,20,'..') }}
                                </td>
                                <td>{{ $element->order }}</td>
                                <td>
                                    <img src="{{ $element->imageThumbLink }}" alt=""
                                         class="img-responsive img-xs">
                                </td>
                                <td>
                                    <span
                                        class="label {{ activeLabel($element->active) }}">{{ activeText($element->active) }}</span>
                                </td>
                                <td>{{ $element->created_at->diffForHumans() }}</td>
                                <td>
                                    @if($element->path)
                                        <a class="btn btn-info"
                                           href="{{ asset(env('FILES').$element->path) }}">{{ $element->caption }}</a>
                                    @else
                                        <div class="alert alert-info">No Path</div>
                                    @endif
                                </td>
                                <td>{{ $element->slidable_type }}</td>
                                <td>{{ $element->slidable_id }}</td>
                                <td>
                                    <div class="btn-group pull-right">
                                        <button type="button" class="btn green btn-sm btn-outline dropdown-toggle"
                                                data-toggle="dropdown"> {{ trans('general.actions') }}
                                            <i class="fa fa-angle-down"></i>
                                        </button>

                                        <ul class="dropdown-menu pull-right" role="menu">
                                            @if(!$element->trashed())
                                                <li>
                                                    <a href="{{ route('backend.slide.edit',$element->id) }}">
                                                        <i class="fa fa-fw fa-user"></i>{{ trans('general.edit') }}</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('backend.activate',['model' => 'slide','id' => $element->id]) }}">
                                                        <i class="fa fa-fw fa-check-circle"></i> {{ trans('general.toggle_active') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-toggle="modal" href="#" data-target="#basic"
                                                       data-title="Delete"
                                                       data-content="Are you sure you want to delete slide ? "
                                                       data-form_id="delete-{{ $element->id }}">
                                                        <i class="fa fa-fw fa-recycle"></i> {{ trans('general.delete') }}
                                                    </a>
                                                    <form method="post" id="delete-{{ $element->id }}"
                                                          action="{{ route('backend.slide.destroy',$element->id) }}">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="delete"/>
                                                        <button type="submit" class="btn btn-del hidden">
                                                            <i class="fa fa-fw fa-times-circle"></i> {{ trans('general.delete') }}
                                                        </button>
                                                    </form>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ route('backend.slide.restore',$element->id) }}">
                                                        <i class="fa fa-fw fa-window-restore"></i> {{ trans('general.restore') }}
                                                    </a>
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
