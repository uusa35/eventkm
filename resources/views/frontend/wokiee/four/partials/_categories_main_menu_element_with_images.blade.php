@if(isset($categories) && $categories->isNotEmpty())
    @if($categories->isNotEmpty())
        @if(env('APP_CASE') === 'EVENTCOM')
            @foreach($categories->where('is_parent', true)->where('on_home', true) as $cat)
                <li class="dropdown megamenu">
                    <a href="{{ route('frontend.service.search',['service_category_id' => $cat->id]) }}">{{ str_limit($cat->name,15,'') }}</a>
                    @if($cat->children->isNotEmpty())
                        <div class="dropdown-menu">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="row tt-col-list">
                                        @foreach($cat->children as $sub)
                                            <div class="col-sm-4">
                                                <a href="{{ route('frontend.service.search',['service_category_id' => $sub->id]) }}"
                                                   class="tt-title-submenu">
                                                    {{ $sub->name }}
                                                    @if($sub->image)
                                                        <img class="img-menu-category img-responsive"
                                                             src="{{ asset(env('IMG_LOADER')) }}"
                                                             data-src="{{ $sub->getImageThumbLinkAttribute() }}"
                                                             alt="{{ $sub->name }}">
                                                    @endif
                                                </a>
                                                @if($sub->children->isNotEmpty())
                                                    <ul class="tt-megamenu-submenu">
                                                        @foreach($sub->children as $child)
                                                            <li>
                                                                <a href="{{ route('frontend.service.search',['service_category_id' => $child->id]) }}">{{ $child->name }}
                                                                    @if($child->on_new)
                                                                        <span class="tt-badge tt-new">{{ trans('general.new') }}</span>
                                                                    @endif
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @if($cat->imageLargeLink)
                                    <div class="col-sm-3">
                                        <div class="tt-offset-7">
                                            <a href="{{ route('frontend.service.search',['service_category_id' => $cat->id]) }}"
                                               class="tt-promo-02">
                                                @if($cat->image)
                                                    <img class="img-category img-responsive"
                                                         src="{{ asset(env('IMG_LOADER')) }}"
                                                         data-src="{{ $cat->getImageThumbLinkAttribute() }}"
                                                         alt="{{ $cat->name }}">
                                                @endif
                                                <div class="tt-description tt-point-h-l tt-point-v-t">
                                                    <div class="tt-description-wrapper">
                                                        <div class="tt-title-small tt-white-color">{{ $cat->name }}</div>
                                                        @if($cat->caption)
                                                            <div class="tt-title-xlarge tt-white-color">{{ $cat->caption }}</div>
                                                        @endif
                                                        @if($cat->description)
                                                            <p class="tt-white-color">{{ $cat->description }}</p>
                                                            <span class="btn-underline tt-obj-bottom tt-white-color">{{ trans('general.shop_now') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </li>
            @endforeach
        @elseif(env('HOMEKEY'))
            @foreach($categories->where('is_classified',true)->where('is_parent', true)->where('on_home', true) as $cat)
                <li class="dropdown megamenu">
                    <a href="{{ route('frontend.classified.search',['classified_category_id' => $cat->id]) }}">{{ str_limit($cat->name,15,'') }}</a>
                    @if($cat->children->isNotEmpty())
                        <div class="dropdown-menu">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="row tt-col-list">
                                        @foreach($cat->children as $sub)
                                            <div class="col-sm-4">
                                                <a href="{{ route('frontend.classified.search', ['classified_category_id' => $sub->id]) }}"
                                                   class="tt-title-submenu">
                                                    {{ $sub->name }}
                                                    @if($sub->image)
                                                        <img class="img-menu-category img-responsive"
                                                             src="{{ asset(env('IMG_LOADER')) }}"
                                                             data-src="{{ $sub->getImageThumbLinkAttribute() }}"
                                                             alt="{{ $sub->name }}">
                                                    @endif
                                                </a>
                                                @if($sub->children->isNotEmpty())
                                                    <ul class="tt-megamenu-submenu">
                                                        @foreach($sub->children as $child)
                                                            <li>
                                                                <a href="{{ route('frontend.classified.search', ['classified_category_id' => $child->id]) }}}}
                                                                    @if($child->on_new)
                                                                        <span class="tt-badge tt-new">{{ trans('general.new') }}</span>
                                                                    @endif
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @if($cat->imageLargeLink)
                                    <div class="col-sm-3">
                                        <div class="tt-offset-7">
                                            <a href="{{ route('frontend.classified.search', ['classified_category_id' => $cat->id]) }}"
                                               class="tt-promo-02">
                                                @if($cat->image)
                                                    <img class="img-category img-responsive"
                                                         src="{{ asset(env('IMG_LOADER')) }}"
                                                         data-src="{{ $cat->getImageThumbLinkAttribute() }}"
                                                         alt="{{ $cat->name }}">
                                                @endif
                                                <div class="tt-description tt-point-h-l tt-point-v-t">
                                                    <div class="tt-description-wrapper">
                                                        <div class="tt-title-small tt-white-color">{{ $cat->name }}</div>
                                                        @if($cat->caption)
                                                            <div class="tt-title-xlarge tt-white-color">{{ $cat->caption }}</div>
                                                        @endif
                                                        @if($cat->description)
                                                            <p class="tt-white-color">{{ $cat->description }}</p>
                                                            <span class="btn-underline tt-obj-bottom tt-white-color">{{ trans('general.shop_now') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </li>
            @endforeach
        @else
            @foreach($categories->where('is_product',true)->where('is_parent', true)->where('on_home', true)->take(env('ENABLE_NAV_CATEGORY') ? 4 : 6) as $cat)
                <li class="dropdown megamenu">
                    <a href="{{ route('frontend.product.search',['product_category_id' => $cat->id]) }}">{{ str_limit($cat->name,15,'') }}</a>
                    @if($cat->children->isNotEmpty())
                        <div class="dropdown-menu">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="row tt-col-list">
                                        @foreach($cat->children as $sub)
                                            <div class="col-sm-4">
                                                <a href="{{ route('frontend.product.search',['product_category_id' => $sub->id]) }}"
                                                   class="tt-title-submenu">
                                                    {{ $sub->name }}
                                                    @if($sub->image)
                                                        <img class="img-menu-category img-responsive"
                                                             src="{{ asset(env('IMG_LOADER')) }}"
                                                             data-src="{{ $sub->getImageThumbLinkAttribute() }}"
                                                             alt="{{ $sub->name }}">
                                                    @endif
                                                </a>
                                                @if($sub->children->isNotEmpty())
                                                    <ul class="tt-megamenu-submenu">
                                                        @foreach($sub->children as $child)
                                                            <li>
                                                                <a href="{{ route('frontend.product.search',['product_category_id' => $child->id]) }}">{{ $child->name }}
                                                                    @if($child->on_new)
                                                                        <span class="tt-badge tt-new">{{ trans('general.new') }}</span>
                                                                    @endif
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @if($cat->imageLargeLink)
                                    <div class="col-sm-3">
                                        <div class="tt-offset-7">
                                            <a href="{{ route('frontend.product.search',['product_category_id' => $cat->id]) }}"
                                               class="tt-promo-02">
                                                @if($cat->image)
                                                    <img class="img-category img-responsive"
                                                         src="{{ asset(env('IMG_LOADER')) }}"
                                                         data-src="{{ $cat->getImageThumbLinkAttribute() }}"
                                                         alt="{{ $cat->name }}">
                                                @endif
                                                <div class="tt-description tt-point-h-l tt-point-v-t">
                                                    <div class="tt-description-wrapper">
                                                        <div class="tt-title-small tt-white-color">{{ $cat->name }}</div>
                                                        @if($cat->caption)
                                                            <div class="tt-title-xlarge tt-white-color">{{ $cat->caption }}</div>
                                                        @endif
                                                        @if($cat->description)
                                                            <p class="tt-white-color">{{ $cat->description }}</p>
                                                            <span class="btn-underline tt-obj-bottom tt-white-color">{{ trans('general.shop_now') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </li>
            @endforeach
            @endif
    @endif
@endif
