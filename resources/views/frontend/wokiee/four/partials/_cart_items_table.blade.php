<div class="tt-shopcart-table-02">
    @if($elements->isNotEmpty())
        <table class="table-bordered">
            <tbody>
            <tr>
                <td>{{ trans('general.item_cart_name') }}</td>
                <td></td>
                <td>{{ trans('general.company_name') }}</td>
                <td>{{ trans('general.total_price') }}</td>
                <td>{{ trans('general.remove') }}</td>
            </tr>
            @foreach($elements as $element)
                @if(in_array($element->options->type,['product','service']))
                    <tr>
                        <td>
                            <div class="tt-product-img">
                                <a href="{{ route('frontend.'.$element->options->type.'.show.name',['id' => $element->options->element_id,'name' => $element->options->element->name]) }}">
                                    <img src="{{ asset(env('IMG_LOADER')) }}"
                                         data-src="{{ $element->options->element->imageThumbLink }}" alt="">
                                </a>
                            </div>
                        </td>
                        <td>
                            <h2 class="tt-title">
                                <a href="{{ route('frontend.'.$element->options->type.'.show.name',['id' => $element->options->element_id,'name' => $element->options->element->name]) }}">
                                    {{ $element->options->element->name }}
                                </a>
                            </h2>
                            <ul class="tt-list-description">
                                @if($element->options->size)
                                    <li>{{ trans('general.size') }}: {{ $element->options->size->name }}</li>
                                @endif
                                @if($element->options->color)
                                    <li>{{ trans('general.color') }}: {{ $element->options->color->name }}</li>
                                @endif
                                @if($element->options->element->weight)
                                    <li>{{ trans('general.weight') }}
                                        : {{ $element->options->element->weight}} {{ trans('general.kg') }}</li>
                                @endif
                                @if($element->options->country_destination && app()->environment('local'))
                                    <li>{{ getCurrentCountry()->slug }}
{{--                                        --- PackageCharge : {{ $element->options->element->shipment_package->charge }} ------}}
{{--                                        ProductWeight : {{ $element->options->element->weight }}--}}
                                    </li>
                                @endif
                                @if($element->options->day_selected)
                                    <li>{{ trans('general.day_selected') }}
                                        : {{ $element->options->day_selected->format('d/m/Y') }}</li>
                                @endif
                                @if($element->options->timing)
                                    <li>{{ trans('general.start_time') }}
                                        : {{ $element->options->timing->start_time }}</li>
                                @endif
                                <li>
                                    <div class="tt-price">
                                        {{ trans('general.final_price') }}  {{ $element->options->element->convertedFinalPrice }} {{ $currency->symbol }}
                                    </div>
                                    {{--                                    @if($element->options->element->shipment_package)--}}
                                    {{--                                        <div class="tt-price">--}}
                                    {{--                                            {{ trans('general.package_fee_price') }}  {{ getConvertedPrice($element->options->element->packageFeePrice) }} {{ $currency->symbol }}--}}
                                    {{--                                        </div>--}}
                                    {{--                                    @endif--}}
                                </li>
                                @if($element->options->type === 'product')
                                    <li>
                                        <div class="tt-price">
                                            {{ trans('general.qty') }} {{ $element->qty }}
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </td>
                        <td>
                            <div class="detach-quantity-desctope">
                                <a href="{{ route('frontend.user.show.name',['id' => $element->options->element->user_id,'name' => $element->options->company]) }}">
                                    {{ $element->options->company }}
                                </a>
                            </div>
                        </td>
                        <td>
                            <div class="tt-price">
                                {{ getConvertedPrice($element->price) }} {{ $currency->symbol }}
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('frontend.cart.remove',$element->rowId) }}"
                               class="icon-h-02"></a>
                        </td>
                    </tr>
                    @if($element->options->notes)
                        <td colspan="5">
                            <div class="title">{{ trans('general.notes') }}</div>
                            <p>
                                {!! $element->options->notes !!}
                            </p>
                        </td>
                    @endif
                @endif
            @endforeach
            </tbody>
        </table>
    @else
        <div class="row">
            <div class="col-12">
                <div class="alert alert-warning">{{ trans('general.no_items_in_cart') }}</div>
            </div>
        </div>
    @endif
    <div class="tt-shopcart-btn">
        <div class="col-left">
            <a class="btn btn-link" href="{{ route('frontend.home') }}"><i
                        class="icon-e-19"></i>{{ trans('general.continue_shopping') }}</a>
        </div>
        <div class="col-right">
            @if($elements->isNotEmpty())
                <a class="btn btn-link" href="{{ route('frontend.cart.clear') }}">
                    <i class="icon-h-02"></i>
                    {{ trans('general.clear_cart') }}
                </a>
                {{--<a class="btn-link" href="#"><i class="icon-h-48"></i>UPDATE CART</a>--}}
            @endif
        </div>
    </div>
</div>
