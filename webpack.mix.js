const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.js('resources/assets/js/app.js', 'public/js').version()
    .sass('resources/assets/sass/app.scss', 'public/css').version()
    .styles('../wokiee-ecommerce-html/html/css/theme.css', 'public/css/theme.css').version()
    .styles('../wokiee-ecommerce-html/html/css/rtl.css', 'public/css/theme-rtl.css').version();
mix.styles(['resources/assets/css/frontend-custom-ar.css'], 'public/css/frontend-custom-ar.css').version();
mix.styles(['resources/assets/css/frontend-custom-en.css'], 'public/css/frontend-custom-en.css').version();
mix.styles(['resources/assets/css/frontend-custom-en.css'], 'public/css/frontend-custom-en.css').version();
// frontend
// wokiee
mix.styles([
    // 'resources/assets/css/wokiee-theme-custom.css',
    './node_modules/font-awesome/css/font-awesome.css',
    './node_modules/@chenfengyuan/datepicker/dist/datepicker.css',
    './node_modules/select2/dist/css/select2.css',
    'resources/assets/css/frontend-custom.css'
], 'public/css/plugins.css');
// frontend js
// wokiee
mix.scripts([
    // loading jquery from the app.js
    '../wokiee-ecommerce-html/html/external/jquery/jquery.min.js',
    '../wokiee-ecommerce-html/html/external/bootstrap/js/bootstrap.min.js',
    './node_modules/@chenfengyuan/datepicker/dist/datepicker.js',
    './node_modules/moment/min/moment.min.js',
    '../wokiee-ecommerce-html/html/external/elevatezoom/jquery.elevatezoom.js',
    '../wokiee-ecommerce-html/html/external/slick/slick.min.js',
    '../wokiee-ecommerce-html/html/external/isotope/imagesloaded.js',
    '../wokiee-ecommerce-html/html/external/isotope/isotope.pkgd.min.js',
    '../wokiee-ecommerce-html/html/external/perfect-scrollbar/perfect-scrollbar.min.js',
    '../wokiee-ecommerce-html/html/external/panelmenu/panelmenu.js',
    '../wokiee-ecommerce-html/html/external/rs-plugin/js/jquery.themepunch.tools.min.js',
    '../wokiee-ecommerce-html/html/external/rs-plugin/js/jquery.themepunch.revolution.min.js',
    '../wokiee-ecommerce-html/html/external/magnific-popup/jquery.magnific-popup.min.js',
    '../wokiee-ecommerce-html/html/external/instafeed/instafeed.min.js',
    '../wokiee-ecommerce-html/html/external/countdown/jquery.plugin.min.js',
    '../wokiee-ecommerce-html/html/external/countdown/jquery.countdown.min.js',
    '../wokiee-ecommerce-html/html/external/lazyLoad/lazyload.min.js',
    '../wokiee-ecommerce-html/html/js/main.js',
    '../wokiee-ecommerce-html/html/external/form/jquery.form.js',
    '../wokiee-ecommerce-html/html/external/form/jquery.validate.min.js',
    '../wokiee-ecommerce-html/html/external/form/jquery.form-init.js',
    './node_modules/select2/dist/js/select2.js'
], 'public/js/wokiee.demo.js').version();

mix.js('resources/assets/js/frontend-custom.js', 'public/js/frontend-custom.js').version();
mix.js('resources/assets/js/frontend-ar.js', 'public/js/frontend-ar.js').version();
mix.js('resources/assets/js/frontend-en.js', 'public/js/frontend-en.js').version();
// backend
mix.styles([
    './node_modules/font-awesome/css/font-awesome.css',
    '../metronic_v4.5.6/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css',
    '../metronic_v4.5.6/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css',
    '../metronic_v4.5.6/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',

    '../metronic_v4.5.6/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css',
    '../metronic_v4.5.6/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css',

    '../metronic_v4.5.6/theme/assets/global/plugins/morris/morris.css"',
    '../metronic_v4.5.6/theme/assets/global/plugins/fullcalendar/fullcalendar.min.css"',
    '../metronic_v4.5.6/theme/assets/global/plugins/jqvmap/jqvmap/jqvmap.css"',


    '../metronic_v4.5.6/theme/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css',
    '../metronic_v4.5.6/theme/assets/global/plugins/jquery-multi-select/css/multi-select.css',
    '../metronic_v4.5.6/theme/assets/global/plugins/select2/css/select2.min.css',
    '../metronic_v4.5.6/theme/assets/global/plugins/select2/css/select2-bootstrap.min.css',
    '../metronic_v4.5.6/theme/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css',
    '../metronic_v4.5.6/theme/assets/global/plugins/jquery-minicolors/jquery.minicolors.css',


    '../metronic_v4.5.6/theme/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
    '../metronic_v4.5.6/theme/assets/global/plugins/datatables/datatables.min.css',
    '../metronic_v4.5.6/theme/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css',
    '../metronic_v4.5.6/theme/assets/global/plugins/cubeportfolio/css/cubeportfolio.css',
    '../metronic_v4.5.6/theme/assets/global/plugins/bootstrap-toastr/toastr.min.css',

    '../metronic_v4.5.6/theme/assets/global/css/components.min.css',
    '../metronic_v4.5.6/theme/assets/global/css/plugins.min.css',

    '../metronic_v4.5.6/theme/assets/pages/css/portfolio.min.css',
    '../metronic_v4.5.6/theme/assets/pages/css/profile.min.css',
    '../metronic_v4.5.6/theme/assets/pages/css/profile-2.min.css',
    '../metronic_v4.5.6/theme/assets/pages/css/pricing.min.css',
    '../metronic_v4.5.6/theme/assets/pages/css/blog.min.css',

    '../metronic_v4.5.6/theme/assets/layouts/layout4/css/layout.min.css',
    // '../metronic_v4.5.6/theme/assets/layouts/layout/css/themes/darkblue.min.css',
    // '../metronic_v4.5.6/theme/assets/layouts/layout4/css/themes/blue.min.css',
    '../metronic_v4.5.6/theme/assets/layouts/layout4/css/themes/light.min.css',
    // '../metronic_v4.5.6/theme/assets/layouts/layout4/css/themes/grey.min.css',
    '../metronic_v4.5.6/theme/assets/layouts/layout4/css/custom.min.css',
    './resources/assets/css/bootstrap-datetimepicker.min.css',
    './resources/assets/css/backend-custom.css'

], 'public/css/backend.css').version();

