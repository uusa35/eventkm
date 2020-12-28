@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                @include('backend.partials.forms.form_title',['title' => trans('general.index_activity')])
                <div class="portlet-body">
                    @include('backend.partials._admin_instructions',['title' => trans('general.activities') ,'message' => trans('message.index_activity')])
                    <table id="dataTable" class="table table-striped table-bordered table-hover" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th class="all">{{ trans('general.id') }}</th>
                            <th>{{ trans('general.subject') }}</th>
                            <th>{{ trans('general.subject_id') }} {{ trans('general.edit')}}</th>
                            <th>{{ trans('general.description') }}</th>
                            <th>{{ trans('general.user_name') }}</th>
                            <th>{{ trans('general.user_id') }}</th>
                            <th>{{ trans('general.created_at') }}</th>
                            <th>{{ trans('general.actions') }}</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th class="all">{{ trans('general.id') }}</th>
                            <th>{{ trans('general.subject') }}</th>
                            <th>{{ trans('general.subject_id') }} {{ trans('general.edit')}}</th>
                            <th>{{ trans('general.description') }}</th>
                            <th>{{ trans('general.user_name') }}</th>
                            <th>{{ trans('general.user_id') }}</th>
                            <th>{{ trans('general.created_at') }}</th>
                            <th>{{ trans('general.actions') }}</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($elements as $element)
                            <tr>
                                <td>{{ $element->id }}</td>
                                <td>{{ $element->subject_type }}</td>
                                <td>{{ $element->subject_id }}</td>
                                <td>{{ $element->description }}</td>
                                <td>{{ $element->causer ? str_limit($element->causer->name,25)  : 'N/A'}}</td>
                                <td>{{ $element->causer ? $element->causer->id  : 'N/A'}}</td>
                                <td>{{ $element->created_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn green btn-xs btn-outline dropdown-toggle"
                                                data-toggle="dropdown"> {{ trans('general.actions') }}
                                            <i class="fa fa-angle-down"></i>
                                        </button>
{{--                                        <ul class="dropdown-menu pull-right" role="menu">--}}
{{--                                            <li>--}}
{{--                                                <a href="{{ route('backend.activity.restore',$element->id) }}">--}}
{{--                                                    <i class="fa fa-fw fa-edit"></i> {{ trans('general.restore') }}--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $elements->render('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
