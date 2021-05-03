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
                    @can('isAdminOrAbove')
                        <div class="portlet box green col-lg-6 col-lg-push-3">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>{{ trans('general.general_search') }}</div>
                            </div>
                            <div class="portlet-body form">
                                <form action="{{ route('backend.admin.user.search') }}" class="form-horizontal">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">{{ trans("general.search") }}</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-search-plus"></i>
                                                                    </span>
                                                    <input type="text" name="search" class="form-control"
                                                           value="{{ request()->search }}"
                                                           placeholder="{{ trans('general.search') }}">
                                                </div>
                                                <span class="help-block"> {{ trans('message.general_search') }} - (ID/Name/Description)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit"
                                                        class="btn  green">{{ trans('general.search') }}</button>
                                                <a href="{{ route('backend.admin.user.index') }}"
                                                   class="btn  red">{{ trans('general.remove') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endcan
                    <table id="dataTableAll" class="table table-striped table-bordered table-hover" cellspacing="0">
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
                            <th class="none">{{ trans('general.start_subscription') }}</th>
                            <th class="none">{{ trans('general.end_subscription') }}</th>
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
                            <th class="none">{{ trans('general.start_subscription') }}</th>
                            <th class="none">{{ trans('general.end_subscription') }}</th>
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
                                <td>{{ $element->phone ? $element->phone : trans('general.n_a')}}</td>
                                <td>{{ $element->address }}</td>
                                {{--                                <td>{{ $element->area }}</td>--}}
                                <td>{{ $element->country ? $element->country->slug : trans('general.n_a')}}</td>
                                <td>
                                    @if($element->role)
                                        <button
                                            class="btn red {{ activeLabel(!$element->active) }}">{{ activeText($element->active, $element->role->slug) }}</button>
                                    @endif
                                </td>
                                <td>
                                    <button
                                        class="btn {{ activeBtn($element->active) }}">{{ activeText($element->active) }}</button>
                                </td>
                                <td>
                                    <button
                                        class="btn {{ activeBtn($element->access_dashboard) }}">{{ activeText($element->access_dashboard) }}</button>
                                </td>
                                <td>
                                    @if($element->categories->isNotEmpty())
                                        <div class="col-lg-12" style="margin : 30px">
                                            @foreach($element->categories->take(6) as $c)
                                                <div class="col-lg-2">
                                                    <label
                                                        class="label label-info"><strong>{{ $c->name }}</strong></label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <button class="btn-sm btn-danger">{{ trans('general.n_a') }}</button>
                                    @endif
                                </td>
                                <td><label class="label label-info">
                                        <strong>{{ !is_null($element->start_subscription) ? $element->start_subscription->format('d/m/Y')  : trans('general.n_a')}}</strong>
                                    </label>
                                </td>
                                <td><label class="label label-info">
                                        <strong>{{ !is_null($element->end_subscription) ? $element->end_subscription->format('d/m/Y')  : trans('general.n_a')}}</strong>
                                    </label>
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
                                                        <i class="fa fa-fw fa-edit"></i> {{ trans('general.reset_password') }}
                                                    </a>
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
                                                    @if(env('ENABLE_MULTI_ADDRESS'))
                                                        @if($element->addresses->isNotEmpty())
                                                            <li>
                                                                <a href="{{ route('backend.admin.address.index',['user_id' => $element->id]) }}">
                                                                    <i class="fa fa-fw fa-address-book"></i> {{ trans('general.list_of_addresss') }}
                                                                </a>
                                                            </li>
                                                        @endif
                                                        <li>
                                                            <a href="{{ route('backend.admin.address.create',['user_id' => $element->id]) }}">
                                                                <i class="fa fa-fw fa-edit"></i> {{ trans('general.new_address') }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if(env('DESIGNERAAT') && !$element->isClient)
                                                        <li>
                                                            <a href="{{ route('backend.user.show',$element->id) }}">
                                                                <i class="fa fa-fw fa-user-circle"></i> {{ trans('general.profile') }}
                                                            </a>
                                                        </li>
                                                    @endif
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
                                                @endcan
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
                    {{ $elements->appends($_GET)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
