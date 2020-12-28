@extends('backend.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light ">
            @include('backend.partials.forms.form_title')
            <div class="portlet-body">
                @include('backend.partials._admin_instructions',['title' => trans('general.questions') ,'message' => trans('message.index_question')])
                <table id="dataTable" class="table table-striped table-bordered table-hover" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ trans('general.id') }}</th>
                            <th>{{ trans('general.name_ar') }}</th>
                            <th>{{ trans('general.name_en') }}</th>
                            <th>{{ trans('general.is_multi') }}</th>
                            <th>{{ trans('general.is_text') }}</th>
                            <th>{{ trans('general.active') }}</th>
                            <th>{{ trans('general.order') }}</th>
                            <th>{{ trans('general.created_at') }} </th>
                            <th>{{ trans('general.actions') }}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>{{ trans('general.id') }}</th>
                            <th>{{ trans('general.name_ar') }}</th>
                            <th>{{ trans('general.name_en') }}</th>
                            <th>{{ trans('general.is_multi') }}</th>
                            <th>{{ trans('general.is_text') }}</th>
                            <th>{{ trans('general.active') }}</th>
                            <th>{{ trans('general.order') }}</th>
                            <th>{{ trans('general.created_at') }} </th>
                            <th>{{ trans('general.actions') }}</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($elements as $element)
                        <tr>
                            <td>{{ $element->id }}</td>
                            <td>{{ $element->name_ar }}</td>
                            <td>{{ $element->name_en }}</td>
                            <td>
                                <span class="label {{ activeLabel($element->is_multi) }}">{{ activeText($element->is_multi) }}</span>
                            </td>
                            <td>
                                <span class="label {{ activeLabel($element->is_text) }}">{{ activeText($element->is_text) }}</span>
                            </td>
                            <td>
                                <span class="label {{ activeLabel($element->active) }}">{{ activeText($element->is_home) }}</span>
                            </td>
                            <td>
                                <span class="label label-warning">{{ $element->order }}</span>
                            </td>
                            <td>
                                <span class="label label-warning">{{ $element->created_at->diffForHumans() }}</span>
                            </td>
                            <td>
                                <div class="btn-group pull-right">
                                    <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> {{ trans('general.actions') }}
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="{{ route('backend.admin.question.edit',$element->id) }}">
                                                <i class="fa fa-fw fa-edit"></i> {{ trans('general.edit') }}</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('backend.admin.answer.index',['question_id' => $element->id]) }}">
                                                <i class="fa fa-fw fa-edit"></i>{{ trans('general.answers_list') }}</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('backend.activate',['model' => 'question','id' => $element->id]) }}">
                                                <i class="fa fa-fw fa-check-circle"></i> {{ trans('general.toggle_active') }}</a>
                                        </li>
                                        <li>
                                            <a data-toggle="modal" href="#" data-target="#basic" data-title="Delete" data-content="Are you sure you want to delete {{ $element->name  }}? " data-form_id="delete-{{ $element->id }}">
                                                <i class="fa fa-fw fa-recycle"></i> {{ trans('general.delete') }}</a>
                                            <form method="post" id="delete-{{ $element->id }}" action="{{ route('backend.admin.question.destroy',$element->id) }}">
                                                @csrf
                                                <input type="hidden" name="_method" value="delete" />
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
