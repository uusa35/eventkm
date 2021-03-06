{{--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" rel="stylesheet"/>--}}
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>--}}
<script src="{{ mix('js/wokiee.demo.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ mix('js/frontend-custom.js') }}"></script>
<script src="{{ mix('js/productAttribute.js') }}"></script>
@if(app()->isLocale('ar'))
    <script src="{{ mix('js/frontend-ar.js') }}"></script>
@else
    <script src="{{ mix('js/frontend-en.js') }}"></script>
@endif
@if(env('GOOGLE_TRANSLATE_FEATURE'))
    <script type="text/javascript"
            src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: '{!! app()->getLocale() !!}'}, 'google_translate_element');
        }
    </script>
@endif
@if($settings->code)
    {!!  $settings->code !!}
@endif
@if(app()->environment('production'))
@endif

