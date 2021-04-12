@extends('frontend.wokiee.four.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('frontend.order.index') }}
@endsection

@section('body')
    <div class="container-indent">
        <div class="container container-fluid-custom-mobile-padding">
            <div class="row justify-content-center">
                <div class="col-xs-12 col-md-12 col-lg-12 col-md-auto">
                    <div class="tt-post-single">
                        <div class="tt-tag"><a href="#">{{ trans('general.history_orders') }}</a></div>
                        <div class="tt-post-content">
                            <table id="dataTable" class="tt-table-shop-01" cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>products/size/qty</th>
                                    <th>net price</th>
                                    <th>discount</th>
                                    <th>price</th>
                                    <th>reference_id</th>
                                    <th>payment status</th>
                                    <th>address</th>
                                    <th>mobile</th>
                                    <th>created_at</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>products/size/qty</th>
                                    <th>net price</th>
                                    <th>discount</th>
                                    <th>price</th>
                                    <th>reference_id</th>
                                    <th>payment status</th>
                                    <th>address</th>
                                    <th>mobile</th>
                                    <th>created_at</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($elements as $element)
                                    <tr>
                                        <td>{{ $element->id }}</td>
                                        <td>
                                            @if(!$element->order_metas->isEmpty())
                                                @foreach($element->order_metas as $meta)
                                                    <li>
                                                        @if($meta->product)
                                                                {{ $meta->product->name}}
                                                                - {{ $meta->product_size }}
                                                                - {{ $meta->product_color }}
                                                                - {{ $meta->qty }}
                                                        @else
                                                            <span class="label label-warning">Product No longer exists</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{ $element->net_price}}</td>
                                        <td>{{ $element->discount}}</td>
                                        <td>{{ $element->price}}</td>
                                        <td>{{ $element->reference_id}}</td>
                                        <td>
                                            <a href="{{ route('frontend.invoice.show', $element->id) }}" target="_blank" class="btn btn-{{ $element->status === 'success' ? 'success' : 'info' }}">{{ $element->status }}</a>
                                        </td>
                                        <td>{{ $element->address }}</td>
                                        <td>
                                            <a href="{{ route('frontend.invoice.show', $element->id) }}" target="_blank"  class="btn btn-info">{{ $element->mobile }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('frontend.invoice.show', $element->id) }}" target="_blank"  class="btn btn-info">{{ $element->created_at->diffForHumans()}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
