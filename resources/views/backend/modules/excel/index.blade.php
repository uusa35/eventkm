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
                    <a href="{{ route('backend.excel.index') }}">
                        <div class="tile bg-blue-steel bg-font-blue-steel tooltips"
                             data-container="body" data-placement="bottom"
                             data-original-title="{{ trans('message.users') }}"
                        >
                            <div class="tile-body">
                                <i class="fa fa-product-hunt"></i>
                            </div>
                            <div class="tile-object text-center">
                                {{ trans('general.users') }}
                            </div>
                        </div>
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
