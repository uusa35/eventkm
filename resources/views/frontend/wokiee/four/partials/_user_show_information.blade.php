<div class="tt-add-info">
    <div class="tt-table-responsive">
        <table class="tt-table-shop-01">
            {{--<table class="table table-responsive">--}}
            @if(!env('EVENTKM'))
                <tr>
                    <td class="td-fixed-element td-sm"><i class="fa-tag fa fa-fw fa-lg"></i><span
                                class="ml-1"></span><span>{{ trans('general.sku') }} : </span>
                        <span class="ml-2"></span></td>
                    <td>
                        {{ $element->id }}
                    </td>
                </tr>
            @endif
            @if($element->role->slug)
                <tr>
                    <td class="td-fixed-element td-sm"><i class="icon-f-02 fa fa-fw fa-lg"></i><span
                                class="ml-1"></span><span>{{ trans('general.type') }} : </span>
                        <span class="ml-2"></span></td>
                    <td>
                        {{ $element->role->slug }}
                    </td>
                </tr>
            @endif
            @if($element->country && !env('EVENTKM'))
                <tr>
                    <td class="td-fixed-element td-sm"><i class="fa-globe fa fa-fw fa-lg"></i><span
                                class="ml-1"></span><span>{{ trans('general.country') }} : </span>
                        <span class="ml-2"></span></td>
                    <td>
                        {{ $element->country->name }}
                    </td>
                </tr>
            @endif
            @if($element->description)
                <tr>
                    <td class="td-fixed-element td-sm"><i class="fa-file-text fa fa-fw fa-lg"></i><span
                                class="ml-1"></span><span>{{ trans('general.description') }} : </span>
                        <span class="ml-2"></span></td>
                    <td>
                        {{ $element->description }}
                    </td>
                </tr>
            @endif
            @if($element->address)
                <tr>
                    <td class="td-fixed-element td-sm"><i class="fa-user-circle fa fa-fw fa-lg"></i><span
                                class="ml-1"></span><span>{{ trans('general.address') }} : </span>
                        <span class="ml-2"></span></td>
                    <td>
                        {{ $element->address }}
                    </td>
                </tr>
            @endif
            @if($element->facebook)
                <tr>
                    <td class="td-fixed-element td-sm"><i class="fa-facebook fa fa-fw fa-lg"></i><span
                                class="ml-1"></span><span>{{ trans('general.facebook') }} : </span>
                        <span class="ml-2"></span></td>
                    <td>
                        {{ $element->facebook }}
                    </td>
                </tr>
            @endif
            @if($element->twitter)
                <tr>
                    <td class="td-fixed-element td-sm"><i class="fa-twitter fa fa-fw fa-lg"></i><span
                                class="ml-1"></span><span>{{ trans('general.twitter') }} : </span>
                        <span class="ml-2"></span></td>
                    <td>
                        {{ $element->twitter }}
                    </td>
                </tr>
            @endif
            @if($element->whatsapp)
                <tr>
                    <td class="td-fixed-element td-sm"><i class="fa-whatsapp fa fa-fw fa-lg"></i><span
                                class="ml-1"></span><span>{{ trans('general.whatsapp') }} : </span>
                        <span class="ml-2"></span></td>
                    <td>
                        <a href="https://api.whatsapp.com/send?phone={{ $element->whatsapp }}&text={{ env('APP_NAME') }}">
                            {{ $element->whatsapp }}
                        </a>
                    </td>
                </tr>
            @endif
            @if($element->fullMobile && !env('DESIGNERAAT'))
                <tr>
                    <td class="td-fixed-element td-sm"><i class="fa-mobile-phone fa fa-fw fa-lg"></i><span
                                class="ml-1"></span><span>{{ trans('general.mobile') }} : </span>
                        <span class="ml-2"></span></td>
                    <td>
                        <a href="tel:{{ $element->fullMobile }}">
                            {{ $element->fullMobile }}
                        </a>
                    </td>
                </tr>
            @endif
            @if(!is_null($element->duration))
                <tr>
                    <td class="td-fixed-element td-sm"><span><i class="fa fa-fw fa-clock-o fa-lg"></i> <span
                                    class="ml-2"></span> {{ trans('general.duration') }}:</span>
                    </td>
                    <td>
                        {{ $element->duration }} {{ trans("general.hours") }}</li>
                    </td>
                </tr>
            @endif
            @if(!is_null($element->setup_time))
                <tr>
                    <td class="td-fixed-element td-sm">
                <span><i class="fa fa-fw fa-calendar-times-o fa-lg"></i> <span class="ml-2"></span>{{ trans('general.setup_time') }}
                        :</span>
                    </td>
                    <td>
                        {{ $element->setup_time }} {{ trans('general.hours') }}
                    </td>
                </tr>
            @endif
            @if(!is_null($element->individuals))
                <tr>
                    <td class="td-fixed-element td-sm">
                        <span><i class="fa fa-fw fa-lg icon-f-95"></i> <span class="ml-2"></span>{{ trans('general.individuals_count') }}: </span>
                    </td>
                    <td>
                        {{ $element->individuals }}
                    </td>
                </tr>
            @endif
            @if($element->notes)
                <tr>
                    <td class="td-fixed-element td-sm"><i class="icon-f-07 fa fa-fw fa-lg"></i><span
                                class="ml-1"></span><span>{{ trans('general.notes') }} : </span>
                        <span class="ml-2"></span></td>
                    <td>
                        {{ $element->notes }}
                    </td>
                </tr>
            @endif
            <tr>
                <td class="td-fixed-element td-sm">
                <span><i class="fa fa-fw fa-eye fa-lg"></i> <span class="ml-2"></span>{{ trans('general.views_no') }}
                        :</span>
                </td>
                <td>
                    {{ $element->views }} {{ trans('general.viewers') }}
                </td>
            </tr>
            <tr>
                <td class="td-fixed-element td-sm">
                <span><i class="fa fa-fw fa-thumbs-up fa-lg"></i> <span class="ml-2"></span>{{ trans('general.fans_no') }}
                        :</span>
                </td>
                <td>
                    <span>{{ $element->totalFans }} {{ trans('general.fans_no') }}</span>
                </td>
            </tr>
            @if($element->isDesigner)
                <tr>
                    <td class="td-fixed-element td-sm">
                <span><i class="fa fa-fw fa-product-hunt fa-lg"></i> <span class="ml-2"></span>{{ trans('general.collection_no') }}
                        :</span>
                    </td>
                    <td>
                        <span>{{ $element->collections->count() }} {{ trans('general.collections') }}</span>
                    </td>
                </tr>
            @endif
        </table>
    </div>
</div>
