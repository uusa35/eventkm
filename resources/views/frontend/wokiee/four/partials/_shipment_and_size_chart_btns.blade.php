<div class="tt-wrapper product-information-buttons text-center">
    @if(($element->size_chart_image || $settings->size_chart) && $element->show_size_chart)
        <a data-toggle="modal" data-target="#modalProductInfo" href="#">
                                        <span class="align-content-center">
                                            <i class="fa fa-fw fa-lg icon-e-75"></i>
                                            <span>
                                        {{ trans('general.size_guide') }}
                                            </span>
                                        </span>
        </a>
    @endif
    @if(trans()->has('message.shipment_one') || trans()->has('message.return_policy'))
    <a data-toggle="modal" data-target="#modalProductInfo-02" href="#">
                                        <span>
                                            <i class="fa fa-fw fa-lg icon-f-48"></i>
                                        {{ trans('general.shipping') }}
                                        </span>
    </a>
    @endif
</div>

