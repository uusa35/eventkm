@component('mail::message')
# Order Failed

Your order has been Failed!
# Order No. {{ $order ? $order->id : 'N/A' }}

@component('mail::button', ['url' => env('APP_URL')])
Please contact us on {{ $settings->mobile  }} or whatsapp on {{ $settings->whatsapp }}
@endcomponent


# full Url/Ref : {{ request()->has('ref') ? request()->ref : request()->fullUrl()}}

@if($message)
# Message : {{ $message }}
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
