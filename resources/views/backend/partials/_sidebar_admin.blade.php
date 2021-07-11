@can('index','product')
    <li class="nav-item {{ activeItem('product') }}">
        <a href="{{ route('backend.product.index')}}" class="nav-link nav-toggle">
            <i class="fa fa-fw fa-product-hunt"></i>
            <span class="title">{{ trans('general.products') }}</span>
            <span class="selected"></span>
            <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item ">
                <a href="{{ route('backend.product.index') }}" class="nav-link ">
                    <i class="fa fa-fw fa-product-hunt"></i>
                    <span class="title">{{ trans('general.all_products') }}</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('backend.product.index',['type' => 'active']) }}" class="nav-link ">
                    <i class="fa fa-fw fa-product-hunt"></i>
                    <span class="title">{{ trans('general.active_products') }}</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('backend.product.index',['type' => 'on_sale']) }}" class="nav-link ">
                    <i class="fa fa-fw fa-percent"></i>
                    <span class="title">{{ trans('general.on_sale_products') }}</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('backend.product.create') }}" class="nav-link ">
                    <i class="fa fa-fw fa-plus-square"></i>
                    <span class="title">{{ trans('general.new_product') }}</span>
                    <span class="arrow"></span>
                </a>
            </li>
            @can('index','collection')
                <li class="nav-item ">
                    <a href="{{ route('backend.collection.index') }}" class="nav-link ">
                        <i class="fa fa-fw fa-product-hunt"></i>
                        <span class="title">{{ trans('general.product_collections') }}</span>
                        <span class="arrow"></span>
                    </a>
                </li>
            @endcan
            @can('index','video')
                <li class="nav-item ">
                    <a href="{{ route('backend.video.index') }}" class="nav-link ">
                        <i class="fa fa-fw fa-product-hunt"></i>
                        <span class="title">{{ trans('general.videos') }}</span>
                        <span class="arrow"></span>
                    </a>
                </li>
            @endcan
            {{--<li class="nav-item ">--}}
            {{--<a href="{{ route('backend.admin.product.trashed') }}" class="nav-link ">--}}
            {{--<i class="fa fa-fw fa-recycle"></i>--}}
            {{--<span class="title">Trashed</span>--}}
            {{--<span class="arrow"></span>--}}
            {{--</a>--}}
            {{--</li>--}}

        </ul>
    </li>
@endcan

@can('index','service')
    <li class="nav-item {{ activeItem('service') }}">
        <a href="{{ route('backend.service.index') }}" class="nav-link nav-toggle">
            <i class="fa fa-fw fa-table"></i>
            <span class="title">{{ trans('general.services') }}</span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ activeItem('timing',['day']) }}">
        <a href="#" class="nav-link nav-toggle">
            <i class="fa fa-fw fa-clock-o"></i>
            <span class="title">{{ trans('general.timings') }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item {{ activeItem('timing') }}">
                <a href="{{ route('backend.timing.index') }}" class="nav-link nav-toggle">
                    <i class="fa fa-fw fa-clock-o"></i>
                    <span class="title">{{ trans('general.service_timings') }}</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item {{ activeItem('day') }}">
                <a href="{{ route('backend.admin.day.index') }}" class="nav-link nav-toggle">
                    <i class="fa fa-fw fa-calendar"></i>
                    <span class="title">{{ trans('general.days') }}</span>
                    <span class="arrow"></span>
                </a>
            </li>
        </ul>
    </li>
    @can('index','addon')
        <li class="nav-item {{ activeItem('addon') }}">
            <a href="{{ route('backend.admin.addon.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-fw fa-table"></i>
                <span class="title">{{ trans('general.list') .' '. trans('general.addons')}}</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ activeItem('addon') }}">
                    <a href="{{ route('backend.admin.addon.create') }}" class="nav-link nav-toggle">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="title">{{ trans('general.create') .' '. trans('general.addon')}}</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item {{ activeItem('addon') }}">
                    <a href="{{ route('backend.admin.addon.trashed') }}" class="nav-link nav-toggle">
                        <i class="fa fa-fw fa-table"></i>
                        <span
                            class="title">{{ trans('general.trashed') .' '. trans('general.addons') .' '. trans('general.services') }}</span>
                        <span class="arrow"></span>
                    </a>
                </li>
            </ul>
        </li>
    @endcan
    @can('index','item')
        <li class="nav-item {{ activeItem('item') }}">
            <a href="{{ route('backend.admin.item.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-fw fa-table"></i>
                <span
                    class="title">{{ trans('general.list') .' '. trans('general.items') .' '. trans('general.services')}}</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ activeItem('item') }}">
                    <a href="{{ route('backend.admin.item.create') }}" class="nav-link nav-toggle">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="title">{{ trans('general.create') .' '. trans('general.item') }}</span>
                        <span class="arrow"></span>
                    </a>
                <li class="nav-item {{ activeItem('item') }}">
                    <a href="{{ route('backend.admin.item.trashed') }}" class="nav-link nav-toggle">
                        <i class="fa fa-fw fa-table"></i>
                        <span
                            class="title">{{ trans('general.trashed') .' '. trans('general.items') .' '. trans('general.services') }}</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                </li>
            </ul>
        </li>
    @endcan
