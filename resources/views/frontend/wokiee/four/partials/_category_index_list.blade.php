@if(isset($elements) && $elements->isNotEmpty())
    <div class="row">
        @foreach($elements as $element)
                <div class="col-6 col-lg-3">
                    @include('frontend.wokiee.four.partials._category_widget', ['type' => 'product'])
                </div>
        @endforeach
    </div>
@endif