mix.styles([
    './node_modules/font-awesome/css/font-awesome.min.css',
    '../metronic_v4.5.6/theme_rtl/assets/global/plugins/simple-line-icons/simple-line-icons.min.css',
    '../metronic_v4.5.6/theme_rtl/assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css',
    '../metronic_v4.5.6/theme_rtl/assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css',

    '../metronic_v4.5.6/theme_rtl/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css',
    '../metronic_v4.5.6/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css',

    '../metronic_v4.5.6/theme_rtl/assets/global/plugins/morris/morris.css"',
    '../metronic_v4.5.6/theme_rtl/assets/global/plugins/fullcalendar/fullcalendar.min.css"',
    '../metronic_v4.5.6/theme_rtl/assets/global/plugins/jqvmap/jqvmap/jqvmap.css"',


    '../metronic_v4.5.6/theme_rtl/assets/global/plugins/bootstrap-select/css/bootstrap-select-rtl.min.css',
    '../metronic_v4.5.6/theme_rtl/assets/global/plugins/jquery-multi-select/css/multi-select-rtl.css',
    '../metronic_v4.5.6/theme_rtl/assets/global/plugins/select2/css/select2.min-rtl.css',
    '../metronic_v4.5.6/theme_rtl/assets/global/plugins/select2/css/select2-bootstrap.min.css',
    '../metronic_v4.5.6/theme_rtl/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css',
    '../metronic_v4.5.6/theme_rtl/assets/global/plugins/jquery-minicolors/jquery.minicolors.css',


    '../metronic_v4.5.6/theme_rtl/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
    '../metronic_v4.5.6/theme_rtl/assets/global/plugins/datatables/datatables.min.css',
    '../metronic_v4.5.6/theme_rtl/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap-rtl.css',
    '../metronic_v4.5.6/theme_rtl/assets/global/plugins/cubeportfolio/css/cubeportfolio.css',
    '../metronic_v4.5.6/theme/assets/global/plugins/bootstrap-toastr/toastr.min.css',

    '../metronic_v4.5.6/theme_rtl/assets/global/css/components-rtl.min.css',
    '../metronic_v4.5.6/theme_rtl/assets/global/css/plugins-rtl.min.css',


    '../metronic_v4.5.6/theme_rtl/assets/pages/css/portfolio-rtl.min.css',
    '../metronic_v4.5.6/theme_rtl/assets/pages/css/profile-rtl.min.css',
    '../metronic_v4.5.6/theme_rtl/assets/pages/css/profile-2-rtl.min.css',
    '../metronic_v4.5.6/theme_rtl/assets/pages/css/pricing-rtl.min.css',
    '../metronic_v4.5.6/theme_rtl/assets/pages/css/blog-rtl.min.css',

    // '../metronic_v4.5.6/theme/assets/layouts/layout4/css/layout.min.css',
    '../metronic_v4.5.6/theme_rtl/assets/layouts/layout4/css/layout-rtl.min.css',
    // '../metronic_v4.5.6/theme_rtl/assets/layouts/layout/css/themes/darkblue-rtl.min.css',
    // '../metronic_v4.5.6/theme_rtl/assets/layouts/layout4/css/themes/blue-rtl.min.css',
    '../metronic_v4.5.6/theme_rtl/assets/layouts/layout4/css/themes/light-rtl.min.css',
    // '../metronic_v4.5.6/theme_rtl/assets/layouts/layout4/css/themes/grey.min.css',
    // '../metronic_v4.5.6/theme_rtl/assets/layouts/layout4/css/custom-rtl.min.css',
    './resources/assets/css/bootstrap-datetimepicker.min.css',
    './resources/assets/css/backend-custom.css',
    'resources/assets/css/backend-custom-ar.css',
], 'public/css/backend-rtl.css').version();