@endcan
@can('index','classified')
    <li class="nav-item {{ activeItem('classified') }}">
        <a href="{{ route('backend.classified.index')}}" class="nav-link nav-toggle">
            <i class="fa fa-fw fa-gift"></i>
            <span class="title">{{ trans('general.classifieds') }}</span>
            <span class="selected"></span>
            <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item {{ activeItem('classified') }}">
                <a href="{{ route('backend.classified.index') }}" class="nav-link ">
                    <i class="fa fa-fw fa-gift"></i>
                    <span class="title">{{ trans('general.classifieds') }}</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item {{ activeItem('classified') }}">
                <a href="{{ route('backend.classified.trashed') }}" class="nav-link nav-toggle">
                    <i class="fa fa-fw fa-gift"></i>
                    <span class="title">{{ trans('general.trashed') }}</span>
                    <span class="arrow"></span>
                </a>
            </li>
        </ul>
    </li>
@endcan
@can('index','user')
    <li class="nav-item {{ activeItem('user') }}">
        <a href="{{ route('backend.admin.user.index')}}" class="nav-link nav-toggle">
            <i class="fa fa-fw fa-user"></i>
            <span class="title">{{ trans('general.users') }}</span>
            <span class="selected"></span>
            <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
            @foreach($roles->where('active', true)->where('is_super', false)->where('is_admin', false) as $role)
                <li class="nav-item {{ activeItem('user') }}">
                    <a href="{{ route('backend.admin.user.index',['role_id' => $role->id]) }}"
                       class="nav-link nav-toggle">
                        <i class="fa fa-fw fa-users"></i>
                        <span class="title">{{ $role->slug }}</span>
                        <span class="arrow"></span>
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
@endcan

