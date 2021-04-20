@if(isset($element))
    <div class="container-fluid">
        <div class="row">
            <div class="tt-promo-fullwidth-02">
                    <img src="{{ $element->banner ? $element->bannerLargeLink : $element->imageThumbLink }}" alt="{{ $element->description }}"
                         style="max-height : 500px; opacity: 0.5;">
                <div class="tt-description">
                    <div class="tt-description-wrapper">
                        @if($element->slug)
                            <img src="{{ $element->imageThumbLink }}" alt="{{ $element->slug }}"
                                 class="img-responsive img-circle" style="width : 230px; border-radius: 120px;">
                        @endif
                        @if($element->description)
                            <div class="tt-title-large">
                                <span class="tt-base-color">{{ $element->slug }}</span>
                            </div>
                        @endif
                        @auth
                            <div class="tt-title-large">
                                <a href="{{ route('frontend.fan.create', ['fan_id' => auth()->id(), 'id' => $element->id,'model' => 'user']) }}"
                                   class="btn btn-info"><i
                                            class="fa fa-fw fa-thumbs-o-up"></i>{{ trans('general.like') }}</a>
                                @if($element->fans->isNotEmpty())
                                    <a href="{{ route('frontend.fan.index',['element_id' => $element->id,'model' => 'user']) }}"
                                       style="font-size: 12px;">{{ trans('general.fans_no') }}
                                        : {{ $element->fans->count() }}</a>
                                @endif
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
