@if(isset($categoriesList) && $categoriesList->isNotEmpty())
    <div class="tt-collapse open">
        <h3 class="tt-collapse-title">{{ trans('general.filter_by_product_categories') }}</h3>
        <div class="tt-collapse-content">
            @foreach($categoriesList as $category)
                @if($category->isParent)
                    <ul class="tt-filter-list">
                        <li>
                            <a class="{{ request('product_category_id') == $category->id ? 'text-warning' : null }}"
                               href="{!! request()->fullUrlWithQuery(['product_category_id' => $category->id]) !!}">{{ $category->name }}</a>
                        </li>
                        @if($category->children && $category->children->isNotEmpty())
                            @foreach($category->children as $child)
                                <ul>
                                    @if($child)
                                        <li>
                                            <a class="{{ request('product_category_id') == $category->id ? 'text-warning' : null }}"
                                               href="{!! request()->fullUrlWithQuery(['product_category_id' => $child->id]) !!}">{{ $child->name }}</a>
                                        </li>
                                    @endif
                                </ul>
                            @endforeach
                            <li>
                                <a href="{{ getRequestQueryUrlWithout('product_category_id') }}"
                                   class="btn-link-02" style="color : darkred !important;">
                                    <i class="fa fa-fw fa-lg "></i>
                                    {{ trans('general.clear') }}
                                </a>
                                <hr style="padding: 0; padding-bottom: 1rem; margin: 0">
                            </li>
                        @endif
                    </ul>
                @endif
            @endforeach
        </div>
    </div>
@endif
