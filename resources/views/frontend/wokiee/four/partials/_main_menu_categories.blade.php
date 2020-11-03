@if(isset($categories) && $categories->isNotEmpty() && env('ENABLE_NAV_CATEGORY'))
    <div class="tt-col-obj tt-obj-menu-categories tt-desctop-parent-menu-categories">
        <div class="tt-menu-categories">
            <button class="tt-dropdown-toggle">
                {{ trans('general.categories') }}
            </button>
            <div class="tt-dropdown-menu">
                <nav>
                    <ul>
                        @foreach($categories->where('is_product',true)->where('is_parent', true) as $cat)
                            <li>
                                <a href="{{ route('frontend.product.search',['product_category_id' => $cat->id]) }}">
                                    @if(!str_contains($cat->image,'http'))
                                        <img src="{{ $cat->getImageThumbLinkAttribute() }}" alt="{{ $cat->name }}"
                                             class="img-responsive img-xs"/>
                                    @else
                                        <i class="{{ app()->getLocale() === 'ar' ? "icon-e-14" : "icon-e-15" }}"></i>
                                    @endif
                                    <span>{{ str_limit($cat->name,15,'') }}</span>
                                </a>
                                @if($cat->children->isNotEmpty())
                                    <div class="dropdown-menu size-md">
                                        <div class="dropdown-menu-wrapper">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row tt-col-list">
                                                        @foreach($cat->children as $sub)
                                                            <div class="col-sm-4">
                                                                <a class="tt-title-submenu"
                                                                   href="{{ route('frontend.product.search',['product_category_id' => $sub->id]) }}">
                                                                    {{ $sub->name }}
                                                                </a>
                                                                @if($sub->children->isNotEmpty())
                                                                    <ul class="tt-megamenu-submenu">
                                                                        @foreach($sub->children as $child)
                                                                            <li>
                                                                                <a href="{{ route('frontend.product.search',['product_category_id' => $child->id]) }}">
                                                                                    {{ $child->name }}
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
                                            </div>
                                            @if(!str_contains($cat->image,'http'))
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <a href="{{ route('frontend.product.search',['product_category_id' => $cat->id]) }}"
                                                           class="tt-promo-02 pull-left">
                                                            <img src="{{ $cat->getImageThumbLinkAttribute() }}"
                                                                 alt="{{ $cat->name }}"
                                                                 style="max-width: 200px; text-align: center">
                                                            <div class="tt-description tt-point-h-l">
                                                                <div class="tt-description-wrapper">
                                                                    @if($cat->caption)
                                                                        <div class="tt-title-small">{{ $cat->caption }}
                                                                            <span class="tt-base-color"></span></div>
                                                                    @endif
                                                                    <div class="tt-title-small">{{ $cat->name }}</div>
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
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endif
