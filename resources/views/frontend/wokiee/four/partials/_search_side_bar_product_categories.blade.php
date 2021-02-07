@if(isset($categoriesList) && $categoriesList->isNotEmpty())
    <div class="tt-collapse open">
        <h3 class="tt-collapse-title">{{ trans('general.filter_by_product_categories') }}</h3>
        <div class="tt-collapse-content">
            @foreach($categoriesList as $category)
                <ul class="tt-filter-list">
                    <li>
                        <a class="{{ request('product_category_id') == $category->id ? 'text-warning' : null }}"
                           href="{!! request()->fullUrlWithQuery(['product_category_id' => $category->id]) !!}">{{ $category->name }}</a>
                    </li>
                    @if($category->children->isNotEmpty())
                        <ul>
                            @foreach($category->children as $child)
                                <li>
                                    <a class="{{ request('product_category_id') == $category->id ? 'text-warning' : null }}"
                                       href="{!! request()->fullUrlWithQuery(['product_category_id' => $child->id]) !!}">{{ $child->name }}</a>
                                </li>
                            @endforeach
                            <li>
                                <a href="{{ getRequestQueryUrlWithout('product_category_id') }}" class="btn-link-02">
                                    <i class="fa fa-fw fa-lg "></i>
                                    {{ trans('general.clear') }}
                                </a>
                            </li>
                        </ul>
                    @endif
                </ul>
            @endforeach
        </div>
    </div>
@endif
