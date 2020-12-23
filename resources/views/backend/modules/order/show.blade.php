@extends('backend.layouts.app')




@section('content')
    <div class="container" style="border: 2px solid lightgrey; padding: 15px; background-color: white;">
        <div class="col-lg-12">
            <button onClick="window.print()" class="btn btn-warning">Print</button>
        </div>
        <div class="col-lg-12">
            <img class="img-sm img-responsive center-block" src="{{ asset(env('THUMBNAIL').$settings->logo) }}"
                 alt="{{ $settings->company }}">
        </div>
        <hr>
        <div class="card">
            <div class="card-header">
                <h3>{{ trans('general.invoice_no') }} : {{ $element->id }}</h3>
                <strong>{{ trans("general.date") }} : {{ $element->created_at->format('F j, Y') }}</strong>
                <span class="float-right"> <br><strong>{{ trans('general.status') }}:</strong> {{ strtoupper($element->status) }}</span>
                @if($element->cash_on_delivery)
                    <span class="float-right"> <br><strong>{{ trans('general.payment_method') }}:</strong> {{ strtoupper(trans('general.cash_on_delivery')) }}</span>
                @endif
                @if($element->payment_method)
                    <span class="float-right"> <br><strong>{{ trans('general.payment') }}:</strong> {{ strtoupper($element->payment_method) }}</span>
                @endif
                @if($element->shipment_reference)
                    <span class="float-right"> <br><strong>{{ trans('general.shipment_reference') }}:</strong> {{ strtoupper($element->shipment_reference) }}</span>
                @endif

                <span class="float-right"> <br><strong>{{ trans('general.weight') }} :</strong>{{ $element->order_metas->pluck('product.weight')->sum() }} KG</span>
                @if($element->shipment_fees > 0)
                    <span class="float-right"> <br><strong>{{ trans('general.shipment') }} :</strong>{{ $element->shipment_fees }} {{ trans('general.kd') }}</span>
                @endif
                <span class="float-right"> <br><strong>{{ trans('general.price') }}:</strong>{{ $element->price }} {{ trans('general.kd') }}</span>
                @if($element->discount > 0)
                    <span class="float-right"> <br><strong>{{ trans('general.discount') }}:</strong>{{ $element->discount }} {{ trans('general.kd') }}</span>
                @endif
                <span class="float-right"> <br><strong>{{ trans('general.net_price') }} :</strong>{{ $element->net_price }} {{ trans('general.kd') }}</span>
            </div>
            <hr>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h6 class="mb-3">{{ trans('general.from') }}:</h6>
                        <div>
                            <strong>{{ env('APP_NAME') }}</strong>
                        </div>
                        <div>{{ trans('general.address') }}: {{ $settings->address }}</div>
                        <div>{{ trans('general.email') }}: {{ $settings->email }}</div>
                        <div>{{ trans('general.phone') }}: {{ $settings->phone }}</div>
                        <div>{{ trans('general.country') }}: {{ $settings->country }}</div>
                    </div>

                    <div class="col-sm-6">
                        <h6 class="mb-3">{{ trans('general.to') }}:</h6>
                        <div>
                            <strong>{{ trans('general.name') }}: {{ $element->user->name }}</strong>
                        </div>
                        <div>{{ trans('general.address') }}: {{ $element->address }}</div>
                        <div>{{ trans('general.area') }}: {{ $element->area ? $element->area : $element->user->area }}
                            <br/></div>
                        <div>{{ trans('general.country') }}: {{ $element->country }}<br/></div>
                        <div>{{ trans('general.email') }}: {{ $element->user->email }}</div>
                        <div>{{ trans('general.phone') }}: {{ $element->mobile }}</div>
                        <div>{{ trans('general.calling_code') }}: {{ $element->user->country->calling_code }}</div>
                    </div>

                </div>
                <hr>

                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="center">Id#</th>
                            <th>{{ trans('general.sku') }}</th>
                            <th>{{ trans('general.image') }}</th>
                            <th>{{ trans('general.color') }}/ {{ trans('general.date') }}</th>
                            <th>{{ trans('general.size') }} / {{ trans('general.timing') }}</th>
                            <th>{{ trans('general.name') }}</th>
                            <th>{{ trans('general.company') }}</th>

                            <th class="right">{{ trans('general.net_price') }}</th>
                            <th class="center">{{ trans('general.qty') }}</th>
                            <th class="center">{{ trans('general.weight') }}
                                / {{ trans('general.service_destination') }}</th>
                            <th class="right">{{ trans('general.total_price') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($element->order_metas as $item)
                            @if($item->isProductType && $item->product_id)
                                @if($item->product_attribute_id && $item->product->has_attributes)
                                    <tr>
                                        <td class="center">{{ $item->product_id }}</td>
                                        <td class="center">{{ $item->product->sku }}</td>
                                        <td class="center"><img class="img-xs"
                                                                src="{{ $item->product->getCurrentImageAttribute() }}"
                                                                alt=""></td>
                                        <td class="left strong">{{ $item->color_name ?? trans('general.not_available') }}</td>
                                        <td class="left strong">{{ $item->size_name ?? trans('general.not_available') }}</td>
                                        <td class="left"><a
                                                    href="{{ !env('ABATI') ? route('frontend.product.show',$item->product_id) : '#'}}">{{ $item->product->name }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('frontend.user.show', $item->product->user_id) }}">{{ $item->product->user->slug }}</a>
                                        </td>
                                        <td class="right">{{ $item->price }} {{ trans('general.kd') }}</td>
                                        <td class="right">{{ $item->qty }}</td>
                                        <td class="right">{{ $item->product->weight }} KG</td>
                                        <td class="right">{{ number_format($item->price * $item->qty,'2','.',',') }}
                                            {{ trans('general.kd') }}
                                        </td>
                                    </tr>
                                    @if($item->notes)
                                        <tr>
                                            <td colspan="12">
                                                <div class="col-12">
                                                    <div class="alert alert-dark alert-info">
                                                        @if($item->isProductType)
                                                            <p>
                                                                {{ trans('general.notes') }}
                                                                : {{ $item->product->name }} / {{ $item->notes }}
                                                            </p>
                                                        @else
                                                            <p>
                                                                {{ trans('general.notes') }} : {{ $item->notes }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @else
                                    <tr>
                                        <td class="center">{{ $item->product_id }}</td>
                                        <td class="center">{{ $item->product->sku }}</td>
                                        <td class="center"><img class="img-xs"
                                                                src="{{ $item->product->imageThumbLink }}"
                                                                alt=""></td>
                                        <td class="left strong">{{ $item->product_color ?? 'N/A'}}</td>
                                        <td class="left strong">{{ $item->product_size ?? 'N/A' }}</td>
                                        <td class="left"><a
                                                    href="{{ !env('ABATI') ? route('frontend.product.show',$item->product_id) : '#'}}">{{ $item->product->name }}</a>
                                        </td>
                                        <td class="right">{{ $item->price }} {{ trans('general.kd') }}</td>
                                        <td class="right">{{ $item->qty }}</td>
                                        <td class="right">{{ $item->product->weight }} KG</td>
                                        <td class="right">{{ number_format($item->price * $item->qty,'2','.',',') }}
                                            {{ trans('general.kd') }}
                                        </td>
                                    </tr>
                                @endif
                            @elseif($item->isServiceType && $item->service_id)
                                <tr>
                                    <td class="center">{{ $item->service_id }}</td>
                                    <td class="center">{{ $item->service->sku }}</td>
                                    <td class="center"><img class="img-xs"
                                                            src="{{ $item->service->imageThumbLink }}"
                                                            alt=""></td>
                                    <td class="left strong">{{ $item->service_date }}</td>
                                    <td class="left strong">{{ $item->service_time }}</td>
                                    <td class="left"><a
                                                href="{{ !env('ABATI') ? route('frontend.service.show',$item->service_id)  : '#'}}">{{ $item->service->name }}</a>
                                    </td>
                                    <td class="right">{{ $item->price }} {{ trans('general.kd') }}</td>
                                    <td class="right">{{ $item->notes}}</td>
                                    <td class="right">{{ $element->address }} - {{ $element->country }}</td>
                                    <td class="right">{{ number_format($item->price * $item->qty,'2','.',',') }}
                                        {{ trans('general.kd') }}
                                    </td>
                                </tr>
                            @elseif($element->isQuestionnaireType)
                            @else
                                <tr>
                                    <div class="alert alert-danger">Product/Service is deleted.</div>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">

                    </div>

                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                            <tr>
                                <td class="left">
                                    <strong>{{ trans('general.total') }}</strong>
                                </td>
                                <td class="right">{{ $element->price }} {{ trans('general.kd') }}</td>
                            </tr>
                            @if($element->discount > 0)
                                <tr>
                                    <td class="left">
                                        <strong>{{ trans('general.discount') }}</strong>
                                    </td>
                                    <td class="right">{{ $element->discount }} {{ trans('general.kd') }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td class="left">
                                    <strong>{{ trans('general.shipment') }}</strong>
                                </td>
                                <td class="right">{{ $element->shipment_fees }} {{ trans('general.kd') }}</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>{{ trans('general.net_price') }}</strong>
                                </td>
                                <td class="right">
                                    <strong>{{ $element->net_price }} {{ trans('general.kd') }}</strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