{{--Settings--}}
@can('index','setting')
    <li class="nav-item {{ activeItem('setting', ['policy','term','faq','page','contactus', 'comment','aboutus','gallery','image','color','size','tag','day','role','privilege','brand','branch','slide','video']) }}">
        @can('index','setting')
            <a href="{{ route('backend.admin.setting.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-fw fa-cogs"></i>
                <span class="title">{{ trans('general.app_settings') }}</span>
                <span class="arrow"></span>
            </a>
        @else
            <a href="#" class="nav-link nav-toggle">
                <i class="fa fa-fw fa-cogs"></i>
                <span class="title">{{ trans('general.app_settings') }}</span>
                <span class="arrow"></span>
            </a>
        @endcan
        <ul class="sub-menu">
            @can('index','video')
                <li class="nav-item ">
                    <a href="{{ route('backend.video.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-fw fa-mobile"></i>
                        <span class="title">{{ trans('general.videos') }}</span>
                        <span class="arrow"></span>
                    </a>
                </li>
            @endcan
            {{--            @can('index','policy')--}}
            {{--                <li class="nav-item {{ activeItem('policy') }}">--}}
            {{--                    <a href="{{ route('backend.admin.policy.index') }}" class="nav-link nav-toggle">--}}
            {{--                        <i class="fa fa-fw fa-certificate"></i>--}}
            {{--                        <span class="title">{{ trans('general.polices') }}</span>--}}
            {{--                        <span class="arrow"></span>--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endcan--}}
            {{--            @can('index','term')--}}
            {{--                <li class="nav-item {{ activeItem('term') }}">--}}
            {{--                    <a href="{{ route('backend.admin.term.index') }}" class="nav-link nav-toggle">--}}
            {{--                        <i class="fa fa-fw fa-info-circle"></i>--}}
            {{--                        <span class="title">{{ trans('general.terms') }}</span>--}}
            {{--                        <span class="arrow"></span>--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endcan--}}
            @can('index','tag')
                <li class="nav-item {{ activeItem('tag') }}">
                    <a href="{{ route('backend.tag.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-fw fa-tags"></i>
                        <span class="title">{{ trans('general.tags') }}</span>
                        <span class="arrow"></span>
                    </a>
                </li>
            @endcan
            @can('index','color')
                <li class="nav-item {{ activeItem('color') }}">
                    <a href="{{ route('backend.admin.color.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-fw fa-list-alt"></i>
                        <span class="title">{{ trans('general.colors_or_heights') }}</span>
                        <span class="arrow"></span>
                    </a>
                </li>
            @endcan
            @can('index','size')
                <li class="nav-item {{ activeItem('size') }}">
                    <a href="{{ route('backend.admin.size.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-fw fa-list-ul"></i>
                        <span class="title">{{ trans('general.sizes') }}</span>
                        <span class="arrow"></span>
                    </a>
                </li>
            @endcan
            @can('index','setting')
                <li class="nav-item {{ activeItem('setting') }}">
                    <a href="{{ route('backend.admin.setting.index') }}" class="nav-link ">
                        <i class="fa fa-fw fa-edit"></i>
                        <span class="title">{{ trans('general.edit_app_settings') }}</span>
                        <span class="arrow"></span>
                    </a>
                </li>
            @endcan
            @can('index','slide')
                <li class="nav-item {{ activeItem('slide') }}">
                    <a href="{{ route('backend.slide.index',['slidable_id' => auth()->id(), 'slidable_type' => 'user']) }}">
                        <i class="fa fa-fw fa-file-image-o"></i>
                        <span class="title">{{ trans('general.slides') }}</span>
                        <span class="arrow"></span>
                    </a>
                </li>
            @endcan
            @can('index','package')
                <li class="nav-item ">
                    <a href="{{ route('backend.package.index') }}" class="nav-link ">
                        <i class="fa fa-fw fa-file-image-o"></i>
                        <span class="title">{{ trans('general.packages') }}</span>
                        <span class="arrow"></span>
                    </a>
                </li>
            @endcan
            @can('index','newsletter')
                <li class="nav-item {{ activeItem('newsletter') }}">
                    <a href="{{ route('backend.admin.newsletter.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-fw fa-newspaper-o"></i>
                        <span class="title">{{ trans('general.newsletters') }}</span>
                        <span class="arrow"></span>
                    </a>
                </li>
            @endcan
            @can('index','branch')
                <li class="nav-item {{ activeItem('branch') }}">
                    <a href="{{ route('backend.branch.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-fw fa-building-o"></i>
                        <span class="title">{{ trans('general.branches') }}</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item ">
                            <a href="{{ route('backend.branch.index') }}" class="nav-link ">
                                <i class="fa fa-fw fa-building-o"></i>
                                <span class="title">{{ trans('general.branches') }}</span>
                                <span class="arrow"></span>
                            </a>
                        </li>

                    </ul>
                </li>
            @endcan
            @can('index','brand')
                <li class="nav-item {{ activeItem('brand') }}">
                    <a href="{{ route('backend.admin.brand.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-fw fa-shopping-bag"></i>
                        <span class="title">{{ trans('general.brands') }}</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item ">
                            <a href="{{ route('backend.admin.brand.index') }}" class="nav-link nav-toggle">
                                <i class="fa fa-fw fa-shopping-bag"></i>
                                <span class="title">{{ trans('general.brands') }}</span>
                                <span class="arrow"></span>
                            </a>
                        </li>

                    </ul>
                </li>
            @endcan

            @can('index','faq')
                <li class="nav-item {{ activeItem('faq') }}">
                    <a href="{{ route('backend.admin.faq.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-fw fa-question-circle"></i>
                        <span class="title">{{ trans('general.faqs') }}</span>
                        <span class="arrow"></span>
                    </a>
                </li>
            @endcan
            @can('index','commercial')
                <li class="nav-item {{ activeItem('commercial') }}">
                    <a href="{{ route('backend.admin.commercial.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-fw fa-address-card-o "></i>
                        <span class="title">{{ trans('general.commercials') }}</span>
                        <span class="arrow"></span>
                    </a>
                </li>
            @endcan
            @can('index','comment')
                <li class="nav-item {{ activeItem('comment') }}">
                    <a href="{{ route('backend.admin.comment.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-fw fa-comment-o"></i>
                        <span class="title">{{ trans('general.comments') }}</span>
                        <span class="arrow"></span>
                    </a>
                </li>
            @endcan
            @can('index','notification')
                <li class="nav-item {{ activeItem('notification') }}">
                    <a href="{{ route('backend.admin.notification.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-fw fa-bell"></i>
                        <span class="title">{{ trans('general.notifications') }}</span>
                        <span class="arrow"></span>
                    </a>
                </li>
            @endcan
            @can('index','page')
                <li class="nav-item ">
                    <a href="{{ route('backend.admin.page.index') }}" class="nav-link ">
                        <i class="fa fa-fw fa-book"></i>
                        <span class="title">{{ trans('general.pages') }}</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('backend.admin.page.index') }}" class="nav-link">
                                <i class="fa fa-fw fa-list-alt"></i> {{ trans('general.pages') }}
                                <span class="arrow nav-toggle"></span>
                            </a>
                        </li>

                    </ul>
                </li>
            @endcan
            @can('index','post')
                <li class="nav-item ">
                    <a href="{{ route('backend.post.index') }}" class="nav-link ">
                        <i class="fa fa-fw fa-book"></i>
                        <span class="title">{{ trans('general.posts') }}</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('backend.post.index') }}" class="nav-link">
                                <i class="fa fa-fw fa-list-alt"></i> {{ trans('general.posts') }}
                                <span class="arrow nav-toggle"></span>
                            </a>
                        </li>

                    </ul>
                </li>
            @endcan
        </ul>
    </li>
