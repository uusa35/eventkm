<div class="container-indent1">
    <div class="container-fluid-custom container-fluid-custom-mobile-padding">
        <div class="tt-block-title text-left">
            <h1 class="tt-title">{{ $title }}</h1>
        </div>
        <div class="tt-tab-wrapper">
            <ul class="nav nav-tabs tt-tabs-default" role="tablist">
                @foreach($elements as $element)
                    <li class="nav-item">
                        <a class="nav-link show {{ $elements->first()->id == $element->id ? 'active' : '' }}"
                           data-toggle="tab" href="#tt-tab-{{ $element->id }}" role="tab">{{ $element->name }}</a>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content">
                @foreach($elements as $element)
                    <div class="tab-pane {{ $elements->first()->id == $element->id ? 'active' : '' }} fade"
                         id="tt-tab-{{ $element->id }}" role="tabpanel">
                        <div
                            class="tt-carousel-products row arrow-location-tab tt-alignment-img tt-collection-listing slick-animated-show-js"
                            data-item="{{ $element->children->count() }}">
                            @foreach($element->children as $child)
                                <div class="col-2 col-md-4 col-lg-3">
                                    <a href="{{ route('frontend.user.search', ['user_category_id' => $child->id ]) }}"
                                       class="tt-collection-item">
                                        <div class="tt-image-box"><img src="{{ $child->imageThumbLink }}" alt="">
                                        </div>
                                        <div class="tt-description">
                                            <h2 class="tt-title">{{ $child->name }}</h2>
                                            <ul class="tt-add-info">
                                                <li>45 PRODUCTS</li>
                                            </ul>
                                        </div>
                                    </a>
                                </div>
                                @if($child->children->isNotEmpty())
                                    @foreach($child->children as $subChild)
                                        <div class="col-2 col-md-4 col-lg-3">
                                            <a href="{{ route('frontend.user.search', ['user_category_id' => $subChild->id ]) }}" class="tt-collection-item">
                                                <div class="tt-image-box"><img src="{{ $subChild->imageThumbLink }}" alt=""></div>
                                                <div class="tt-description">
                                                    <h2 class="tt-title">{{ $subChild->name }}</h2>
                                                    <ul class="tt-add-info">
                                                        <li>45 PRODUCTS</li>
                                                    </ul>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
