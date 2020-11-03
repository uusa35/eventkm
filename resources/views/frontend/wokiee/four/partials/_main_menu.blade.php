<div class="tt-desktop-header headerunderline">
    <div class="container">
        @if(env('MALLR') || env('HTB') || env('BITS') || env('NASHKW') || env('EMAKEUP') || env('HUDA'))
            @include('frontend.wokiee.four.partials.header_logo_section_align')
        @else
            @include('frontend.wokiee.four.partials.header_logo_section_center')
        @endif
    </div>


    <div class="container small-header">
        <div class="tt-header-holder">
            @include('frontend.wokiee.four.partials._main_menu_categories')
            <div class="tt-col-obj tt-obj-menu">
                <!-- tt-menu -->
                <div class="tt-desctop-parent-menu tt-parent-box">
                    <div class="tt-desctop-menu">
                        <nav>
                            <ul>
                                <li class="dropdown tt-megamenu-col-02 selected">
                                    <a href="{{ route('frontend.home') }}">{{ trans('general.home_page') }}</a>
                                </li>
                                @include('frontend.wokiee.four.partials._categories_main_menu_element_with_images')
                                @include('frontend.wokiee.four.partials._pages_main_menu')
                                @if(env('ENABLE_BLOG'))
                                    <li class="dropdown tt-megamenu-col-02 selected">
                                        <a href="{{ route('frontend.post.index') }}">{{ trans('general.blog') }}</a>
                                    </li>
                                @endif
                                @if(env('ENABLE_LANG_SWITCH'))
                                    <li class="dropdown">
                                        @if(app()->getLocale() === 'ar')
                                            <a href="{{ route('frontend.language.change',['locale' => 'en']) }}">{{ trans('general.english') }}</a>
                                        @else
                                            <a href="{{ route('frontend.language.change',['locale' => 'ar']) }}">{{ trans('general.arabic') }}</a>
                                        @endif
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /tt-menu -->
            </div>
            <div class="tt-col-obj tt-obj-options obj-move-right">
                <!-- tt-search -->
                <div class="tt-desctop-parent-search tt-parent-box tt-obj-desktop-hidden">
                    <div class="tt-search tt-dropdown-obj">
                        <button class="tt-dropdown-toggle" data-tooltip="{{ trans('general.search') }}"
                                data-tposition="bottom">
                            <i class="icon-f-85"></i>
                        </button>
                        <div class="tt-dropdown-menu">
                            <div class="container">
                                <form>
                                    <div class="tt-col">
                                        <input type="text" class="tt-search-input"
                                               placeholder="{{ trans('general.search') }}">
                                        <button class="tt-btn-search" type="submit"></button>
                                    </div>
                                    <div class="tt-col">
                                        <button class="tt-btn-close icon-g-80"></button>
                                    </div>
                                    <div class="tt-info-text">
                                        {{ trans('message.what_are_you_looking_for') }}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /tt-search -->
                <!-- tt-cart -->
                <div class="tt-desctop-parent-cart tt-parent-box">
                    <div class="tt-cart tt-dropdown-obj" data-tooltip="{{ trans('general.cart') }}"
                         data-tposition="bottom">
                        <button class="tt-dropdown-toggle">
                            <i class="icon-f-39"></i>
                            <span class="tt-badge-cart">
                                @if(Cart::instance('shopping')->content()->where('options.type', 'country')->first())
                                    {{ Cart::instance('shopping')->count() - 1 }}
                                @else
                                    {{ Cart::instance('shopping')->count() }}
                                @endif
                            </span>
                        </button>
                        <div class="tt-dropdown-menu">
                            <div class="tt-mobile-add">
                                <h6 class="tt-title">{{ trans('general.shopping_cart') }}</h6>
                                <button class="tt-close">{{ trans('general.close') }}</button>
                            </div>
                            <div class="tt-dropdown-inner">
                                <div class="tt-cart-layout">
                                @if(Cart::instance('shopping')->count() > 0)
                                    @include('frontend.wokiee.four.partials._main_menu_cart_items')
                                @else
                                    <!-- layout emty cart -->
                                        <a href="#" class="tt-cart-empty">
                                            <i class="icon-f-39"></i>
                                            <p>{{ trans('general.no_items_in_cart') }}</p>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /tt-cart -->
                <!-- tt-account -->
            @include('frontend.wokiee.four.partials._menu_user_account')
            <!-- /tt-account -->
                <!-- tt-langue and tt-currency -->
            @include('frontend.wokiee.four.partials._menu_currency_lang')
            <!-- /tt-langue and tt-currency -->
                {{--                comparision --}}
                @if(env('COMPARE_PRODUCT'))
                    <div class=" tt-parent-box">
                        <div class="tt-dropdown-obj" data-tposition="bottom">
                            <a class="button tt-dropdown-toggle" href="{{ route('frontend.product.compare') }}"
                               data-tooltip="{{ trans('general.compare_products') }}" data-tposition="bottom">
                                <i class="icon-n-08"></i>
                                <span class="tt-badge">
                                {{ session()->has('comparison') ? session()->get('comparision')->count() : ''}}
                            </span>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
