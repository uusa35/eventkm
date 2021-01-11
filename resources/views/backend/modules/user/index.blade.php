@extends('backend.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.admin.user.index') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                @include('backend.partials.forms.form_title',['title' => trans('general.index_user')])
                <div class="portlet-body">
                    @include('backend.partials._admin_instructions',['title' => trans('general.users') ,'message' => trans('message.index_user')])
                    <table id="dataTableLong" class="table table-striped table-bordered table-hover" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="all">{{ trans('general.id') }}</th>
                            <th class="none">{{ trans('general.name') }}</th>
                            <th>{{ trans('general.slug') }}</th>
                            <th>{{ trans('general.logo') }}</th>
                            <th class="none">{{ trans('general.email') }}</th>
                            <th>{{ trans('general.mobile') }}</th>
                            <th class="none">{{ trans('general.phone') }}</th>
                            <th class="none">{{ trans('general.address') }}</th>
                            <th>{{ trans('general.country') }}</th>
                            <th>{{ trans('general.role') }}</th>
                            <th>{{ trans('general.active') }}</th>
                            <th class="none">{{ trans('general.access_dashboard') }}</th>
                            <th class="none">{{ trans('general.categories') }}</th>
                            <th class="none">{{ trans('general.created_at') }}</th>
                            <th>{{ trans('general.actions') }}</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th class="all">{{ trans('general.id') }}</th>
                            <th class="none">{{ trans('general.name') }}</th>
                            <th>{{ trans('general.slug') }}</th>
                            <th>{{ trans('general.logo') }}</th>
                            <th class="none">{{ trans('general.email') }}</th>
                            <th>{{ trans('general.mobile') }}</th>
                            <th class="none">{{ trans('general.phone') }}</th>
                            <th class="none">{{ trans('general.address') }}</th>
                            <th>{{ trans('general.country') }}</th>
                            <th>{{ trans('general.role') }}</th>
                            <th>{{ trans('general.active') }}</th>
                            <th class="none">{{ trans('general.access_dashboard') }}</th>
                            <th class="none">{{ trans('general.categories') }}</th>
                            <th class="none">{{ trans('general.created_at') }}</th>
                            <th>{{ trans('general.actions') }}</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($elements as $element)
                            <tr>
                                <td>{{ $element->id }}</td>
                                <td>{{ $element->name }} / {{ $element->slug_en }} / {{ $element->slug_ar }}</td>
                                <td>{{ $element->slug ? $element->slug : $element->name }}</td>
                                <td><img src="{{ $element->getCurrentImageAttribute() }}" alt="" class="img-xs"/></td>
                                <td>{{ $element->email  }}</td>
                                <td>{{ $element->fullMobile }}</td>
                                <td>{{ $element->phone ?? 'N/A' }}</td>
                                <td>{{ $element->address }}</td>
                                {{--                                <td>{{ $element->area }}</td>--}}
                                <td>{{ $element->country ? $element->country->slug : 'N/A'}}</td>
                                <td>
                                    @if($element->role)
                                        <button class="btn red {{ activeLabel(!$element->active) }}">{{ activeText($element->active, $element->role->slug) }}</button>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn {{ activeBtn($element->active) }}">{{ activeText($element->active) }}</button>
                                </td>
                                <td>
                                    <button class="btn {{ activeBtn($element->access_dashboard) }}">{{ activeText($element->access_dashboard) }}</button>
                                </td>
                                <td>
                                    @if($element->categories->isNotEmpty())
                                        <div class="col-lg-12">
                                            @foreach($element->categories as $c)
                                                <button type="button" class="btn green btn-xs">{{ $c->name }}</button>
                                            @endforeach
                                        </div>
                                    @else
                                        <button class="btn-sm btn-danger">N/A</button>
                                    @endif
                                </td>
                                <td>{{ $element->created_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn green btn-xs btn-outline dropdown-toggle"
                                                data-toggle="dropdown"> {{ trans('general.actions') }}
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            @if(!$element->deleted_at)
                                                <li>
                                                    <a href="{{ route('backend.reset.password',['email' => $element->email]) }}">
                                                        <i class="fa fa-fw fa-edit"></i> Reset Password</a>
                                                </li>
                                                @if(auth()->user()->isAdmin)
                                                    <li>
                                                        <a href="{{ route('backend.user.edit',$element->id) }}">
                                                            <i class="fa fa-fw fa-check-circle"></i> {{ trans('general.edit') }}
                                                        </a>
                                                    </li>
                                                @endif
                                                <li>
                                                    <a href="{{ route('backend.activate',['model' => 'user','id' => $element->id]) }}">
                                                        <i class="fa fa-fw fa-check-circle"></i> {{ trans('general.account') }} {{ trans('general.toggle_active') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('backend.access.dashboard',['model' => 'user','id' => $element->id]) }}">
                                                        <i class="fa fa-fw fa-check-circle"></i> {{ trans('general.toggle_access_dashboard') }}
                                                    </a>
                                                </li>
                                                @can('isAdminOrAbove')
                                                    <li>
                                                        <a href="{{ route('backend.slide.create',['slidable_id' => $element->id, 'slidable_type' => 'user']) }}">
                                                            <i class="fa fa-fw fa-edit"></i> {{ trans('general.new_slide') }}
                                                        </a>
                                                    </li>
                                                    @if($element->slides->isNotEmpty())
                                                        <li>
                                                            <a href="{{ route('backend.slide.index',['slidable_id' => $element->id, 'slidable_type' => 'user']) }}">
                                                                <i class="fa fa-fw fa-edit"></i> {{ trans('general.list_of_slides') }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endcan
                                                <li>
                                                    <a data-toggle="modal" href="#" data-target="#basic"
                                                       data-title="Delete"
                                                       data-content="Are you sure you want to delete {{ $element->name  }}?
                                                   </br> <h3 class='text-danger'>please note that all favorites / coupons shall be deleted accordingly.</h3>
                                                    " data-form_id="delete-{{ $element->id }}">
                                                        <i class="fa fa-fw fa-recycle"></i> {{ trans('general.delete') }}
                                                    </a>
                                                    <form method="post" id="delete-{{ $element->id }}"
                                                          action="{{ route('backend.admin.user.destroy',$element->id) }}">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="delete"/>
                                                        <button type="submit" class="btn btn-del hidden">
                                                            <i class="fa fa-fw fa-times-circle"></i> {{ trans('general.delete') }}
                                                        </button>
                                                    </form>
                                                </li>
                                            @else
                                                @can('isAdminOrAbove')
                                                    <li>
                                                        <a href="{{ route('backend.admin.user.restore',$element->id) }}">
                                                            <i class="fa fa-fw fa-undo"></i> {{ trans('general.restore') }}
                                                        </a>
                                                    </li>
                                                @endcan
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
{{--                    {{ $elements->render('pagination::bootstrap-4') }}--}}
                </div>
            </div>
        </div>
    </div>
@endsection
