<div class="tt-header-holder">
    <div class="tt-obj-logo obj-aligment-center">
        <a class="tt-logo tt-logo-alignment" href="{{ route('frontend.home') }}">
            <img class="text-center" src="{{ $settings->logoAppThumb }}"
                 alt="{{ $settings->company }}"></a>

        <div class="tt-col-obj tt-obj-search-type2">
            <div class="tt-search-type2">
                @include('frontend.wokiee.four.partials._search_form')
            </div>
        </div>
    </div>
</div>

