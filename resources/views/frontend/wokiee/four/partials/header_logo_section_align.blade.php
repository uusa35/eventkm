<div class="tt-header-holder">
    <div class="col-lg-6 col-sm-12">
        <div class="tt-col-obj tt-obj-logo">
            <a class="tt-logo tt-logo-alignment" href="{{ route('frontend.home') }}">
                <img class="text-center" src="{{ $settings->logoAppThumb }}"
                     alt="{{ $settings->company }}"></a>
        </div>
    </div>
    <div class="col-lg-6 col-sm-12 pull-right">
        <div class="tt-col-obj tt-obj-search-type2">
            <div class="tt-search-type2">
                @include('frontend.wokiee.four.partials._search_form')
            </div>
        </div>
    </div>

</div>
