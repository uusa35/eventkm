@extends('backend.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.admin.notification.index') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                @include('backend.partials.forms.form_title')
                <div class="portlet-body">
                    @include('backend.partials._admin_instructions',['title' => trans('general.notifications') ,'message' => trans('message.index_notification')])
                    <table id="dataTable" class="table table-striped table-bordered table-hover" cellspacing="0">
                        <thead>
                        <tr>
                            <th>{{ trans('general.id') }}</th>
                            <th>{{ trans('general.title') }}</th>
                            <th>{{ trans('general.type') }}</th>
                            <th>{{ trans('general.description') }}</th>
                            <th>{{ trans('general.created_at') }}</th>
                            {{--                            <th>{{ trans('general.actions') }}</th>--}}
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>{{ trans('general.id') }}</th>
                            <th>{{ trans('general.title') }}</th>
                            <th>{{ trans('general.type') }}</th>
                            <th>{{ trans('general.description') }}</th>
                            <th>{{ trans('general.created_at') }}</th>
                            {{--                            <th>{{ trans('general.actions') }}</th>--}}
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($elements as $element)
                            <tr>
                                <td> {{$element->id}}</td>
                                <td> {{$element->title}} </td>
                                <td> {{$element->type}} </td>
                                <td> {{$element->description}} </td>
                                <td> {{$element->created_at->diffForHumans()}} </td>
                                {{--                            <td>--}}
                                {{--                            <div class="btn-group">--}}
                                {{--                            <button type="button" class="btn green btn-xs btn-outline dropdown-toggle"--}}
                                {{--                            data-toggle="dropdown"> {{ trans('general.actions') }}--}}
                                {{--                            <i class="fa fa-angle-down"></i>--}}
                                {{--                            </button>--}}
                                {{--                            <ul class="dropdown-menu pull-right" role="menu">--}}
                                {{--                            <li>--}}
                                {{--                            <a href="{{ route('backend.faq.edit',$element->id) }}">--}}
                                {{--                            <i class="fa fa-fw fa-edit"></i> {{ trans('general.edit') }}</a>--}}
                                {{--                            </li>--}}
                                {{--                            <li>--}}
                                {{--                            <a data-toggle="modal" href="#" data-target="#basic"--}}
                                {{--                            data-title="Delete"--}}
                                {{--                            data-content="Are you sure you want to delete term {{ $element->title_ar }}? "--}}
                                {{--                            data-form_id="delete-{{ $element->id }}"--}}
                                {{--                            >--}}
                                {{--                            <i class="fa fa-fw fa-recycle"></i> {{ trans('general.delete') }}</a>--}}
                                {{--                            <form method="post" id="delete-{{ $element->id }}"--}}
                                {{--                            action="{{ route('backend.faq.destroy',$element->id) }}">--}}
                                {{--                            @csrf--}}
                                {{--                            <input type="hidden" name="_method" value="delete"/>--}}
                                {{--                            <button type="submit" class="btn btn-del hidden">--}}
                                {{--                            <i class="fa fa-fw fa-times-circle"></i> {{ trans('general.delete') }}--}}
                                {{--                            </button>--}}
                                {{--                            </form>--}}
                                {{--                            </li>--}}
                                {{--                            </ul>--}}
                                {{--                            </div>--}}
                                {{--                            </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection