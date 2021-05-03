<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // frontend
        view()->composer([
//            'frontend.partials.header_one',
//            'frontend.partials.header_four',
//            'frontend.partials._pop_up_cart'
        ], 'App\Services\ViewComposers@getCart');

        view()->composer([
            'frontend.*.*.home',
            'frontend.wokiee.four.partials._country_modal',
            'frontend.wokiee.four.partials._search_menu_services',
            'frontend.wokiee.four.partials._search_modal_categories',
            'frontend.wokiee.four.partials._cart_order_user_info',
//            'frontend.wokiee.four.partials._product_show_information_widget',
            'frontend.modules.product.show',
            'frontend.modules.service.show',
            'backend.modules.currency.create',
            'backend.modules.currency.edit',
            'backend.modules.user.create',
            'backend.modules.classified.create',
            'backend.modules.classified.edit',
            'backend.modules.user.edit',
            'backend.partials.sidebar',
            'auth.*',
            'frontend.wokiee.four.modules.user.edit',
            'frontend.wokiee.four.modules.classified.create',
        ], 'App\Services\ViewComposers@getCountries');

        view()->composer([
            'frontend.*.*.*._search_form',
            'frontend.*.*.*._search_menu_services',
            'frontend.*.*.*._search_modal_categories',
        ], 'App\Services\ViewComposers@getAllTimingsAvailable');

        view()->composer([
            'frontend.modules.cart.index',
        ], 'App\Services\ViewComposers@getShipmentPackages');


        view()->composer([
            'frontend.modules.checkout.index',
            'frontend.modules.order.show',
            'auth.register',
        ], 'App\Services\ViewComposers@getCountriesWorld');


        view()->composer([
            'frontend.modules.cart.index',
            'frontend.partials._branches_footer'], 'App\Services\ViewComposers@getBranches');

        view()->composer([
            'frontend.wokiee.four.home.*',
            'frontend.wokiee.four.*.show',
            'frontend.wokiee.four.modules.product.compare',
            'frontend.wokiee.four.partials._service_widget',
            'frontend.wokiee.four.partials._products_slider',
            'frontend.wokiee.four.partials._collection_widget',
//            'frontend.wokiee.four.partials._product_widget_metro',
            'frontend.wokiee.four.partials._cart_items_table',
            'frontend.wokiee.four.partials._cart_prices',
            'frontend.wokiee.four.partials._main_menu_cart_items',
            'frontend.wokiee.four.partials._search_side_bar_prices',
            'frontend.wokiee.four.partials._quick_view_product_btn',
            'frontend.wokiee.four.partials._widget_price_and_color',
            'auth.register',
            'auth.login',
        ], 'App\Services\ViewComposers@getCurrency');


        view()->composer([
            'frontend.wokiee.four.home.*',
            'auth.*',
            'frontend.wokiee.four.modules.*.*',
            'frontend.wokiee.four.modules.product.index',
        ], 'App\Services\ViewComposers@getCurrencies');


        view()->composer([
            'frontend.wokiee.four.layouts.app',
            'frontend.wokiee.four.partials._home_grid_main_categories',
            'frontend.wokiee.four.modules.classified.create',
        ], 'App\Services\ViewComposers@getCategories');

        view()->composer([
            'frontend.wokiee.four.layouts.app',
            'frontend.wokiee.four.layouts.mobile',
            'frontend.wokiee.four.home.mobile',
            'frontend.wokiee.four.modules.product.show',
            'frontend.wokiee.four.modules.service.show',
            'backend.modules.user.create',
            'backend.modules.user.edit',
            'frontend.*.*.partials._search_side_bar',
            'frontend.*.*.partials._btns_home',
            'frontend.*.*.partials._modal_size_chart',
            'frontend.*.*.partials._cart_order_user_info',
            'frontend.*.*.partials._cart_order_user_info_confirmation',
            'emails.order-complete',
            'backend.modules.order.show',
            'backend.layouts.app',
            'errors.503',
            'errors.403',
        ], 'App\Services\ViewComposers@getSettings');

        view()->composer([
            'frontend.wokiee.four.layouts.app',
            'frontend.wokiee.four.home.mobile',
        ], 'App\Services\ViewComposers@getPages');

        view()->composer([
            'frontend.wokiee.four.home.*',
            'frontend.wokiee.four.modules.product.*',
        ], 'App\Services\ViewComposers@getBrands');

        view()->composer([
            'backend.modules.product.attribute.create',
        ], 'App\Services\ViewComposers@getActiveSizes');

        view()->composer([
            'backend.modules.product.attribute.create',
        ], 'App\Services\ViewComposers@getActiveColors');

        view()->composer([
            'backend.home',
            'backend.partials._sidebar_super',
            'backend.partials._sidebar_admin',
        ], 'App\Services\ViewComposers@getRoles');

        view()->composer([
            'auth.register',
        ], 'App\Services\ViewComposers@getActiveVisibleRoles');

        view()->composer([
            'frontend.wokiee.four.partials.footer'], 'App\Services\ViewComposers@getFaqs');


    }

    /**
     * automatically composer() method will be registered
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }
}
