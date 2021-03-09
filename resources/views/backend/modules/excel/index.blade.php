@extends('backend.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('backend.excel.index') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                @include('backend.partials.forms.form_title',['title' => trans('general.index_excel')])
                <div class="portlet-body">
                    @include('backend.partials._admin_instructions',['title' => trans('general.excel') ,'message' => trans('message.index_excel')])
                    <div class="tiles padding-tb-20">
                        <a href="{{ route('backend.excel.index', ['type' => 'paid_orders'])}}">
                            <div class="tile bg-red  tooltips"
                                 data-container="body" data-placement="bottom"
                                 data-original-title="{{ trans('message.total_paid_orders') }}"
                            >
                                <div class="tile-body">
                                    <i class="fa fa-file-excel-o"></i>
                                </div>
                                <div class="tile-object text-center">
                                    {{ trans('general.total_paid_orders') }}
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('backend.excel.index', ['type' => 'cash_on_deliver_orders'])}}">
                            <div class="tile bg-red  tooltips"
                                 data-container="body" data-placement="bottom"
                                 data-original-title="{{ trans('message.cash_on_delivery') }}"
                            >
                                <div class="tile-body">
                                    <i class="fa fa-file-excel-o"></i>
                                </div>
                                <div class="tile-object text-center">
                                    {{ trans('general.all') }} {{ trans('general.orders') }} {{ trans('general.cash_on_delivery') }}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
