@extends('frontend.wokiee.four.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('frontend.order.index') }}
@endsection

@section('body')
    <div id="tt-pageContent">
        <div class="container-indent">
            <div class="container container-fluid-custom-mobile-padding">
                <h1 class="tt-title-subpages noborder">{{ trans('general.account') }}</h1>
                <div class="tt-shopping-layout">
                    <h2 class="tt-title-border">{{ trans('general.my_account') }}</h2>
                    <a href="{{ route('frontend.user.edit', $user->id) }}"
                       class="btn btn-border {{ pullLeft() }}">{{ trans('general.edit') }}</a>
                    <div class="tt-wrapper">
                        <h3 class="tt-title">{{ trans("general.account_details") }}</h3>
                        <div class="tt-table-responsive">
                            <table class="tt-table-shop-02">
                                <tbody>
                                <tr>
                                    <td>{{ trans('general.name') }}:</td>
                                    <td>{{ $user->name }} </td>
                                </tr>
                                @if(!$user->role->is_client)
                                    <tr>
                                        <td>{{ trans('general.slug') }}:</td>
                                        <td>{{ $user->slug }} </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>{{ trans('general.role') }}:</td>
                                    <td>{{ $user->role->slug }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('general.email') }}:</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans("general.country") }}:</td>
                                    <td>{{ $user->country->name }}</td>
                                </tr>
                                @if($user->mobile)
                                    <tr>
                                        <td>{{ trans('general.mobile') }}:</td>
                                        <td>{{ $user->fullMobile }}</td>
                                    </tr>
                                @endif
                                @if($user->whatsapp)
                                    <tr>
                                        <td>{{ trans('general.whatsapp') }}:</td>
                                        <td>{{ $user->fullWhatsapp }}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('frontend.address.index') }}"
                           class="btn btn-border {{ pullLeft() }}">{{ trans('general.view_addresses') }}</a>
                    </div>
                    <div class="tt-wrapper">
                        <h3 class="tt-title">{{ trans('general.order_history') }}</h3>
                        <div class="tt-table-responsive">
                            <table id="dataTable" class="tt-table-shop-01" cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>{{ trans('general.id') }}</th>
                                    <th>{{ trans('general.products') }}</th>
                                    <th>{{ trans("general.net_price") }}</th>
                                    <th>{{ trans('general.discount') }}</th>
                                    <th>{{ trans('general.price') }}</th>
                                    <th><small>{{ trans('general.reference_id') }}</small></th>
                                    <th>{{ trans('general.payment_status') }}</th>
                                    <th>{{ trans('general.address') }}</th>
                                    <th>{{ trans('general.mobile') }}</th>
                                    <th>{{ trans("general.created_at") }}</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>{{ trans('general.id') }}</th>
                                    <th>{{ trans('general.products') }}</th>
                                    <th>{{ trans("general.net_price") }}</th>
                                    <th>{{ trans('general.discount') }}</th>
                                    <th>{{ trans('general.price') }}</th>
                                    <th><small>{{ trans('general.reference_id') }}</small></th>
                                    <th>{{ trans('general.payment_status') }}</th>
                                    <th>{{ trans('general.address') }}</th>
                                    <th>{{ trans('general.mobile') }}</th>
                                    <th>{{ trans("general.created_at") }}</th>
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
                                                        <small>
                                                            @if($meta->product)
                                                                {{ $meta->product->name}}
                                                                - {{ $meta->product_size }}
                                                                - {{ $meta->product_color }}
                                                                - {{ $meta->qty }}
                                                            @else
                                                                <span
                                                                    class="label label-warning">{{ trans('general.product_is_no_logner_exist') }}</span>
                                                            @endif
                                                        </small>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{ $element->net_price}}</td>
                                        <td>{{ $element->discount}}</td>
                                        <td>{{ $element->price}}</td>
                                        <td><small>{{ $element->reference_id}}</small></td>
                                        <td>
                                            <a href="{{ route('frontend.invoice.show', $element->id) }}" target="_blank"
                                               class="label label-{{ $element->status === 'success' ? 'success' : 'info' }}">{{ $element->status }}</a>
                                        </td>
                                        <td><small>{{ $element->address }}</small></td>
                                        <td>
                                            <small>
                                                <a href="{{ route('frontend.invoice.show', $element->id) }}"
                                                   target="_blank"
                                                   class="label label-border">{{ $element->mobile }}</a>
                                            </small>
                                        </td>
                                        <td>
                                            <small>
                                                <a href="{{ route('frontend.invoice.show', $element->id) }}"
                                                   target="_blank"
                                                   class="label label-border">{{ $element->created_at->diffForHumans()}}</a>
                                            </small>
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
