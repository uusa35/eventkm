<div class="tt-shopcart-box tt-boredr-large">
    <table class="tt-shopcart-table01">
        <tbody>
        @if(!$currency->country->is_local)
            <tr>
                <div class="alert alert-warning">
                    <i class="fa fa-fw fa-info-circle fa-lg"></i>
                    {{ trans('message.payment_will_be_in_kuwaiti_dinar_only') }}
                </div>
            </tr>
            <tr>
                <th>{{ trans('general.total_price') }} ({{ $currency->name }})</th>
                <td>{{ getConvertedPrice(Cart::instance('shopping')->total()) }} {{ $currency->symbol }}</td>
            </tr>
        @endif
        </tbody>
        <tfoot>
        @if(in_array('country',Cart::instance('shopping')->content()->pluck('options.type')->toArray()))
            {{ dd(Cart::instance('shopping')->content()->where('options.type','country')->first()) }}
            <tr>
                <th>{{ trans('general.total_shipment_fees') }}</th>
                <td>{{ Cart::instance('shopping')->content()->where('options.type','country')->first()->price }} {{ session()->get('country')->currency_symbol }}</td>
            </tr>
        @endif
        @if(session()->has('coupon'))
            <tr>
                <th>{{ trans('general.discount') }}</th>
                <td>{{ session()->get('coupon')->value }} {{ getCouponIsPercentage() ? '%' : trans('general.kd') }}</td>
            </tr>
        @endif
        <tr>
            <th>{{ trans('general.total_price_in_kuwaiti_dinar') }}</th>
            <td>{{ getCartNetTotal() }} {{ trans('general.kd') }}</td>
        </tr>
        </tfoot>
    </table>
    <button type="submit" class="btn btn-lg"><span
                class="icon icon-check_circle"></span>{{ trans('general.proceed_to_checkout') }}
    </button>
</div>
