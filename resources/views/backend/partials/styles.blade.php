@if (app()->isLocale('ar'))
    <link href="{{ mix('css/backend-rtl.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/clockface.css') }}" rel="stylesheet">
@else
    <link href="{{ mix('css/backend.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/clockface.css') }}" rel="stylesheet">
@endif
<style>
    /*.page-sidebar, .page-sidebar-closed.page-sidebar-fixed, .page-content-wrapper, .page-header.navbar,  .page-logo , .page-header.navbar {*/
    {{--background-color: {{ auth()->user()->role->color }} !important;--}}
{{--        color : {{ auth()->user()->role->color }} !important;--}}
   /*        background-color: blue;*/
    /*    }*/

    .page-sidebar .page-sidebar-menu > li > a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li > a, .sub-menu > li > a {
        color: {{ auth()->user()->role->color }}    !important;
        border-bottom: 0.2px solid lightgray    !important;
    }

    .page-sidebar .page-sidebar-menu > li.active.open > a, .page-sidebar .page-sidebar-menu > li.active > a, page-sidebar-fixed .page-sidebar:hover {
        /*background-color: darkgray !important;*/
        /*color : white !important;*/
        color: {{ auth()->user()->role->color }}    !important;

    }

    .page-sidebar-menu>li>a>i, .page-sidebar .page-sidebar-menu .sub-menu>li>a>i {
        color : {{ $settings->btn_bg_theme_color }} !important;
    }

</style>
