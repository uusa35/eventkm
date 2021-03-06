<div class="row">
    <div class="col-lg-12">
        <div class="m-heading-1 border-green m-bordered">
            @if(isset($title))
                <h3>{{ $title }}</h3>
            @endif
            @if(isset($message))
                <div class="row">
                    <div class="col-lg-12">
                    <p class="text-justify">
                        {{ $message }}
                    </p>
                    @if(str_contains(request()->route()->getName(),'product') || str_contains(request()->route()->getName(),'service') || str_contains(request()->route()->getName(),'category'))
                        <div class="col-lg-12 margin-bottom-30">
                            <div class="alert alert-warning">
                                <p class="text-center">
                                    <h5 class="text-center">{{ trans('message.max_upload') }} {{ env('MAX_IMAGE_SIZE') > 1000 ? str_limit(env('MAX_IMAGE_SIZE'),1,'') : env('MAX_IMAGE_SIZE') }} {{ env('MAX_IMAGE_SIZE') > 1000 ? trans('general.mb') : trans('general.kb') }}</h5>
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
                </div>
            @endif
        </div>
    </div>
</div>
