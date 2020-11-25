<div class="container">
    <div class="tt-login-form">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="tt-item">
                    <h2 class="tt-title text-center border-bottom">{{ trans('general.personal_information_confirmation') }}</h2>
                    <div class="form-default">
                        @if($settings->payment_method === 'tap')
                            <form method="post"
                                  action="{{route('tap.web.payment.create') }}"
                            >
                        @elseif($settings->payment_method === 'myfatoorah')
                            <form method="post"
                                  action="{{route('myfatoorah.web.payment.create') }}"
                            >
                        @elseif($settings->payment_method === 'upayment')
                            <form method="post"
                              action="{{route('upayment.web.payment.create') }}"
                            >
                        @endif
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <input type="hidden" name="payment_method" value="">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="loginInputName">{{ trans('general.name') }}
                                                *</label>
                                            <input type="text" name="name" class="form-control disabled"
                                                   value="{{auth()->user()->name }}"
                                                   required disabled
                                                   placeholder="{{ trans('general.name') }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="loginInputEmail">{{ trans('general.email') }}
                                                *</label>
                                            <input type="text" name="email" class="form-control"
                                                   value="{{auth()->user()->email }}"
                                                   required disabled
                                                   placeholder="{{ trans('general.email') }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="loginLastName">{{ trans('general.mobile') }}
                                                *</label>
                                            <input type="text" name="mobile" class="form-control"
                                                   value="{{ auth()->user()->mobile }}"
                                                   required disabled
                                                   placeholder="{{ trans('general.mobile') }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="loginInputPassword">{{ trans('general.full_address') }}
                                                *</label>
                                            <input type="text" name="address" class="form-control"
                                                   value="{{auth()->user()->address }}"
                                                   required disabled
                                                   placeholder="{{ trans('general.address') }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="address_country">{{ trans('general.country') }}
                                                <sup>*</sup></label>
                                            <select name="country_id" class="form-control" required
                                                    disabled>
                                                @auth
                                                    <option selected
                                                            value="{{ auth()->user()->country->id }}">{{ auth()->user()->country->slug }}</option>
                                                @else
                                                    <option value="{{ getClientCountry()->id }}"
                                                            selected>{{ getClientCountry()->slug }}</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="notes">{{ trans('general.notes') }}</label>
                                            <textarea disabled name="notes" class="form-control"
                                                      style="height: 150px;"
                                                      rows="1"
                                                      placeholder="{{ trans('general.notes') }}">{{ request('notes') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tt-shopcart-box tt-boredr-large">
                                    <table class="tt-shopcart-table01">
                                        <tbody>
                                        <tr>
                                            <div class="alert alert-warning">
                                                <i class="fa fa-fw fa-info-circle fa-lg"></i>
                                                {{ trans('message.payment_will_be_in_kuwaiti_dinar_only') }}
                                            </div>
                                        </tr>
                                        @if(Cart::instance('shopping')->content()->where('options.type', 'country')->first())
                                            <tr>
                                                <th>{{ trans('general.shipment_fees') }} {{ $currency->name }}</th>
                                                <td>{{ getConvertedPrice(Cart::instance('shopping')->content()->where('options.type', 'country')->first()->total) }} {{ $currency->symbol }}</td>
                                            </tr>
                                        @endif
                                        @if(session()->get('coupon'))
                                            <tr>
                                                <th>{{ trans('general.discount') }} {{ $currency->name }}</th>
                                                <td>{{ getConvertedPrice(session()->get('coupon')->value) }} {{ $currency->symbol }}</td>
                                            </tr>
                                        @endif
                                        @if(!$currency->country->is_local)
                                            <tr>
                                                <th>{{ trans('general.total_price') }} {{ $currency->name }}</th>
                                                <td>{{ getConvertedPrice(Cart::instance('shopping')->total()) }} {{ $currency->symbol }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>{{ trans('general.total_price_in_kuwaiti_dinar') }}</th>
                                            <td>{{ getCartNetTotal() }} {{ trans('general.kd') }}</td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    @if(!$order->cash_on_delivery)
                                        <button type="submit" class="btn btn-lg">
                                            <span class="icon icon-check_circle"></span>
                                            {{ trans('general.payment_confirm_go_to_payment') }}
                                        </button>
                                    @else
                                        <a href="{{ route('frontend.order.cash.delivery', $order->id) }}"
                                           class="btn btn-lg">
                                            <span class="icon icon-check_circle"></span>
                                            {{ trans('general.order_cash_on_delivery_complete') }}
                                        </a>
                                    @endif
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
