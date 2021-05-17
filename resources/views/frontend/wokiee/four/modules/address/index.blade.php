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
                            <div class="col-lg-12">
                                <a href="{{ route('frontend.address.create') }}"
                                   class="btn pull-left">{{ trans('general.new_address') }}</a>
                                <a href="{{ route('frontend.order.index') }}" class="btn {{ pullLeft() }}"
                                   style="color : black !important; background-color: transparent !important;">
                                    <i class="icon-h-46"></i> {{ trans('general.return_back') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h2 class="tt-title-border">{{ trans('general.my_addresses') }}</h2>
                    @foreach($elements as $element)
                        <div class="tt-wrapper mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3 class="tt-title">{{ $element->name }}
                                    </h3>
                                </div>
                                <div class="col-lg-6 {{ pullLeft() }}">
                                    <a href="{{ route('frontend.address.edit', $element->id) }}"
                                       class="btn {{ pullLeft() }}">{{ trans('general.edit') }}</a>
                                    @if($element->name !== 'address_one')
                                        <form action="{{ route('frontend.address.destroy', $element->id) }}"
                                              method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" href="#"
                                                    style="margin-left: 10px; margin-right: 10px;"
                                                    class="btn {{ pullLeft() }}"
                                            >{{ trans('general.delete') }}</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
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
                                            <td>{{ $element->areaName->slug }}</td>
                                        </tr>
                                    @endif
                                    @if($element->block)
                                        <tr>
                                            <td>{{ trans("general.block") }}:</td>
                                            <td>{{ $element->block }}</td>
                                        </tr>
                                    @endif
                                    @if($element->building)
                                        <tr>
                                            <td>{{ trans("general.building") }}:</td>
                                            <td>{{ $element->building }}</td>
                                        </tr>
                                    @endif
                                    @if($element->street)
                                        <tr>
                                            <td>{{ trans("general.street") }}:</td>
                                            <td>{{ $element->street }}</td>
                                        </tr>
                                    @endif
                                    @if($element->floor)
                                        <tr>
                                            <td>{{ trans("general.floor") }}:</td>
                                            <td>{{ $element->floor }}</td>
                                        </tr>
                                    @endif
                                    @if($element->apartment)
                                        <tr>
                                            <td>{{ trans("general.apartment") }}:</td>
                                            <td>{{ $element->apartment }}</td>
                                        </tr>
                                    @endif
                                    @if($element->content)
                                        <tr>
                                            <td>{{ trans("general.content") }}:</td>
                                            <td>{{ $element->content }}</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
