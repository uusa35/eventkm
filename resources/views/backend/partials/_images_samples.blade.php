@can('isAdminOrAbove')
    <div class="col-lg-12">
        @can('product.create')
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans('general.products') }} - {{ trans('general.main_image') }}</div>
                    <div class="panel-body text-center">
                        <img src="{{ asset('images/samples/product_1080x1440.png') }}" class="img-responsive"/>
                    </div>
                </div>
            </div>
        @endcan
            @can('user.create')
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ trans('general.users') }} - {{ trans('general.logo') }}</div>
                        <div class="panel-body text-center">
                            <img src="{{ asset('images/samples/category_1000x1000.png') }}" class="img-responsive"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ trans('general.users') }} - {{ trans('general.banner') }}</div>
                        <div class="panel-body text-center">
                            <img src="{{ asset('images/samples/user_header_1080x350.png') }}" class="img-responsive"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ trans('general.users') }} - {{ trans('general.gallery') }}</div>
                        <div class="panel-body text-center">
                            <img src="{{ asset('images/samples/product_1080x1440.png') }}" class="img-responsive"/>
                        </div>
                    </div>
                </div>
            @endcan
        @can('service.create')
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ trans('general.services') }} - {{ trans('general.main_image') }}</div>
                        <div class="panel-body text-center">
                            <img src="{{ asset('images/samples/product_1080x1440.png') }}" class="img-responsive"/>
                        </div>
                    </div>
                </div>
        @endcan
            @can('category.create')
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ trans('general.categories') }} - {{ trans('general.main_image') }}</div>
                        <div class="panel-body text-center">
                            <img src="{{ asset('images/samples/category_1000x1000.png') }}" class="img-responsive"/>
                        </div>
                    </div>
                </div>
            @endcan
            @can('slide.create')
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ trans('general.slides') }} - {{ trans('general.image') }}</div>
                        <div class="panel-body text-center">
                            <img src="{{ asset('images/samples/900x1900.png') }}" class="img-responsive"/>
                            <div class="alert alert-danger">
                                Intro Slide Width is 900px and maxHeight is 1900px </br>
                                Normal Slides should be width : 900px x (Height must be 1900px (Intro Slide) or Height 474px (Home Slide))
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ trans('general.slides') }} - {{ trans('general.image') }}</div>
                        <div class="panel-body text-center">
                            <img src="{{ asset('images/samples/900x474.png') }}" class="img-responsive"/>
                            <div class="alert alert-danger">
                                Intro Slide Width is 900px and maxHeight is 1900px </br>
                                Normal Slides should be width : 900px x (Height must be 1900px (Intro Slide) or Height 474px (Home Slide))
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
    </div>
@endcan