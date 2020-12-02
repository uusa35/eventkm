<script src="{{ mix('js/backend.js') }}"></script>
<script src="{{ mix('js/tinymce.min.js') }}"></script>
<script src="{{ mix('js/backend-custom.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
{{--<script src="{{ mix('js/datepicker.js') }}"></script>--}}
<script type="application/javascript">
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
<script>
    console.log('from inside scripts.blade')
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "{{ app()->getLocale() === 'ar' ? "toast-top-left" : "toast-top-right" }}",
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "10000",
        "timeOut": "15000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    @if(session()->has('success'))
    toastr.success("{{ session()->get('success') }}");
    @elseif(session()->has('error'))
    toastr.error("{{ session()->get('error') }}");
    @elseif(session()->has('warning'))
    toastr.warning("{{ session()->get('warning') }}");
    @endif
</script>