@endcan
@can('index','category')
    <li class="nav-item {{ activeItem('category') }}">
        <a href="{{ route('backend.admin.category.index') }}" class="nav-link nav-toggle">
            <i class="fa fa-fw fa-list-ol"></i>
            <span class="title">{{ trans('general.categories') }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @can('index','classified')

                <li class="nav-item {{ activeItem('group') }}">
                    <a href="{{ route('backend.admin.group.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-fw fa-shopping-bag"></i>
                        <span class="title">{{ trans('general.category_group') }}</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item {{ activeItem('property') }}">
                    <a href="{{ route('backend.admin.property.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-fw fa-shopping-bag"></i>
                        <span class="title">{{ trans('general.properties') }}</span>
                        <span class="arrow"></span>
                    </a>
                </li>
            @endcan
            <li class="nav-item {{ activeItem('category') }}">
                <a href="{{ route('backend.admin.category.trashed') }}" class="nav-link nav-toggle">
                    <i class="fa fa-fw fa-shopping-bag"></i>
                    <span class="title">{{ trans('general.trashed') }}</span>
                    <span class="arrow"></span>
                </a>
            </li>
        </ul>
    </li>
@endcan
@can('index','country')
    <li class="nav-item {{ activeItem('country') }}">
        <a href="{{ route('backend.admin.country.index') }}" class="nav-link nav-toggle">
            <i class="fa fa-fw fa-globe"></i>
            <span class="title">{{ trans('general.countries') }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item ">
                <a href="{{ route('backend.admin.country.index') }}" class="nav-link nav-toggle">
                    <i class="fa fa-fw fa-globe"></i>
                    <span class="title">{{ trans('general.countries_control') }}</span>
                    <span class="arrow"></span>
                </a>
                {{--<ul class="sub-menu always-open"> --}}
                {{--@foreach($countries as $country)--}}
                {{--<li class="nav-item">--}}
                {{--<a href="{{ route('backend.country.show',$country->id) }}" class="nav-link ">--}}
                {{--{{ $country->name }}</a>--}}
                {{--</li>--}}
                {{--@endforeach--}}
                {{--</ul>--}}
            </li>

            <li class="nav-item {{ activeItem('governate') }}">
                <a href="{{ route('backend.admin.governate.index') }}" class="nav-link nav-toggle">
                    <i class="fa fa-fw fa-shopping-bag"></i>
                    <span class="title">{{ trans('general.governates') }}</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item {{ activeItem('area') }}">
                <a href="{{ route('backend.admin.area.index') }}" class="nav-link nav-toggle">
                    <i class="fa fa-fw fa-shopping-bag"></i>
                    <span class="title">{{ trans('general.areas') }}</span>
                    <span class="arrow"></span>
                </a>
            </li>
        </ul>
    </li>
@endcan

@can('index','currency')
    <li class="nav-item {{ activeItem('currency') }}">
        <a href="{{ route('backend.admin.currency.index') }}" class="nav-link nav-toggle">
            <i class="fa fa-fw fa-dollar"></i>
            <span class="title">{{ trans('general.currencies') }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item ">
                <a href="{{ route('backend.admin.currency.index') }}" class="nav-link nav-toggle">
                    <i class="fa fa-fw fa-euro"></i>
                    <span class="title"> {{ trans('general.currencies') }}</span>
                    <span class="arrow"></span>
                </a>
            </li>

        </ul>
    </li>
@endcan

@can('index','coupon')
    <li class="nav-item {{ activeItem('coupon') }}">
        <a href="{{ route('backend.admin.coupon.index') }}" class="nav-link nav-toggle">
            <i class="fa fa-fw fa-credit-card"></i>
            <span class="title">{{ trans('general.coupons') }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item ">
                <a href="{{ route('backend.admin.coupon.index') }}" class="nav-link nav-toggle">
                    <i class="fa fa-fw fa-cc-discover"></i>
                    <span class="title">{{ trans('general.coupons') }}</span>
                    <span class="arrow"></span>
                </a>
            </li>

        </ul>
    </li>
@endcan

@can('index','order')
    <li class="nav-item {{ activeItem('order') }}">
        <a href="{{ route('backend.admin.order.index',['paid' => true]) }}" class="nav-link nav-toggle">
            <i class="fa fa-fw fa-money"></i>
            <span class="title">{{ trans('general.orders') }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item ">
                <a href="{{ route('backend.admin.order.index') }}" class="nav-link nav-toggle">
                    <i class="fa fa-fw fa-pie-chart"></i>
                    <span class="title">{{ trans('general.all') }} {{ trans('general.orders') }}</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('backend.admin.order.search',['paid' => true]) }}" class="nav-link nav-toggle">
                    <i class="fa fa-fw fa-money"></i>
                    <span class="title">{{ trans('general.paid_orders') }}</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item ">
                        <a href="{{ route('backend.admin.order.search',['cash_on_delivery' => true]) }}"
                           class="nav-link nav-toggle">
                            <i class="fa fa-fw fa-pie-chart"></i>
                            <span class="title">{{ trans('general.cash_on_delivery') }}</span>
                            <span class="arrow"></span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{ route('backend.admin.order.search',['paid' => true, 'payment_method' => true]) }}"
                           class="nav-link nav-toggle">
                            <i class="fa fa-fw fa-pie-chart"></i>
                            <span class="title">{{ trans('general.paid_online') }}</span>
                            <span class="arrow"></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item ">
                <a href="{{ route('backend.admin.order.index',['status' => 'completed']) }}"
                   class="nav-link nav-toggle">
                    <i class="fa fa-fw fa-pie-chart"></i>
                    <span class="title">{{ trans('general.completed_orders') }}</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('backend.admin.order.index',['status' => 'failed']) }}" class="nav-link nav-toggle">
                    <i class="fa fa-fw fa-pie-chart"></i>
                    <span class="title">{{ trans('general.failed_orders') }}</span>
                    <span class="arrow"></span>
                </a>
            </li>
        </ul>
    </li>
