@component('mail::message')
<div style="display: flex; width : 100%; align-items: center; justify-content: center">
<img src="{{ $settings->getCurrentImageAttribute('logo') }}" alt="{{ $settings->company }}" style="width : 150px; margin-bottom: 20px">
</div>

<div style="text-align: left;">
{{ trans('general.date') }} : {{ Carbon\Carbon::today()->format('d/m/Y') }}
</div>
@component('mail::panel')
# {{ trans('general.order_number') }} : {{ $order->id }}
<strong style="float : {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}; direction : {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"> {{ trans('general.gentlemen') }} / {{ $user->name ? $user->name : $user->slug }}</strong><br>
<strong style="float : {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}; direction : {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"> {{ trans('general.address') }}/ {{ $user->address }}</strong><br>
@if($order->area)
<strong style="float : {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}; direction : {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"> {{ trans('general.area') }}/ {{ $order->area ? $order->area : $order->user->area }}</strong><br>
@endif

{{--<strong style="float : {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}; direction : {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"> {{ trans('general.area') }}/ {{ $order->area }}</strong><br>--}}
<strong style="float : {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}; direction : {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"> {{ trans('general.mobile') }} / {{ $user->mobile }}</strong>
<br>
@endcomponent

</br>
@component('mail::table')
| {{ trans('general.price') }}| {{ trans('general.qty') }}| {{  trans('general.size_or_date') }}  | {{ trans('general.length_color_or_time') }}|{{ trans('general.sku') }}|{{ trans('general.name') }}|
| ------------- |:-------------:| --------:| --------:|--------:|--------:|
@foreach($order->order_metas as $orderMeta)
@if($orderMeta->isProductType && $orderMeta->product)
@if(!is_null($orderMeta->product->product_attributes) && $orderMeta->product->has_attributes)
| {{ $orderMeta->price }}| {{ $orderMeta->qty }}| {{ $orderMeta->product_attribute->size->name ?? 'N/A' }}| {{ $orderMeta->product_attribute->color->name ?? 'N/A' }}| {{ str_limit($orderMeta->product->sku,10,'') }}| {{ str_limit($orderMeta->product->name,8,'') }}|
@elseif($orderMeta->product && $orderMeta->product->size && $orderMeta->product->color)
| {{ $orderMeta->price }}| {{ $orderMeta->qty }}| {{ $orderMeta->product->size->name }} | {{ $orderMeta->product->color->name }} | {{ str_limit($orderMeta->product->sku,10,'') }}| {{ str_limit($orderMeta->product->name,8,'') }} |
@else
| {{ $orderMeta->price }}| {{ $orderMeta->qty }}| {{ $orderMeta->product_size ?? 'N/A'}} | {{ $orderMeta->product_color ?? 'N/A'}} | {{ str_limit($orderMeta->product->sku,10,'') }}| {{ str_limit($orderMeta->product->name,8,'') }} |
@endif
@elseif($orderMeta->isServiceType && $orderMeta->service)
| {{ $orderMeta->price }}| {{ str_limit($orderMeta->notes,20) }}| {{ $orderMeta->service_date }} | {{ $orderMeta->service_time }} | {{ $orderMeta->service->id }}|{{ str_limit($orderMeta->service->name,10,'') }}|
@elseif($orderMeta->isQuestionnaireType)
| {{ $orderMeta->price }}| {{ str_limit($orderMeta->notes,20) }}| {{ $orderMeta->created_at->format('d/m/Y') }} | {{ $orderMeta->questionnaire->user->slug }} | {{ $orderMeta->questionnaire->id }}|{{ str_limit($orderMeta->questionnaire->name,10,'') }}|
@else
| {{ trans('general.item_deleted') }} |
@endif
@if($orderMeta->isQuestionnaireType)
@component('mail::panel')
<div style="font-size: small; font-weight: bold;">
{{ trans('message.questionnaire_order_message') }}
</div>
@endcomponent
@endif
@endforeach
@if($order->shipment_fees > 0)
|     {{ $order->shipment_fees }}| |{{ trans('general.shipment_fees') }} |
@endif
@if($order->coupon_id && $order->discount > 0)
|     {{ $order->discount}}| |{{ trans('general.discount') }} |
@endif
|     {{ $order->net_price }}| |{{ trans('general.total') }}
@endcomponent
{{--@component('mail::table')--}}
{{--| Prices       | {{ $element->title }}         | S.  |--}}
{{--| ------------- |:-------------:| --------:|--}}
{{--| {{ $element->price }}         | <div style="direction: rtl !important;">{!! $element->content !!}</div>           | 1         |--}}
{{--| {{ $element->total  }}        | total             |           |--}}
{{--| {{ $element->discount  }}     | discount         |           |--}}
{{--| {{ $element->net_total  }}    | net total         |           |--}}
{{--@endcomponent--}}
<hr>


@foreach($order->order_metas as $orderMeta)
@if($orderMeta->notes && $orderMeta->isProductType)
@component('mail::panel')
<div style="font-size: small; font-weight: bold; text-align: center !important;">
{{ trans('general.notes') }} : {{ $orderMeta->product->name }} / {{ $orderMeta->notes }}
</div>
@endcomponent
@endif
@endforeach

@component('mail::panel')
<div style="font-size: small; font-weight: bold; text-align: center !important;">
{{ trans('message.we_received_your_order_order_shall_be_reviewed_thank_your_for_choosing_our_service') }}
</div>
@endcomponent

@if(auth()->check() && auth()->user()->isSuper)
@component('mail::button', ['url' => route('backend.order.index'),'class' => 'button-black'])
<strong>{{ trans('general.back') }}</strong>
@endcomponent
@endif


<div style="text-align: center; width: 100%; float: left; font-weight: bolder;">
مع تحيات,<br>
<br>
</div>
@component('mail::button', ['url' => env('APP_URL'),'class' => 'button-black'])
<strong>{{ $settings->company_en }}</strong>
@endcomponent
@endcomponent
