<div class="container">
    <div class="tt-login-form">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="tt-item">
                    <h2 class="tt-title text-center border-bottom margin-bottom-30">{{ trans('general.personal_information') }}</h2></br>
                    <div class="form-default">
                        <form method="post"
                              action="{{ route('frontend.order.store') }}">
                            @csrf
                            <input type="hidden" name="payment_method" value="Web - {{ $settings->payment_method }}">
                            {{--                            @if(Cart::content()->where('options.type', 'country')->first())--}}
                            {{--                                <input type="hidden" name="shipment_fees"--}}
                            {{--                                       value="{{ Cart::content()->where('options.type', 'country')->first()->price }}">--}}
                            {{--                            @else--}}
                            {{--                                <input type="hidden" name="shipment_fees" value="0">--}}
                            {{--                            @endif--}}
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="loginInputName">{{ trans('general.name') }} *</label>
                                        <input type="text" name="name" class="form-control" id="loginInputName"
                                               pattern=".{3,}" required title="3 characters minimum"
                                               value="{{ auth()->guest() ? old('name') : auth()->user()->name }}"
                                               required
                                               placeholder="{{ trans('general.name') }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="loginInputEmail">{{ trans('general.email') }} *</label>
                                        <input type="text" name="email" class="form-control" id="loginInputEmail"
                                               pattern=".{3,}" required title="3 characters minimum"
                                               value="{{ auth()->guest() ? old('email') : auth()->user()->email }}"
                                               required
                                               placeholder="{{ trans('general.email') }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="loginLastName">{{ trans('general.mobile') }} *</label>
                                        <input type="number" pattern=".{5,}" name="mobile" class="form-control"
                                               id="loginLastName" title="5 numbers minimum"
                                               value="{{ auth()->guest() ? old('mobile') : auth()->user()->mobile }}"
                                               required
                                               placeholder="{{ trans('general.mobile') }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="loginInputPassword">{{ trans('general.full_address') }} *</label>
                                        <input type="text" name="address" class="form-control" id="loginInputPassword"
                                               pattern=".{3,}" required title="3 characters minimum"
                                               value="{{ auth()->guest() ? old('address') : auth()->user()->address }}"
                                               required
                                               placeholder="{{ trans('general.address') }}">
                                    </div>
                                </div>
                                @if(getClientCountry())
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="address_country">{{ trans('general.country') }}
                                                <sup>*</sup></label>
                                            <select name="country_id" class="form-control" required>
                                                {{-- No Auth required as it's prevesiously done--}}
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}" {{ session()->get('country')->id === $country->id ? 'selected' : null }}
                                                    >{{ $country->slug }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if(session()->get('country')->is_local)
                                        @if(session()->has('area'))
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="address_country">{{ trans('general.area') }}
                                                        <sup>*</sup></label>
                                                    <select name="area" class="form-control" required>
                                                        {{-- No Auth required as it's prevesiously done--}}
                                                        <option value="{{ session()->get('area')->slug }}"
                                                                selected>{{ session()->get('area')->slug }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                                @if(session()->get('country')->is_local && $settings->cash_on_delivery)
                                    <div class="col-6">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="cash_on_delivery">{{ trans('general.cash_on_delivery') }}
                                                    <sup>*</sup></label>
                                                <div class="form-check">
                                                    <input type="checkbox"
                                                           value="1"
                                                           class="form-check-input form-check-input form-control-lg"
                                                           id="exampleCheck1" name="cash_on_delivery">
                                                </div>
                                            </div>
                                            </br>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="alert alert-danger">
                                                <i class="fa fa-fw fa-info-circle fa-lg"></i>
                                                {{ trans('message.order_cash_on_delivery') }}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="notes">{{ trans('general.notes') }}</label>
                                        <textarea name="notes" class="form-control" style="height: 150px;" rows="1"
                                                  placeholder="{{ trans('general.notes') }}">{{ old('notes') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            @include('frontend.wokiee.four.partials._cart_prices')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
