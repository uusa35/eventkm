<div class="tt-add-info">
    <div class="tt-table-responsive">
        <table class="tt-table-shop-01">
            @if($element->sku)
                <tr>
                    <td class="td-fixed-element"><i class="icon-f-02 fa fa-fw fa-lg"></i><span
                                class="ml-1"></span><span>{{ trans('general.sku') }} : </span>
                    </td>
                    <td>
                        {{ $element->sku }}
                    </td>
                </tr>
            @endif
            @if($element->user && !is_null($element->user) && env('SHOW_COMPANY'))
                <tr>
                    <td class="td-fixed-element">
                        <i class="fa fa-fw icon-e-39 fa-lg"></i>
                        <span>{{ trans('general.company_name') }}:</span>
                    </td>
                    <td>
                        <a class="theme-color"
                           href="{{ route('frontend.user.show.name',['id' => $element->user_id,'name' => $element->user->name]) }}">{{ $element->user->slug }}</a>
                    </td>
                </tr>
            @endif
            @if($element->user->country && env('SHOW_COMPANY'))
                <tr>
                    <span style="min-width: 130px;">
                    <td class="td-fixed-element">
                    <i class="fa fa-fw icon-f-23 fa-lg"></i>
                        {{ trans('general.company_country') }}:</span>
                    </td>
                    <td>
                        {{ $element->user->country->slug  }}
                    </td>
                </tr>
            @endif
            @if($element->shipment_package && $element->shipment_package->countries->isNotEmpty() && !env('HTB'))
                <tr>
                    <td class="td-fixed-element">
                        <span style="min-width: 130px;"><i class="fa fa-fw icon-f-48 fa-lg"></i> {{ trans('general.countries_available_for_shipment') }}:</span>
                    </td>
                    <td>
                        @foreach($element->shipment_package->countries as $country)
                            {{ $country->slug }},
                        @endforeach
                    </td>
                </tr>
            @endif
            @if($element->user->country && !env('HOMEKEY'))
                <tr>
                    <td class="td-fixed-element">
                    <span style="min-width: 130px;"><i class="fa fa-fw icon-g-45 fa-lg"></i>

                        {{ trans('general.weight') }}:</span>
                    </td>
                    <td>
                        {{ $element->weight  }} {{ trans('general.kg') }}</li>
                    </td>
                </tr>
            @endif
            @if(!is_null($element->duration))
                <tr>
                    <td class="td-fixed-element"><span><i class="fa fa-fw fa-clock-o fa-lg"></i> <span
                                    class="ml-2"></span> {{ trans('general.duration') }}:</span>
                    </td>
                    <td>
                        {{ $element->duration }} {{ trans("general.hours") }}</li>
                    </td>
                </tr>
            @endif
            @if(!is_null($element->setup_time))
                <tr>
                    <td class="td-fixed-element">
                <span><i class="fa fa-fw fa-calendar-times-o fa-lg"></i> {{ trans('general.setup_time') }}
                        :</span>
                    </td>
                    <td>
                        {{ $element->setup_time }} {{ trans('general.hours') }}
                    </td>
                </tr>
            @endif
            @if(!is_null($element->individuals))
                <tr>
                    <td class="td-fixed-element">
                        <span><i class="fa fa-fw fa-lg icon-f-95"></i> {{ trans('general.individuals_count') }}: </span>
                    </td>
                    <td>
                        {{ $element->individuals }}
                    </td>
                </tr>
            @endif
            @if(!is_null($element->user->mobile))
                <tr>
                    <td class="td-fixed-element">
                        <span><i class="fa fa-fw fa-lg icon-f-93"></i> {{ trans('general.mobile') }}:</span>
                    </td>
                    <td>
                        <a href="tel:{{ $element->user->fullMobile }}">
                            {{ $element->user->fullMobile }}
                        </a>
                    </td>
                </tr>
            @endif
            @if(!is_null($element->user->whatsapp))
                <tr>
                    <td class="td-fixed-element">
                        <span><i class="fa fa-fw fa-lg icon-f-93"></i> {{ trans('general.whatsapp') }}:</span>
                    </td>
                    <td>
                        <a href="https://api.whatsapp.com/send?phone={{ $element->user->whatsapp }}&text={{ request()->url() }}">
                            {{ $element->user->whatsapp }}
                        </a>
                    </td>
                </tr>
            @endif
            @if(!is_null($element->user->phone))
                <tr>
                    <td class="td-fixed-element">
                        <span><i class="fa fa-fw fa-lg icon-h-35"></i> {{ trans('general.phone') }}:</span>
                    </td>
                    <td>
                        <a href="tel:{{ $element->user->phone }}">
                            {{ $element->user->phone }}
                        </a>
                    </td>
                </tr>
            @endif
            @if($element->is_available && !env('DAILY') && !env('HOMEKEY'))
                <tr>
                    <td class="td-fixed-element">
                        <span><i class="fa fa-fw fa-lg icon-e-74"></i> {{ trans('general.available_items') }}:</span>
                    </td>
                    <td>
                        {{ $element->totalAvailableQty }} {{ trans('general.item') }}
                    </td>
                </tr>
            @endif
            @if($element->categories->isNotEmpty())
                <tr>
                    <td class="td-fixed-element"><span><i
                                    class="fa fa-fw icon-f-90 fa-lg"></i></span></span>{{ trans('general.categories') }}
                        :
                    </td>
                    <td>
                        @foreach($element->categories as $cat)
                            <a class="theme-color"
                               href="{{ route('frontend.product.search',['product_category_id' => $cat->id]) }}">
                                {{ $cat->name }},
                            </a>
                        @endforeach
                    </td>
                </tr>
            @endif
            @if($element->tags->isNotEmpty())
                <tr>
                    <td class="td-fixed-element"><i class="icon-f-07 fa fa-fw fa-lg"></i>{{ trans("general.tags") }}:
                    </td>
                    <td>
                        @foreach($element->tags as $tag)
                            <a class="theme-color" href="{{ route('frontend.product.search',['tag_id' => $tag->id]) }}">
                                {{ $tag->slug }},
                            </a>
                        @endforeach
                    </td>
                </tr>
            @endif
            @if(!is_null($element->brands) && $element->brands->isNotEmpty())
                <tr>
                    <td class="td-fixed-element"><i class="icon-f-09 fa fa-fw fa-lg"></i>{{ trans("general.brands") }}:
                    </td>
                    <td>
                        @foreach($element->brands as $brand)
                            <a class="theme-color"
                               href="{{ route('frontend.product.search',['brand_id' => $brand->id]) }}">
                                {{ $brand->slug }},
                            </a>
                        @endforeach
                    </td>
                </tr>
            @endif
            @if($element->hasRealAttributes)
                @if($element->product_attributes->pluck('color')->isNotEmpty())
                    <tr>
                        <td class="td-fixed-element"><i
                                    class="icon-e-87 fa fa-fw fa-lg"></i>{{ trans('general.colors') }} :
                        </td>
                        <td>
                            @foreach($element->product_attributes->pluck('color')->unique() as $col)
                                <span style="color: {{ $col->code }}">{!! $col->name !!}</span>,
                            @endforeach
                        </td>
                    </tr>
                @endif
                @if($element->product_attributes->pluck('size')->isNotEmpty() && !env('DAILY'))
                    <tr>
                        <td class="td-fixed-element"><i
                                    class="icon-e-69 fa fa-fw fa-lg"></i>{{ trans('general.sizes') }} :
                        </td>
                        <td>
                            @foreach($element->product_attributes->pluck('size')->unique() as $size)
                                {!! $size->name !!},
                            @endforeach
                        </td>
                    </tr>
                @endif
            @else
                @if(!$element->hasRealAttributes)
                    @if(!is_null($element->size) && !env('DAILY'))
                        <tr>
                            <td class="td-fixed-element"><i class="icon-f-02 fa fa-fw fa-lg"></i><span
                                        class="ml-1"></span><span>{{ trans('general.size') }} : </span>
                            </td>
                            <td>
                                {{ $element->size->name }}
                            </td>
                        </tr>
                    @endif
                    @if(!is_null($element->color))
                        <tr>
                            <td class="td-fixed-element"><i class="icon-f-02 fa fa-fw fa-lg"></i><span
                                        class="ml-1"></span><span>{{ trans('general.color') }} : </span>
                            </td>
                            <td>
                                <span style="color : {{ $element->color->code }}">{{ $element->color->name }}</span>
                            </td>
                        </tr>
                    @endif
                @endif
            @endif
            <tr>
                <td class="td-fixed-element td-sm">
                <span><i class="fa fa-fw fa-eye fa-lg"></i> {{ trans('general.views_no') }}
                        :</span>
                </td>
                <td>
                    {{ $element->views }} {{ trans('general.viewers') }}
                </td>
            </tr>
            @if($element->notes)
                <tr>
                    <td class="td-fixed-element"><i class="icon-f-07 fa fa-fw fa-lg"></i><span>{{ trans('general.notes') }} : </span>
                    </td>
                    <td>
                        {{ $element->notes }}
                    </td>
                </tr>
            @endif

        </table>
    </div>
</div>