mix.scripts([
        '../metronic_v4.5.6/theme_rtl/assets/global/plugins/respond.min.js',
        '../metronic_v4.5.6/theme/assets/global/plugins/excanvas.min.js',
        '../metronic_v4.5.6/theme/assets/global/plugins/jquery.min.js',
        '../metronic_v4.5.6/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js',

        '../metronic_v4.5.6/theme/assets/global/plugins/datatables/datatables.min.js',
        '../metronic_v4.5.6/theme/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js',
        '../metronic_v4.5.6/theme/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js',
        '../metronic_v4.5.6/theme/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js',
        '../metronic_v4.5.6/theme/assets/global/plugins/select2/js/select2.full.min.js',

        '../metronic_v4.5.6/theme/assets/global/plugins/js.cookie.min.js',
        '../metronic_v4.5.6/theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
        '../metronic_v4.5.6/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
        '../metronic_v4.5.6/theme/assets/global/plugins/jquery.blockui.min.js',
        '../metronic_v4.5.6/theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
        '../metronic_v4.5.6/theme/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js',
        '../metronic_v4.5.6/theme/assets/global/plugins/jquery-minicolors/jquery.minicolors.min.js',
        '../metronic_v4.5.6/theme/assets/global/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js',


        '../metronic_v4.5.6/theme/assets/global/plugins/moment.min.js',
        '../metronic_v4.5.6/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js',
        '../metronic_v4.5.6/theme/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
        '../metronic_v4.5.6/theme/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
        '../metronic_v4.5.6/theme/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
        '../metronic_v4.5.6/theme/assets/global/plugins/clockface/js/clockface.js',



        '../metronic_v4.5.6/theme/assets/global/scripts/app.min.js',
        '../metronic_v4.5.6/theme/assets/pages/scripts/table-datatables-responsive.min.js',
        '../metronic_v4.5.6/theme/assets/pages/scripts/components-date-time-pickers.min.js',
        '../metronic_v4.5.6/theme/assets/global/plugins/bootstrap-toastr/toastr.min.js',
        '../metronic_v4.5.6/theme/assets/pages/scripts/ui-toastr.min.js',

        '../metronic_v4.5.6/theme/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js',
        '../metronic_v4.5.6/theme/assets/global/plugins/jquery.sparkline.min.js',
        '../metronic_v4.5.6/theme/assets/pages/scripts/profile.min.js',
        '../metronic_v4.5.6/theme/assets/pages/scripts/portfolio-4.min.js',
        '../metronic_v4.5.6/theme/assets/pages/scripts/portfolio-1.min.js',

        '../metronic_v4.5.6/theme/assets/pages/scripts/components-multi-select.min.js',
        '../metronic_v4.5.6/theme/assets/pages/scripts/components-color-pickers.min.js',
        '../metronic_v4.5.6/theme/assets/layouts/layout4/scripts/layout.min.js',
        '../metronic_v4.5.6/theme/assets/layouts/layout4/scripts/demo.min.js',
        '../metronic_v4.5.6/theme/assets/layouts/global/scripts/quick-sidebar.min.js',

    ],
    'public/js/backend.js').version();


mix.scripts([
    '../metronic_v4.5.6/theme/assets/pages/scripts/components-date-time-pickers.min.js',
    '../metronic_v4.5.6/theme/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
], 'public/js/datepicker.js').version();
mix.scripts('./node_modules/tinymce/tinymce.min.js', 'public/js/tinymce.min.js').version();
mix.scripts('resources/assets/js/backend-custom.js', 'public/js/backend-custom.js');
mix.copyDirectory('./../porto_ecommerce_html/demo-2/assets/images', 'public/images');
// wokiee
mix.copyDirectory('../wokiee-ecommerce-html/html/font/fonts', 'public/font/fonts');
mix.copyDirectory('../wokiee-ecommerce-html/html/font/fonts', 'public/css/fonts');
mix.copyDirectory('../wokiee-ecommerce-html/html/images', 'public/images');
mix.copyDirectory('../wokiee-ecommerce-html/html/external/rs-plugin/font', 'public/font');
mix.copyDirectory('../wokiee-ecommerce-html/html/external/rs-plugin/images', 'public/images');
mix.copyDirectory('../wokiee-ecommerce-html/html/external/rs-plugin/assets', 'public/assets');
mix.copyDirectory('../wokiee-ecommerce-html/html/external', 'public/external');
mix.react('resources/assets/js/productAttribute/index.js', 'public/js/productAttribute.js').version();
