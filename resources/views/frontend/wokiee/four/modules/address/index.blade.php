@extends('frontend.wokiee.four.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('frontend.address.index') }}
@endsection

@section('body')
    <div id="tt-pageContent">
        <div class="container-indent">
            <div class="container container-fluid-custom-mobile-padding">
                <h1 class="tt-title-subpages noborder">{{ trans('general.addresses') }}</h1>
                <div class="tt-shopping-layout mb-4">
                    <div class="tt-wrapper">
                        <div class="row">
                            <a href="{{ route('frontend.address.create') }}" class="btn pull-left">{{ trans('general.new_address') }}</a>
                        </div>
                        <a href="{{ route('frontend.order.index') }}" class="tt-link-back pull-left">
                            <i class="icon-h-46"></i> {{ trans('general.return_back') }}
                        </a>
                    </div>
                    <br>
                    <h2 class="tt-title-border">{{ trans('general.my_addresses') }}</h2>
                    @foreach($elements as $element)
                        <div class="tt-wrapper mb-3">
                            <h3 class="tt-title">{{ $element->name }}
                                <a href="{{ route('frontend.address.edit', $element->id) }}"
                                   class="btn btn-border pull-left">{{ trans('general.edit') }}</a>
                            </h3>
                            <div class="tt-table-responsive">
                                <table class="tt-table-shop-02">
                                    <tbody>
                                    <tr>
                                        <td>{{ trans('general.name') }}:</td>
                                        <td>{{ $element->name }} </td>
                                    </tr>
                                    @if($element->governate_id)
                                        <tr>
                                            <td>{{ trans('general.governate') }}:</td>
                                            <td>{{ $element->governate->name }}</td>
                                        </tr>
                                    @endif
                                    @if($element->area_id)
                                        <tr>
                                            <td>{{ trans("general.area") }}:</td>
                                            <td>{{ $element->area->name }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>{{ trans("general.block") }}:</td>
                                        <td>{{ $element->block }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tt-shop-btn pull-left">
                                <a class="btn-link" href="#" style="background-color: transparent !important; color: black !important;">
                                  <i class="fa fa-fw fa-edit"></i>
                                    EDIT
                                </a>
                                <a class="btn-link" href="#" style="background-color: transparent !important; color: black !important;">
                                    <i class="fa fa-fw fa-remove"></i>DELETE</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
