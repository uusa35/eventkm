@auth
    <div class="tt-desctop-parent-account tt-parent-box">
        <div class="tt-account tt-dropdown-obj">
            <button class="tt-dropdown-toggle" data-tooltip="{{ trans('general.account') }}" data-tposition="bottom"><i
                        class="icon-f-94"></i></button>
            <div class="tt-dropdown-menu">
                <div class="tt-mobile-add">
                    <button class="tt-close">{{ trans('general.close') }}</button>
                </div>
                <div class="tt-dropdown-inner">
                    <ul>
                        <li><a href="{{ route('frontend.order.index') }}">
                                <i class="icon-f-94 fa fa-fw fa-lg"></i>
                                {{ trans('general.hello') }} {{ auth()->user()->name }}
                            </a>
                        </li>
                        @if(env('MALLR') && auth()->user()->isClient)
                            <li><a href="#">
                                    <i class="icon-f-90 fa fa-fw fa-lg"></i>
                                    {{ trans('general.your_balance') }} {{ auth()->user()->balance }} {{ trans('general.points') }}
                                </a>
                            </li>
                        @endif
                        {{--                        @if(env('HOMEKEY') && auth()->user()->isClient)--}}
                        @if(env('HOMEKEY'))
                            <li><a href="{{ route('frontend.classified.choose') }}">
                                    <i class="icon-f-81 fa fa-fw fa-lg"></i>
                                    {{ trans('general.create_classified') }}
                                </a>
                            </li>
                        @endif
                        @if(!auth()->user()->is_client)
                            <li><a href="{{ route('backend.home') }}">
                                    <i class="icon-f-81 fa fa-fw fa-lg"></i>
                                    {{ trans('general.control_panel') }}
                                </a>
                            </li>
                        @endif
                        <li><a href="{{ route('frontend.user.edit', auth()->id()) }}">
                                <i class="icon-f-81 fa fa-fw fa-lg"></i>
                                {{ trans('general.personal_information') }}
                            </a>
                        </li>
                        <li><a href="{{ route('frontend.order.index') }}">
                                <i class="icon-f-45 fa fa-fw fa-lg"></i>
                                {{ trans('general.history_orders') }}
                            </a>
                        </li>
                        @if(env('ENABLE_FAV'))
                            <li><a href="{{ route('frontend.favorite.index') }}">
                                    <i class="icon-h-13 fa fa-fw fa-lg"></i>
                                    {{ trans('general.wish_list') }}
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ url('/logout') }}" class="dropdown-toggle"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="icon-h-24 fa fa-fw fa-lg"></i>
                                {{ trans('general.sign_out') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endauth
