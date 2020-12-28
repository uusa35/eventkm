@extends('backend.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.admin.survey.index') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                @include('backend.partials.forms.form_title',['title' => trans('general.surveys')])
                <div class="portlet-body">
                    @include('backend.partials._admin_instructions',['title' => trans('general.surveys') ,'message' => trans('message.index_survey')])
                    <table id="dataTable" class="table table-striped table-bordered table-hover" cellspacing="0">
                        <thead>
                        <tr>
                            <th>{{ trans('general.id') }}</th>
                            <th>{{ trans('general.name') }}</th>
                            <th>{{ trans('general.slug_ar') }}</th>
                            <th>{{ trans('general.slug_en') }}</th>
                            <th>{{ trans('general.is_home') }}</th>
                            <th>{{ trans('general.is_desktop') }}</th>
                            <th>{{ trans('general.is_footer') }}</th>
                            <th>{{ trans('general.active') }}</th>
                            <th>{{ trans('general.order') }}</th>
                            <th>{{ trans('general.url') }}</th>
                            <th>{{ trans('general.actions') }}</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>{{ trans('general.id') }}</th>
                            <th>{{ trans('general.name') }}</th>
                            <th>{{ trans('general.slug_ar') }}</th>
                            <th>{{ trans('general.slug_en') }}</th>
                            <th>{{ trans('general.is_home') }}</th>
                            <th>{{ trans('general.is_desktop') }}</th>
                            <th>{{ trans('general.is_footer') }}</th>
                            <th>{{ trans('general.active') }}</th>
                            <th>{{ trans('general.order') }}</th>
                            <th>{{ trans('general.url') }}</th>
                            <th>{{ trans('general.actions') }}</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($elements as $element)
                            <tr>
                                <td>{{ $element->id }}</td>
                                <td>{{ $element->name }}</td>
                                <td>{{ $element->slug_ar }}</td>
                                <td>{{ $element->slug_en }}</td>
                                <td>
                                    <span class="label {{ activeLabel($element->is_home) }}">{{ activeText($element->is_home) }}</span>
                                </td>
                                <td>
                                    <span class="label {{ activeLabel($element->is_desktop) }}">{{ activeText($element->is_desktop) }}</span>
                                </td>
                                <td>
                                    <span class="label {{ activeLabel($element->is_footer) }}">{{ activeText($element->is_footer) }}</span>
                                </td>
                                <td>
                                    <span class="label {{ activeLabel($element->active) }}">{{ activeText($element->is_home) }}</span>
                                </td>
                                <td>
                                    <span class="label label-warning">{{ $element->order }}</span>
                                </td>
                                <td>
                                <span class="btn btn-success btn-circle">
                                    <a href="{{ url(config('app.url').'/survey/'.$element->id.'?user_id=1') }}">{{ config('app.url') }}
                                        /survey/{{ $element->id.'?user_id=1' }}</a>
                                </span>
                                </td>
                                <td>
                                    <div class="btn-group pull-right">
                                        <button type="button" class="btn green btn-sm btn-outline dropdown-toggle"
                                                data-toggle="dropdown"> {{ trans('general.actions') }}
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            <li>

                                                <a href="{{ route('frontend.survey.show',[$element->id,'user_id' => auth()->id()]) }}">
                                                    <i class="fa fa-fw fa-eye"></i>{{ trans('general.view_survey') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('backend.admin.survey.edit',$element->id) }}">
                                                    <i class="fa fa-fw fa-edit"></i>{{ trans('general.edit') }}</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('backend.activate',['model' => 'survey','id' => $element->id]) }}">
                                                    <i class="fa fa-fw fa-check-circle"></i> {{ trans('general.toggle_active') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a data-toggle="modal" href="#" data-target="#basic" data-title="Delete"
                                                   data-content="Are you sure you want to delete {{ $element->name  }}? "
                                                   data-form_id="delete-{{ $element->id }}">
                                                    <i class="fa fa-fw fa-recycle"></i> {{ trans('general.delete') }}
                                                </a>
                                                <form method="post" id="delete-{{ $element->id }}"
                                                      action="{{ route('backend.admin.survey.destroy',$element->id) }}">
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
                    @if($elements->render())
                        {{ $elements->render('pagination::bootstrap-4') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
