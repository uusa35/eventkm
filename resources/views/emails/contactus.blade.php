@component('mail::message')
# @lang('general.thank_you')

@lang('general.we_received_ur_message') {{ $name }}

# {{ $title }}
# {{ $body }}

@lang('general.thank_u'),<br>
{{ config('app.name') }}
@endcomponent
