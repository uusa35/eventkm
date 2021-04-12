<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo" style="display: flex; justify-content: center; align-items: center;">
            <a href="{{ route('frontend.home') }}">
                <img src="{{ $settings->getCurrentImageAttribute('logo') }}" alt="logo" class="img-xs logo-default"/>
            </a>
            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse">
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN PAGE ACTIONS -->
        <!-- DOC: Remove "hide" class to enable the page header actions -->
        @can('isCompanyOrAbove')
            <div class="page-actions">
                <div class="btn-group">
                    <button type="button" class="btn btn-circle btn-info dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-plus"></i>&nbsp;
                        <span class="hidden-sm hidden-xs"> {{ trans("general.new") }}&nbsp;</span>&nbsp;
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        @include('backend.partials._nav_add_new_btns_company')
                    </ul>
                </div>
            </div>
        @endcan
        @can('isAdminOrAbove')
            <div class="page-actions">
                <div class="btn-group">
                    <button type="button" class="btn btn-circle btn-success dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-plus"></i>&nbsp;
                        <span class="hidden-sm hidden-xs"> {{ trans("general.new_items_for_admins") }}&nbsp;</span>&nbsp;
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        @include('backend.partials._nav_add_new_btns_super')
                    </ul>
                </div>
            </div>
            @can('index','classified')
                <div class="page-actions">
                    <div class="btn-group">
                        <button type="button" class="btn btn-circle btn-primary dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-plus"></i>&nbsp;
                            <span class="hidden-sm hidden-xs"> {{ trans("general.classifieds_items") }}&nbsp;</span>&nbsp;
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            @include('backend.partials._nav_add_new_btns_super_classifieds')
                        </ul>
                    </div>
                </div>
        @endcan
    @endcan
    <!-- END PAGE ACTIONS -->
        <!-- BEGIN PAGE TOP -->
        <div class="page-top">
            <!-- BEGIN HEADER SEARCH BOX -->
            <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
        {{--<form class="search-form search-form-expanded" action="page_general_search_3.html" method="GET">--}}
        {{--<div class="input-group">--}}
        {{--<input type="text" class="form-control" placeholder="Search..." name="query">--}}
        {{--<span class="input-group-btn">--}}
        {{--<a href="javascript:;" class="btn submit">--}}
        {{--<i class="icon-magnifier"></i>--}}
        {{--</a>--}}
        {{--</span>--}}
        {{--</div>--}}
        {{--</form>--}}
        <!-- END HEADER SEARCH BOX -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                {{--<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">--}}
                {{--<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"--}}
                {{--data-close-others="true">--}}
                {{--<i class="icon-bell"></i>--}}
                {{--<span class="badge badge-default"> {{ $totalActiveClientOnProgressOrders->count() }} </span>--}}
                {{--</a>--}}
                {{--<ul class="dropdown-menu">--}}
                {{--<li class="external">--}}
                {{--<h3>--}}
                {{--<a href="{{ route('backend.admin.order.index',['is_complete' => false]) }}">{{ trans('general.active_paid_on_progress_orders') }}</a>--}}
                {{--</h3>--}}
                {{--</li>--}}
                {{--<li>--}}
                {{--<ul class="dropdown-menu-list scroller" style="height: 250px;"--}}
                {{--data-handle-color="#637283">--}}
                {{--@foreach($totalActiveClientOnProgressOrders as $element)--}}
                {{--<li>--}}
                {{--<a href="{{ route('backend.order.show', $element->id) }}">--}}
                {{--<span class="time">{{ $element->created_at->diffForHumans() }}</span>--}}
                {{--<span class="details">--}}
                {{--<span class="label label-sm label-icon label-success">--}}
                {{--</span> {{ $element->title }} </span>--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--@endforeach--}}
                {{--</ul>--}}
                {{--</li>--}}
                {{--</ul>--}}
                {{--</li>--}}
                {{--<!-- END NOTIFICATION DROPDOWN -->--}}
                {{--<!-- BEGIN INBOX DROPDOWN -->--}}
                {{--<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->--}}
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    {{--<li class="dropdown dropdown-language">--}}
                    {{--<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"--}}
                    {{--data-close-others="true">--}}
                    {{--<img alt="" src="{{ asset('img/flags/'.app()->getLocale().'.png') }}">--}}
                    {{--<span--}}
                    {{--class="langname">&nbsp; {{ trans('general.language') .' : '.app()->getLocale() }} </span>--}}
                    {{--<i class="fa fa-angle-down"></i>--}}
                    {{--</a>--}}
                    {{--<ul class="dropdown-menu">--}}
                    {{--<li>--}}
                    {{--<a href="{{ route('backend.language.change','en') }}">--}}
                    {{--<img alt="" src="{{ asset('img/flags/us.png') }}"> {{ trans('general.english') }}--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="{{ route('backend.language.change','ar') }}">--}}
                    {{--<img alt="" src="{{ asset('img/flags/kw.png') }}"> {{ trans('general.arabic') }}--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    {{--</ul>--}}
                    {{--</li>--}}
                    <li class="dropdown dropdown-language">
                        <div class="dropdown-toggle"
                             data-close-others="true">
                            <span class="langname">
                                <i class="fa fa-fw fa-calendar"></i>&nbsp;
                                {{ trans("general.today_date") .' :  '. Carbon\Carbon::today()->format('D - j F,Y') }} </span>
                        </div>
                    </li>
                    @if(env('ENABLE_LANG_SWITCH'))
                        <li class="dropdown dropdown-language"
                            style="background-color: {{ app()->isLocale('ar') ? 'whitesmoke' : 'transparent' }}; margin-left: 10px; ">
                            <a href="{{ route('backend.language.change','ar') }}" class="dropdown-toggle"
                               data-close-others="true">
                                <img alt="" src="{{ asset('images/flags/ar.png') }}">
                                <span class="langname">
{{--                                <i class="fa fa-fw fa-language"></i>&nbsp; --}}
                                    {{ trans('general.arabic') }} </span>
                            </a>
                        </li>
                        <li class="dropdown dropdown-language"
                            style="background-color: {{ app()->isLocale('en') ? 'whitesmoke' : 'transparent' }}; margin-left: 10px ">
                            <a href="{{ route('backend.language.change','en') }}" class="dropdown-toggle"
                               data-close-others="true">
                                <img alt="" src="{{ asset('images/flags/en.png') }}">
                                <span class="langname">
{{--                                <i class="fa fa-fw fa-language"></i>&nbsp; --}}
                                    {{ trans('general.english') }} </span>
                            </a>
                        </li>
                @endif

                {{--<!-- END INBOX DROPDOWN -->--}}
                {{--<!-- BEGIN TODO DROPDOWN -->--}}
                {{--<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->--}}
                {{--<li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">--}}
                {{--<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"--}}
                {{--data-close-others="true">--}}
                {{--<i class="icon-calendar"></i>--}}
                {{--<span class="badge badge-default"> 3 </span>--}}
                {{--</a>--}}
                {{--<ul class="dropdown-menu extended tasks">--}}
                {{--<li class="external">--}}
                {{--<h3>You have--}}
                {{--<span class="bold">12 pending</span> tasks</h3>--}}
                {{--<a href="app_todo.html">view all</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                {{--<ul class="dropdown-menu-list scroller" style="height: 275px;"--}}
                {{--data-handle-color="#637283">--}}
                {{--<li>--}}
                {{--<a href="javascript:;">--}}
                {{--<span class="task">--}}
                {{--<span class="desc">New release v1.2 </span>--}}
                {{--<span class="percent">30%</span>--}}
                {{--</span>--}}
                {{--<span class="progress">--}}
                {{--<span style="width: 40%;"--}}
                {{--class="progress-bar progress-bar-success"--}}
                {{--aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">--}}
                {{--<span class="sr-only">40% Complete</span>--}}
                {{--</span>--}}
                {{--</span>--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                {{--<a href="javascript:;">--}}
                {{--<span class="task">--}}
                {{--<span class="desc">Application deployment</span>--}}
                {{--<span class="percent">65%</span>--}}
                {{--</span>--}}
                {{--<span class="progress">--}}
                {{--<span style="width: 65%;"--}}
                {{--class="progress-bar progress-bar-danger"--}}
                {{--aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">--}}
                {{--<span class="sr-only">65% Complete</span>--}}
                {{--</span>--}}
                {{--</span>--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                {{--<a href="javascript:;">--}}
                {{--<span class="task">--}}
                {{--<span class="desc">Mobile app release</span>--}}
                {{--<span class="percent">98%</span>--}}
                {{--</span>--}}
                {{--<span class="progress">--}}
                {{--<span style="width: 98%;"--}}
                {{--class="progress-bar progress-bar-success"--}}
                {{--aria-valuenow="98" aria-valuemin="0" aria-valuemax="100">--}}
                {{--<span class="sr-only">98% Complete</span>--}}
                {{--</span>--}}
                {{--</span>--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                {{--<a href="javascript:;">--}}
                {{--<span class="task">--}}
                {{--<span class="desc">Database migration</span>--}}
                {{--<span class="percent">10%</span>--}}
                {{--</span>--}}
                {{--<span class="progress">--}}
                {{--<span style="width: 10%;"--}}
                {{--class="progress-bar progress-bar-warning"--}}
                {{--aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">--}}
                {{--<span class="sr-only">10% Complete</span>--}}
                {{--</span>--}}
                {{--</span>--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                {{--<a href="javascript:;">--}}
                {{--<span class="task">--}}
                {{--<span class="desc">Web server upgrade</span>--}}
                {{--<span class="percent">58%</span>--}}
                {{--</span>--}}
                {{--<span class="progress">--}}
                {{--<span style="width: 58%;" class="progress-bar progress-bar-info"--}}
                {{--aria-valuenow="58" aria-valuemin="0" aria-valuemax="100">--}}
                {{--<span class="sr-only">58% Complete</span>--}}
                {{--</span>--}}
                {{--</span>--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                {{--<a href="javascript:;">--}}
                {{--<span class="task">--}}
                {{--<span class="desc">Mobile development</span>--}}
                {{--<span class="percent">85%</span>--}}
                {{--</span>--}}
                {{--<span class="progress">--}}
                {{--<span style="width: 85%;"--}}
                {{--class="progress-bar progress-bar-success"--}}
                {{--aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">--}}
                {{--<span class="sr-only">85% Complete</span>--}}
                {{--</span>--}}
                {{--</span>--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                {{--<a href="javascript:;">--}}
                {{--<span class="task">--}}
                {{--<span class="desc">New UI release</span>--}}
                {{--<span class="percent">38%</span>--}}
                {{--</span>--}}
                {{--<span class="progress progress-striped">--}}
                {{--<span style="width: 38%;"--}}
                {{--class="progress-bar progress-bar-important"--}}
                {{--aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">--}}
                {{--<span class="sr-only">38% Complete</span>--}}
                {{--</span>--}}
                {{--</span>--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--</ul>--}}
                {{--</li>--}}
                {{--</ul>--}}
                {{--</li>--}}
                <!-- END TODO DROPDOWN -->
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">
                            <img alt="" class="img-xs logo-default"
                                 src="{{ auth()->user()->getCurrentImageAttribute() }}"/>
                            <i class="fa fa-angle-down"></i>
                            <span class="username username-hide-on-mobile"> {{ str_limit(auth()->user()->name,30) }}</span><br>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="#">
                                    <span class="username username-hide-on-mobile"><i
                                                class="fa fa-fw fa-university"></i>{{ trans('general.role') }}
                                        : {{ auth()->user()->role->name }} : </span>
                                    <span class="username username-hide-on-mobile"> {{ str_limit(auth()->user()->name,5) }}</span><br>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('frontend.home') }}">
                                    <i class="icon-home"></i>{{ trans('general.home') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('backend.index') }}">
                                    <i class="icon-pencil"></i>{{ trans('general.dashboard') }}</a>
                            </li>
                            @if(env('ENABLE_LANG_SWITCH'))
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ route('backend.language.change',app()->isLocale('ar') ? 'en' : 'ar') }}">
                                        <i class="fa fa-fw fa-language"></i>{{ trans('general.switch_lang')  }}
                                    </a>
                                </li>
                            @endif
                            <li class="divider"></li>
                            @can('isAdminOrAbove')
                                @can('index','setting')
                                    <li>
                                        <a href="{{ route('backend.admin.setting.index') }}">
                                            <i class="icon-settings"></i> {{ trans('general.app_settings') }} </a>
                                    </li>
                                @endcan
                                <li>
                                    <a href="{{ url('backend/admin/translations') }}">
                                        <i class="fa fa-fw fa-language"></i> {{ trans('general.translation_manager') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('backend.admin.export.translation') }}">
                                        <i class="icon-envelope-letter"></i> {{ trans('general.export_translations') }}
                                    </a>
                                </li>
                                @can('isSuper')
                                    <li>
                                        <a href="{{ url('backend/admin/env') }}">
                                            <i class="fa fa-fw fa-bug"></i> {{ trans('general.edit_env_file') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('backend/admin/telescope') }}">
                                            <i class="fa fa-fw fa-bug"></i> Telescope Debug Mode
                                        </a>
                                    </li>
                                @endcan
                                <li class="divider"></li>
                            @endcan
                            @if(auth()->user())
                                <li>
                                    <a href="{{ route('backend.reset.password',['email' => auth()->user()->email]) }}">
                                        <i class="fa fa-fw fa-edit"></i> {{ trans('general.reset_password') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('backend.user.edit',auth()->id()) }}">
                                        <i class="fa fa-fw fa-edit"></i> {{ trans('general.edit_my_profile') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('backend.user.show',auth()->id()) }}">
                                        <i class="fa fa-fw fa-user-circle"></i> {{ trans('general.profile') }}
                                    </a>
                                </li>
                                {{--                                <li>--}}
                                {{--                                    <a href="{{ route('backend.user.show',auth()->id()) }}">--}}
                                {{--                                        <i class="fa fa-fw fa-user-circle"></i> {{ trans('general.my_profile') }}</a>--}}
                                {{--                                </li>--}}
                            @endif
                            @if(env('SHOW_LOG_ACTIVITY') || auth()->user()->isSuper)
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ route('backend.admin.activity.index') }}">
                                        <i class="icon-new"></i> {{ trans('general.activities') }} </a>
                                </li>
                            @endif
                            <li class="divider"></li>
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="icon-key"></i> {{ trans('general.logout') }} </a>
                            </li>
                        </ul>
                    </li>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

                    <li class="dropdown dropdown-user">
                        <a href="{{ url('/logout') }}" class="dropdown-toggle"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="icon-logout"></i>
                        </a>
                    </li>
                    <!-- END QUICK SIDEBAR TOGGLER -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>
