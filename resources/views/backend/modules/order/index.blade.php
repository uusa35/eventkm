@extends('backend.layouts.app')
@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.admin.order.index') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                @include('backend.partials.forms.form_title',['title' => trans('general.index_order')])
                <div class="portlet-body">
                    <div class="row">
                        @can('isAdminOrAbove')
                            @if(isset($companies))
                                <div class="col-lg-12">
                                    <div class="tiles padding-tb-20">
                                        @foreach($companies as $company)
                                            <a href="{{ route('backend.admin.order.index', ['company_id' => $company->id]) }}">
                                                <div class="tile bg-blue-chambray tooltips"
                                                     data-container="body" data-placement="bottom"
                                                     data-original-title="{{ $company->slug }}"
                                                >
                                                    <div class="tile-body">
                                                        <img src="{{ $company->getCurrentImageAttribute() }}" alt=""
                                                             class="text-center"
                                                             style="width : 110px; height: 110px; text-align: center;">
                                                    </div>
                                                    <div class="tile-object text-center">
                                                        {{ str_limit($company->slug,'10') }}
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endcan
                        <div class="col-lg-12">
                            @include('backend.partials._admin_instructions',['title' => trans('general.orders') ,'message' => trans('message.index_order')])
                        </div>
                        <div class="col-lg-8 hidden">
                            <form action="">
                                <div class="col-lg-3">
                                    <div class="form-group{{ $errors->has('from') ? ' has-error' : '' }}">
                                        <label for="start_sale"
                                               class="control-label">{{ trans('general.from') }}</label>
                                        <div class="input-group date date-picker">
                                            <input type="text" readonly
                                                   {{--                                               style="direction: rtl !important;"--}}
                                                   class="form-control tooltips" data-container="body"
                                                   data-placement="bottom right"
                                                   data-original-title="{{ trans('message.from') }}"
                                                   name="from"
                                                   value="{{ old('from', \Carbon\Carbon::now()->format('m/d/Y')) }}"
                                            >
                                            <span class="input-group-btn"><button
                                                        class="btn default date-set" type="button"><i
                                                            class="fa fa-calendar"></i></button></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group{{ $errors->has('to') ? ' has-error' : '' }}">
                                        <label for="start_sale"
                                               class="control-label">{{ trans('general.to') }}</label>
                                        <div class="input-group date date-picker">
                                            <input type="text" readonly
                                                   {{--                                               style="direction: rtl !important;"--}}
                                                   class="form-control tooltips" data-container="body"
                                                   data-placement="bottom right"
                                                   data-original-title="{{ trans('message.to') }}"
                                                   name="to"
                                                   value="{{ old('to', \Carbon\Carbon::now()->format('m/d/Y')) }}"
                                            >
                                            <span class="input-group-btn"><button
                                                        class="btn default date-set" type="button"><i
                                                            class="fa fa-calendar"></i></button></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button
                                            type="submit"
                                            class="btn default date-set" type="button"><i
                                                class="fa fa-send"></i> {{ trans('general.apply') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table id="dataTable" class="table table-striped table-bordered table-hover" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th class="all">{{ trans('general.order_id') }}</th>
                            <th class="none">{{ trans('general.order_id') }}</th>
                            <th class="none">{{ trans('general.product_size_quantity') }}</th>
                            <th>{{ trans('general.shipment_fees') }}</th>
                            <th>{{ trans('general.total') }}</th>
                            <th class="none">{{ trans('general.discount') }}</th>
                            <th class="none">{{ trans('general.payment_method') }}</th>
                            <th class="none">{{ trans('general.shipment_reference') }}</th>
                            <th class="none">{{ trans('general.reference_id') }}</th>
                            <th>{{ trans('general.payment_status') }}</th>
                            <th>{{ trans('general.address') }}</th>
                            <th>{{ trans('general.mobile') }}</th>
                            <th class="none">{{ trans('general.country') }}</th>
                            <th class="none">{{ trans('general.email') }}</th>
                            {{--                            <th class="none">{{ trans('general.day') }}</th>--}}
                            {{--                            <th class="none">{{ trans('general.timing') }}</th>--}}
                            {{--                            <th class="none">{{ trans('general.booked_at') }}</th>--}}
                            <th>{{ trans('general.created_at') }}</th>
                            <th>{{ trans('general.actions') }}</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th class="all">{{ trans('general.id') }}</th>
                            <th class="none">{{ trans('general.order_id') }}</th>
                            <th class="none">{{ trans('general.product_size_quantity') }}</th>
                            <th>{{ trans('general.shipment_fees') }}</th>
                            <th>{{ trans('general.total') }}</th>
                            <th class="none">{{ trans('general.discount') }}</th>
                            <th class="none">{{ trans('general.payment_method') }}</th>
                            <th class="none">{{ trans('general.shipment_reference') }}</th>
                            <th class="none">{{ trans('general.reference_id') }}</th>
                            <th>{{ trans('general.payment_status') }}</th>
                            <th>{{ trans('general.address') }}</th>
                            <th>{{ trans('general.mobile') }}</th>
                            <th class="none">{{ trans('general.country') }}</th>
                            <th class="none">{{ trans('general.email') }}</th>
                            {{--                            <th class="none">{{ trans('general.day') }}</th>--}}
                            {{--                            <th class="none">{{ trans('general.timing') }}</th>--}}
                            {{--                            <th class="none">{{ trans('general.booked_at') }}</th>--}}
                            <th>{{ trans('general.created_at') }}</th>
                            <th>{{ trans('general.actions') }}</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($elements as $element)
                            <tr>
                                <td>{{ $element->id }}</td>
                                <td>#{{ $element->id }}</td>
                                <td>
                                    @if($element->order_metas->isNotEmpty())
                                        <div class="btn-group-vertical btn-group-solid">
                                            <table class="table table-striped">
                                                <th>{{ trans('general.name') }}</th>
                                                <th>{{ trans('general.color') }}</th>
                                                <th>{{ trans('general.size') }}</th>
                                                <th>{{ trans('general.quantity') }}</th>
                                                <th>{{ trans('general.company') }}</th>
                                                @foreach($element->order_metas as $meta)
                                                    <tr>
                                                        @if($meta->product && $meta->product_id)
                                                            @if(!is_null($meta->product->product_attributes) && $meta->product->has_attributes)
                                                                <td>
                                                                    <a href="{{ route('frontend.product.show', $meta->product->id) }}">{{ $meta->product->name }}</a>
                                                                </td>

                                                                <td>{{ $meta->product_color ?? 'N/A'}}</td>
                                                                <td>{{ $meta->product_size ?? 'N/A'}}</td>
                                                                <td>{{ $meta->qty }}</td>
                                                                <td>{{ $meta->product->user->name ?? 'N/A'}}</td>
                                                            @else
                                                                <td>
                                                                    <a href="{{ route('frontend.product.show', $meta->product->id) }}">{{ $meta->product->name }}</a>
                                                                </td>
                                                                <td>{{ $meta->product_color ?? 'N/A'}}</td>
                                                                <td>{{ $meta->product_size ?? 'N/A'}}</td>
                                                                <td>{{ $meta->qty }}</td>
                                                                <td>{{ $meta->product->user->name ?? 'N/A'}}</td>
                                                            @endif
                                                        @elseif($meta->service && $meta->service_id)
                                                            <button type="button"
                                                                    class="btn yellow">
                                                                {{ $meta->service->name }} <br> {{ $meta->timing->day }}
                                                                <br> {{ $meta->timing->start }}
                                                                <br> {{ $meta->timing->end }}
                                                            </button>
                                                        @else
                                                            <button type="button"
                                                                    class="btn blue-steel">
                                                                No Preview Product / Service Maybe Deleted
                                                            </button>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $element->shipment_fees}} {{ trans('general.kd') }}</td>
                                <td>{{ $element->net_price}} {{ trans('general.kd') }}</td>
                                <td>
                                    <span class="label label-{{ $element->discount ?  'warning' : 'danger' }}">{{ $element->discount ? $element->discount .' '. trans('general.kd') : 'N/A'}}</span>
                                </td>
                                <td>
                                    <span class="label label-{{ $element->cash_on_delivery ?  'green' : 'warning' }}">{{ $element->cash_on_delivery ? trans('general.cash_on_delivery') : $element->payment_method }}</span>
                                </td>
                                <td>
                                    <div class="btn-group-vertical btn-group-solid">
                                        <button type="button"
                                                class="btn blue">{{ trans('general.shipment_reference') }}
                                            : {{ $element->shipment_reference ?? 'N/A' }}</button>
                                        <button type="button"
                                                class="btn grey">{{ trans('general.shipment') }}
                                            : {{  $element->shipment_fees ?? '0' }} {{ trans('general.kd') }}</button>
                                    </div>
                                </td>
                                <td>{{ $element->reference_id}}</td>
                                <td>
                                    <div class="btn-group-vertical btn-group-solid">
                                        <button type="button"
                                                class="btn {{ $element->status === 'pending' ? 'red' : 'yellow' }}">{{ $element->status }}</button>
                                        <button type="button"
                                                class="btn {{ $element->paid ? 'green' : 'red' }}">{{ trans('general.is_paid') }}
                                            : {{ $element->paid ? 'Paid' : 'Not Paid'}}</button>
                                        @if($element->cash_on_delivery)
                                            <button type="button" class="btn yellow">cash_on_delivery</button>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $element->address }} / {{ $element->area ?? '' }}</td>
                                <td><span class="btn btn-info">{{ $element->mobile }}</span></td>
                                <td>{{ $element->country }}</td>
                                <td>{{ $element->email }}</td>
                                {{--                                <td>{{ $element->day }}</td>--}}
                                {{--                                <td>{{ $element->time }}</td>--}}
                                {{--                                <td>{{ $element->booked_at }}</td>--}}
                                <td><span class="btn btn-primary">{{ $element->created_at->format('d/m/Y')}}</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn green btn-xs btn-outline dropdown-toggle"
                                                data-toggle="dropdown"> {{ trans('general.actions') }}
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            @can('isAdminOrAbove')
                                                <li>
                                                    <a href="{{ route('backend.admin.order.show',$element->id) }}">
                                                        <i class="fa fa-fw fa-edit"></i> {{ trans('general.view_order') }}
                                                    </a>
                                                </li>
                                                @if($element->paid || $element->cash_on_delivery)
                                                    <li>
                                                        <a href="{{ route('frontend.invoice.show',['id' => $element->id]) }}">
                                                            <i class="fa fa-fw fa-paper-plane"></i> {{ trans('general.see_invoice') }}
                                                        </a>
                                                    </li>
                                                    {{--                                                    <li>--}}
                                                    {{--                                                        <a href="{{ route('frontend.invoice.pdf',['id' => $element->id]) }}">--}}
                                                    {{--                                                            <i class="fa fa-fw fa-paper-plane"></i> {{ trans('general.see_invoice_in_pdf') }}--}}
                                                    {{--                                                        </a>--}}
                                                    {{--                                                    </li>--}}
                                                    <li>
                                                        <a href="{{ route('backend.admin.order.status',['id' => $element->id,'status' => 'received']) }}">
                                                            <i class="fa fa-fw fa-hand-paper-o"></i> {{ trans('general.order_received') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('backend.admin.order.status',['id' => $element->id,'status' => 'under_process']) }}">
                                                            <i class="fa fa-fw fa-hand-paper-o"></i> {{ trans('general.order_under_process') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('backend.admin.order.status',['id' => $element->id,'status' => 'shipped']) }}">
                                                            <i class="fa fa-fw fa-hand-paper-o"></i> {{ trans('general.order_shipped') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('backend.admin.order.edit',$element->id) }}">
                                                            <i class="fa fa-fw fa-hand-paper-o"></i> {{ trans('general.add_shipment_reference') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('backend.admin.order.status',['id' => $element->id,'status' => 'delivered']) }}">
                                                            <i class="fa fa-fw fa-hand-paper-o"></i> {{ trans('general.order_delivered') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('backend.admin.order.status',['id' => $element->id,'status' => 'completed']) }}">
                                                            <i class="fa fa-fw fa-hand-paper-o"></i> {{ trans('general.order_completed') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('backend.admin.order.status',['id' => $element->id,'status' => 'cancelled']) }}">
                                                            <i class="fa fa-fw fa-hand-paper-o"></i> {{ trans('general.cancelled') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @else
                                                <li>
                                                    <a href="{{ route('backend.order.show',$element->id) }}">
                                                        <i class="fa fa-fw fa-edit"></i> {{ trans('general.view_order') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('frontend.invoice.show',['id' => $element->id]) }}">
                                                        <i class="fa fa-fw fa-paper-plane"></i> {{ trans('general.see_invoice') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('frontend.invoice.pdf',['id' => $element->id]) }}">
                                                        <i class="fa fa-fw fa-paper-plane"></i> {{ trans('general.see_invoice_in_pdf') }}
                                                    </a>
                                                </li>
                                            @endif
                                            <li>
                                                <a data-toggle="modal" href="#" data-target="#basic" data-title="Delete"
                                                   data-content="Are you sure you want to delete order ? "
                                                   data-form_id="delete-{{ $element->id }}">
                                                    <i class="fa fa-fw fa-recycle"></i> {{ trans('general.delete') }}
                                                </a>
                                                <form method="post" id="delete-{{ $element->id }}"
                                                      action="{{ route('backend.admin.order.destroy',$element->id) }}">
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
                    {{ $elements->render() }}
                </div>
            </div>
        </div>
    </div>
@endsection