@endcan
@can('index','survey')
    <li class="nav-item {{ activeItem('question',['survey','answer']) }}">
        <a href="{{ route('backend.admin.survey.index') }}" class="nav-link nav-toggle">
            <i class="fa fa-fw fa-th-list"></i>
            <span class="title">{{ trans('general.surveys') }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item ">
                <a href="{{ route('backend.admin.survey.index') }}" class="nav-link nav-toggle">
                    <i class="fa fa-fw fa-list-ul"></i>
                    <span class="title">{{ trans('general.surveys') }}</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('backend.admin.question.index') }}" class="nav-link nav-toggle">
                    <i class="fa fa-fw fa-list-ul"></i>
                    <span class="title">{{ trans('general.questions_list') }}</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('backend.admin.answer.index') }}" class="nav-link nav-toggle">
                    <i class="fa fa-fw fa-magic"></i>
                    <span class="title">{{ trans('general.answers_list') }}</span>
                    <span class="arrow"></span>
                </a>
            </li>

            {{--<li class="nav-item ">--}}
            {{--<a href="{{ route('backend.admin.survey.create') }}" class="nav-link nav-toggle">--}}
            {{--<i class="fa fa-fw fa-question-circle-o"></i>--}}
            {{--<span class="title">Create New Question</span>--}}
            {{--<span class="arrow"></span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item ">--}}
            {{--<a href="{{ route('backend.answer.create') }}" class="nav-link nav-toggle">--}}
            {{--<i class="fa fa-fw fa-question-circle"></i>--}}
            {{--<span class="title">Create New Answer</span>--}}
            {{--<span class="arrow"></span>--}}
            {{--</a>--}}
            {{--</li>--}}
        </ul>
    </li>
@endcan

@can('index','questionnaire')
    <li class="nav-item {{ activeItem('questionnaire') }}">
        <a href="{{ route('backend.admin.questionnaire.index') }}" class="nav-link nav-toggle">
            <i class="fa fa-fw fa-file-text-o"></i>
            <span class="title">{{ trans('general.questionnaires') }}</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item ">
                <a href="{{ route('backend.admin.questionnaire.index') }}" class="nav-link nav-toggle">
                    <i class="fa fa-fw fa-list-ul"></i>
                    <span class="title">{{ trans('general.questionnaires') }}</span>
                    <span class="arrow"></span>
                </a>
            </li>

        </ul>
    </li>
@endcan


@can('index','slide')
    <li class="nav-item {{ activeItem('slide') }}">
        <a href="{{ route('backend.slide.index',['slidable_id' => auth()->id(), 'slidable_type' => 'user']) }}">
            <i class="fa fa-fw fa-address-book-o"></i>
            <span class="title">{{ trans('general.slides') }}</span>
            <span class="arrow"></span>
        </a>
    </li>
@endcan
@can('index','video')
    <li class="nav-item {{ activeItem('video') }}">
        <a href="{{ route('backend.video.index') }}" class="nav-link ">
            <i class="fa fa-fw fa-play-circle-o"></i>
            <span class="title">{{ trans('general.videos') }}</span>
            <span class="arrow"></span>
        </a>
    </li>
@endcan
<li class="nav-item {{ activeItem('excel') }}">
    <a href="{{ route('backend.excel.index') }}" class="nav-link ">
        <i class="fa fa-fw fa-file-excel-o"></i>
        <span class="title">{{ trans('general.reports') }}</span>
        <span class="arrow"></span>
    </a>
</li>



