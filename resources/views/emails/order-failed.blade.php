@component('mail::message')
# Order Failed

Your order has been Failed!
# Order No. {{ $order ? $order->id : 'N/A' }}

@component('mail::button', ['url' => env('APP_URL')])
Please contact us on {{ $settings->mobile  }} or whatsapp on {{ $settings->whatsapp }}
@endcomponent


# full Ref : {{ request()->has('ref') ? request()->ref : request()->fullUrl()}}
# full URL  : {{ request()->fullUrl()}}

@if($message)
# Message : {{ $message }}
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
