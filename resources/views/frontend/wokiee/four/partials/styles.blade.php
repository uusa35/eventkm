@include('frontend.wokiee.partials.styles')
<style type="text/css">
    .tt-desctop-menu nav > ul > li.dropdown > a {
        font-size: small !important;
    }

    .tt-logo img {
        margin-top: 5px;
        /*margin-bottom: 0px;*/
        /*max-height: 60px !important;*/
    }

    .tt-mobile-header .tt-logo-container {
        height: auto !important;
    }

    .modal .modal-header .close:before, .mfp-close:before, .mfp-arrow-right:before, .mfp-arrow:after, .slider-revolution.revolution-default .tp-rightarrow:before, .slider-revolution.revolution-default .tp-leftarrow:before, body:not(.touch-device) .tt-portfolio-content.layout-default figure figcaption .tt-btn-zomm::before, .mfp-arrow:after, .mfp-arrow:before {
        font-family: wokiee !important;
    }

    .tt-header-holder {
        margin-top: 10px;
    }

    .slider-revolution {
        max-height: 720px !important;
    }

    .tt-promo-02 > img {
        transform: none !important;
    }

    .slick-slide {
        height: auto !important;
    }

    .tt-listing-post.tt-half .tt-post .tt-post-img + .tt-post-content {
        flex: 0 0 77.5%;
    }

    @if(config('app.MALLR') || config('app.ABATI'))

    body, html, a, p, h1, h2, h3, h4, h5, h6, table, row, td, th, tr, td, thead, tfoot, span, .btn, ul, li,
    .container, .tt-title-small, .tt-description, header, footer
    .tt-collapse-title, .tt-collapse-content, .tt-collapse-block .tt-item .tt-collapse-title,
    .tt-label, .tt-label-sale, tt-label-new, tt-label tt-label-our-fatured,
    .tt-product-single-info .tt-label [class^=tt-label], .tt-collapse-title,
    .tt-desctop-menu nav > ul > li.dropdown > a,
    .tt-collapse-content, .tt-title-options, .form-group, .form, .tt-table-03, select, option, .form-default select.form-control:not([size]):not([multiple])
    .form-default .form-group, label, label:not(.error), .tt-cart-total-title, .tt-cart-total-price, .tt-title-large, .tt-title {
        /*font-family: 'fb', 'sans-serif' !important;*/
        @if(app()->isLocale('ar'))
       font-family: 'skynews', 'sans-serif' !important;
        @else
       font-family: 'Tajawal-Medium', 'sans-serif' !important;
        @endif
    }

    @elseif(config('app.DAILY') || config('app.HTB'))
    body, html, a, p, h1, h2, h3, h4, h5, h6, table, row, td, th, tr, td, thead, tfoot, span, .btn, ul, li,
    .container, .tt-title-small, .tt-description, header, footer
    .tt-collapse-title, .tt-collapse-content, .tt-collapse-block .tt-item .tt-collapse-title,
    .tt-label, .tt-label-sale, tt-label-new, tt-label tt-label-our-fatured,
    .tt-product-single-info .tt-label [class^=tt-label], .tt-collapse-title,
    .tt-collapse-content, .tt-title-options, .form-group, .form, .tt-table-03, select, option, .form-default select.form-control:not([size]):not([multiple])
    .form-default .form-group, label, label:not(.error), .tt-cart-total-title, .tt-cart-total-price, .tt-title-large, .tt-title {
        @if(app()->isLocale('ar'))
       font-family: 'GE SS Unique', 'sans-serif' !important;
        @else
       font-family: 'Tajawal-Medium', 'sans-serif' !important;
    @endif


    }

    @elseif(config('app.ESCRAP') || config('app.HOMEKEY') || config('app.EXPO') || config('app.HUDA') || config('app.DESIGNERAAT') || config('app.ISTORES'))
    body, html, a, p, h1, h2, h3, h4, h5, h6, table, row, td, th, tr, td, thead, tfoot, span, .btn, ul, li,
    .container, .tt-title-small, .tt-description, header, footer
    .tt-collapse-title, .tt-collapse-content, .tt-collapse-block .tt-item .tt-collapse-title,
    .tt-label, .tt-label-sale, tt-label-new, tt-label tt-label-our-fatured,
    .tt-product-single-info .tt-label [class^=tt-label], .tt-collapse-title,
    .tt-collapse-content, .tt-title-options, .form-group, .form, .tt-table-03, select, option, .form-default select.form-control:not([size]):not([multiple])
    .form-default .form-group, label, label:not(.error), .tt-cart-total-title, .tt-cart-total-price, .tt-title-large, .tt-title {
        @if(app()->isLocale('ar'))
       font-family: 'Tajawal-Medium', 'sans-serif' !important;
        @else
       font-family: 'Tajawal-Medium', 'sans-serif' !important;
    @endif

    }

    @else
    body, html, a, p, h1, h2, h3, h4, h5, h6, table, row, td, th, tr, td, thead, tfoot, span, .btn, ul, li,
    .container, .tt-title-small, .tt-description, header, footer
    .tt-collapse-title, .tt-collapse-content, .tt-collapse-block .tt-item .tt-collapse-title,
    .tt-label, .tt-label-sale, tt-label-new, tt-label tt-label-our-fatured,
    .tt-product-single-info .tt-label [class^=tt-label], .tt-collapse-title,
    .tt-collapse-content, .tt-title-options, .form-group, .form, .tt-table-03, select, option, .form-default select.form-control:not([size]):not([multiple])
    .form-default .form-group, label, label:not(.error), .tt-cart-total-title, .tt-cart-total-price, .tt-title-large, .tt-title {
        @if(app()->isLocale('ar'))
       font-family: 'GE SS Unique', 'sans-serif' !important;
        @else
       font-family: 'Tajawal-Medium', 'sans-serif' !important;
        @endif
    @endif
</style>

@if(config('app.EVENTKM'))
    @if(app()->getLocale() === 'en')
        <style type="text/css">
            body, html, div, a, p, h1, h2, h3, h4, h5, h6, table, row, td, th, tr, thead, tfoot, button, span, .btn, .btn-del, ul, li, .page-content, .portlet, .light, .profile-sidebar-portlet {
                /*font-family: 'sst-arabic-bold', 'sans-serif' !important;*/
                font-family: 'Poppins', 'sans-serif' !important;
                /*text-transform: uppercase !important;*/
            }

            .tt-desctop-menu nav > ul > li.dropdown > a {
                font-size: large !important;
            }

            .alert-danger i {
                color: red !important;
            }

            .alert-danger {
                color: #000000;
                background-color: #ffffff;
                border-color: #000000;
            }

            .page-link, .page-item.disabled .page-link {
                border: none !important;
                background-color: transparent !important;
            }

            .tt-product:not(.tt-view) .tt-description, .tt-footer-col {
                background-color: black !important;
            }
        </style>
    @else
        <style type="text/css">
            body, html, div, a, p, h1, h2, h3, h4, h5, h6, table, row, td, th, tr, thead, tfoot, button, span, .btn, .btn-del, ul, li, .page-content, .portlet, .light, .profile-sidebar-portlet {
                font-family: 'GE SS Unique', 'sans-serif' !important;
                text-transform: uppercase !important;
            }

            .tt-desctop-menu nav > ul > li.dropdown > a {
                font-size: large !important;
            }

            .alert-danger i {
                color: red !important;
            }

            .alert-danger {
                color: #000000;
                background-color: #ffffff;
                border-color: #000000;
            }

            .page-link, .page-item.disabled .page-link {
                border: none !important;
                background-color: transparent !important;
            }

            .tt-product:not(.tt-view) .tt-description, .tt-footer-col {
                background-color: black !important;
            }
            .dropdown .active > a, .active, .accordionCustome:hover , header .tt-color-scheme-01 {
            background-color:  black !important;
            }
        </style>
    @endif
@endif
<style>
    body, .tt-show, .page-link, .page-item.active, .page-link, .page-item.disabled {
        color: {{ $settings->main_theme_color ? $settings->main_theme_color : 'white' }};
        background-color: {{ $settings->main_theme_bg_color ? $settings->main_theme_bg_color : 'white' }};
    }

    /*p, .tt-collapse-content p, .tt-shopcart-table01 td, .tt-shopcart-table01 th {*/
{{--        color: {{ $settings->main_theme_color ? $settings->main_theme_color : 'white' }}                 !important;--}}
/*    }*/

    header, .tt-color-scheme-01, .tt-footer-center, footer .tt-footer-custom:last-child
    .tt-color-scheme-02,
    .tt-search-type2-rtl, .tt-background, .dot,
    .headerunderline, .stuck.tt-stuck-nav {
        background-color: {{ $settings->header_theme_bg }}                    !important;
    }

    footer .tt-color-scheme-02, footer, .tt-footer-center, footer .tt-footer-custom:last-child, footer p , footer .tt-collapse-title, footer .tt-title , footer .tt-list,
    footer li a, footer a, footer div , footer span, footer .tt-collapse-content a , footer .tt-collapse-content , footer address , footer p , footer i {
        color: {{ $settings->footer_theme_color }}                    !important;
        background-color: {{ $settings->footer_bg_theme_color }}                    !important;
    }


    footer .tt-color-scheme-01 .tt-collapse-content a, footer .tt-color-scheme-01 {
        color: {{ $settings->footer_theme_color }}                    !important;
    }


    .btn {
        color: {{ $settings->btn_text_theme_color }} !important;
        background-color: {{ $settings->btn_bg_theme_color }}  !important;
    }

    .btn, .tt-btn-search-rtl, .tt-btn-search,
    .tt-menu-toggle.stylization-02,
    .btn-link, .btn-link:focus,
    .btn.btn-small:hover,
    .tt-back-to-top,
    .btn.btn-border, .tt-menu-categories .tt-dropdown-toggle,
    .tt-product:not(.tt-view) .tt-image-box .tt-btn-wishlist.active, .page-item.active .page-link, .tt-btn-compare,
    .tt-image-box .tt-btn-wishlist,
    ul.tt-options-swatch li.active a:not(.options-color):not(.options-color-img), ul.tt-options-swatch li:hover a:not(.options-color):not(.options-color-img),
    .btn > .fa .fa-fw, .tt-badge-cart,
    .tt-product:not(.tt-view):hover .tt-image-box .tt-btn-quickview, .tt-product:not(.tt-view):hover .tt-image-box .tt-btn-quickview:hover , .skltbs-theme-light .skltbs-tab.skltbs-active , .slick-arrow:hover {
        color: {{ $settings->btn_text_theme_color }} !important;
        background-color: {{ $settings->btn_bg_theme_color }}  !important;
    }

    .btn,  .btn-border, .tt-cart-btn {
        border: none !important;
        border-radius: 0px !important;
    }

    .tt-product:not(.tt-view) .tt-add-info li a,
    .tt-desctop-menu:not(.tt-hover-02) li.dropdown > a,
    .tt-desctop-menu:not(.tt-hover-02) li.dropdown.active > a,
    .tt-desctop-menu:not(.tt-hover-02), .tt-btn-quickview {
        color: {{ $settings->main_theme_color }}            !important;
    }

    .tt-mobile-header .tt-top-line {
        border-top: 1px solid {{ $settings->btn_bg_theme_color }}                  !important;
    }

    li.dropdown.selected > a,
    .tt-menu-toggle.stylization-02,
    header .tt-dropdown-obj .tt-dropdown-toggle,
    header .tt-multi-obj ul li.active a [class^=icon-],
    .datepicker-panel > ul > li, .tt-menu-categories .tt-dropdown-menu nav > ul > li > a span,
    .tt-social-icon li a, .tt-social-icon li a:hover,
    .tt-desctop-menu:not(.tt-hover-02) li.dropdown > a, header .tt-dropdown-obj .tt-dropdown-toggle, .tt-dropdown-toggle {
        color: {{ $settings->menu_theme_color }}                  !important;
    }

    .tt-desktop-header, .headerunderline {
        border-bottom-color: {{ $settings->menu_theme_bg }}     !important;
        border-bottom-width: 5px;
    }

    footer .tt-color-scheme-02 {
        border-top: 5px solid {{ $settings->menu_theme_bg }}    !important;
    }

    header .tt-color-scheme-01 {
        background-color: #FBFBFB      !important;
        color: {{ $settings->menu_theme_color }}                  !important;
    }

    header .tt-color-scheme-01 .tt-box-info ul li a, header .tt-social-icon li a {
        color: {{ $settings->normal_text_theme_color }}                  !important;
    }

    .tt-desctop-menu img {
        max-width: 250px;
    }

    .img-menu-category {
        max-height: 250px !important;
    }

    .countdown-selection
    .theme-color,
    .tt-countdown, .tt-countdown_box,
    .tt-product-single-info > a,
    .tt-price, .old-price, p,
    .tt-login-form .tt-item .additional-links a,
    .tt-description,
    .money, .tt-description-wrapper, .tt-description-wrapper:hover,
    .product-information-buttons a, .tt-services-block,
    header .tt-multi-obj ul li a:hover, header .tt-multi-obj ul li a:hover, .tt-btn-quickview:hover,
    .tt-product:not(.tt-view) .tt-image-box .tt-btn-quickview:hover,
    .tt-desctop-menu:not(.tt-hover-02) li.dropdown > a:hover, .tt-block-title,
    .tt-promo-box.hover-type-2:hover, .tt-product:not(.tt-view):hover, .tt-collapse-content a {

        color: {{ $settings->normal_text_theme_color }}                    !important;
    }

    h1, h2, h3, .tt-dropdown-toggle, .countdown-selection .theme-color, .tt-countdown, .tt-countdown_box, .tt-product-single-info > a, .tt-price, .old-price,
    .form-check-label, .card-header, label, label:not(.error), .card-text,
    .money, header .tt-multi-obj ul li.active a, .product-information-buttons a, .tt-services-block .tt-col-icon,
    .tt-title, h1 .tt-title, .tt-collapse-title, .tt-block-title, .tt-block-title .tt-title a, .tt-title-small , .tt-base-color {
        color: {{ $settings->header_one_theme_color }}              !important;
    }

    .tt-product:not(.tt-view) .tt-description .tt-title a, .tt-shopcart-table-02 .tt-title a,
    .tt-table-shop-01 tbody td a {
        color: {{ $settings->header_tow_theme_color }}              !important;
    }

    @media (max-width: 1024px) {
        .tt-mobile-header {
            background-color: {{ $settings->header_theme_bg }}                    !important;
            padding-bottom: 10px;
        }
    }

    a .url-normal {
        text-decoration: none !important;
        color: {{ $settings->main_text_theme_color }}                    !important;
        text-underline: none !important;
    }

    /*     mobile menu */
    .panel-menu {
        color: {{ $settings->main_theme_color ? $settings->main_theme_color : 'white' }};
        background-color: {{ $settings->main_theme_bg_color ? $settings->main_theme_bg_color : 'white' }};
    }

    .panel-menu li.mm-close-parent .mm-close,
    .panel-menu #mm0.mmpanel a:not(.mm-close), .panel-menu #mm0.mmpanel a:not(.mm-close):after, .panel-menu .mm-original-link,
    .panel-menu ul li a,
    .panel-menu .mm-prev-level {
        color: {{ $settings->main_theme_color ? $settings->main_theme_color : 'white' }};
    }

    .tt-col-icon, .tt-services-block .tt-col-icon {
        color: {{ $settings->icon_theme_color }}               !important;
    }

    .tt-menu-categories .tt-dropdown-menu nav > ul > li.tt-submenu > a:after {
        display: none !important;
    }

    @if(config('app.NASHKW') || config('app.BITS') || ENV('EMAKEUP'))

    body, html, div, a, p, h1, h2, h3, h4, h5, h6, table, row, td, th, tr, thead, tfoot, button, span, .btn, .btn-del, ul, li, .page-content, .portlet, .light, .profile-sidebar-portlet {
        font-family: 'skynews', 'sans-serif' !important;
        /*font-family: 'AlHurra-normal' !important;*/
        /*font-family: 'GE SS Unique', 'sans-serif' !important;*/
        /*text-transform: uppercase !important;*/
    }
    @endif
    .tt-promo-box.tt-one-child .tt-description .tt-description-wrapper {
        padding: 3px 20px 3px !important;
        opacity: 0.4;
    }
    .tt-login-form .tt-item {
        border: none;
    }
    .accordionCustome {
        background-color: #eee;
        color: #444;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        outline: none;
        transition: 0.4s;
        border: 1px solid lightgray;
        margin-top: 10px;
        margin-bottom: 10px;
        text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};
    }

    /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
    .active, .accordionCustome:hover {
        background-color: #f8f9fa;
    }

    /* Style the accordion panel. Note: hidden by default */
    .panel {
        padding: 0 18px;
        background-color: white;
        display: none;
        overflow: hidden;
        border: 0.5px solid lightgray;
        min-height: 50px;
        text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};

    }

    .lightGrayBgRow {
        background-color: #FBFBFB; padding-top : 40px; padding-bottom: 40px;
    }

    .tt-product-single-info .tt-label [class^=tt-label] {
        border-radius: 5px !important;
    }
</style>


