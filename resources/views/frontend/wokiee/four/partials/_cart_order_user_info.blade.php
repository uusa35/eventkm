<div class="container">
    <div class="tt-login-form">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="tt-item">
                    {{--                    <h2 class="tt-title text-center border-bottom margin-bottom-30">{{ trans('general.personal_information') }}</h2></br>--}}
                    <div class="skltbs-theme-light skltbs-mode-tabs skltbs-init" data-skeletabs="">
                        <ul class="skltbs-tab-group" role="tablist">
                            <li class="skltbs-tab-item skltbs-active" role="presentation">
                                <button class="skltbs-tab skltbs-active" id="skeletabsTab01" aria-selected="true"
                                        role="tab" tabindex="0" aria-controls="skeletabsPanel01">
                                    {{ !auth()->check() ? trans('general.continue_as_guest') : trans('general.personal_information')}}</button>
                            </li>
                            <li class="skltbs-tab-item" role="presentation">
                                <button class="skltbs-tab"
                                        {{ auth()->check() ? 'disabled="disabled"' : '' }} id="skeletabsTab02"
                                        aria-selected="false" role="tab" tabindex="-1" aria-controls="skeletabsPanel02">
                                    {{ trans('general.register_with_us') }}</button>
                            </li>
                        </ul>
                        <div class="skltbs-panel-group">
                            <div class="skltbs-panel skltbs-active" id="skeletabsPanel01" role="tabpanel" tabindex="0"
                                 aria-labelledby="skeletabsTab01" style="display: block;">

                                <div class="skltbs-theme-light skltbs-mode-tabs skltbs-init" data-skeletabs="">
                                    <ul class="skltbs-tab-group" role="tablist">
                                        <li class="skltbs-tab-item skltbs-active" role="presentation">
                                            <button class="skltbs-tab skltbs-active" id="skeletabsTab79"
                                                    aria-selected="true" role="tab" tabindex="0"
                                                    aria-controls="skeletabsPanel70">
                                                {{ trans('general.delivery') }}</button>
                                        </li>
                                        @if($settings->pickup_from_branch && !$settings->multi_cart_merchant)
                                            <li class="skltbs-tab-item" role="presentation">
                                                <button class="skltbs-tab" id="skeletabsTab80" aria-selected="false"
                                                        role="tab" tabindex="-1" aria-controls="skeletabsPanel71">
                                                    {{ trans('general.receive_order') }}</button>
                                            </li>
                                        @endif
                                    </ul>
                                    <div class="skltbs-panel-group">
                                        <div class="skltbs-panel skltbs-active skltbs-enter-done mb-5"
                                             id="skeletabsPanel70" role="tabpanel" tabindex="0"
                                             aria-labelledby="skeletabsTab79" style="display: block;">
                                            <div class="form-default">
                                                <form method="post"
                                                      action="{{ route('frontend.order.store') }}">
                                                    @csrf
                                                    <input type="hidden" name="payment_method"
                                                           value="Web - {{ $settings->payment_method }}">
                                                    {{--                            @if(Cart::content()->where('options.type', 'country')->first())--}}
                                                    {{--                                <input type="hidden" name="shipment_fees"--}}
                                                    {{--                                       value="{{ Cart::content()->where('options.type', 'country')->first()->price }}">--}}
                                                    {{--                            @else--}}
                                                    {{--                                <input type="hidden" name="shipment_fees" value="0">--}}
                                                    {{--                            @endif--}}
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="loginInputName">{{ trans('general.name') }}
                                                                    *</label>
                                                                <input type="text" name="name" class="form-control"
                                                                       id="loginInputName"
                                                                       pattern=".{3,}" required
                                                                       title="3 characters minimum"
                                                                       value="{{ auth()->guest() ? old('name') : auth()->user()->name }}"
                                                                       required
                                                                       placeholder="{{ trans('general.name') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="loginEmail">{{ trans('general.email') }}
                                                                    *</label>
                                                                <input type="text" name="email" class="form-control"
                                                                       id="loginEmail"
                                                                       pattern=".{3,}" required
                                                                       title="3 characters minimum"
                                                                       value="{{ auth()->guest() ? old('email') : auth()->user()->email }}"
                                                                       required
                                                                       placeholder="{{ trans('general.email') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="loginLastName">{{ trans('general.mobile') }}
                                                                    *</label>
                                                                <input type="number" pattern=".{5,}" name="mobile"
                                                                       class="form-control"
                                                                       id="loginLastName" title="5 numbers minimum"
                                                                       value="{{ auth()->guest() ? old('mobile') : auth()->user()->mobile }}"
                                                                       required
                                                                       placeholder="{{ trans('general.mobile') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="loginInputPassword">{{ trans('general.full_address') }}
                                                                    *</label>
                                                                <input type="text" name="address" class="form-control"
                                                                       id="loginInputPassword"
                                                                       pattern=".{3,}" required
                                                                       title="3 characters minimum"
                                                                       value="{{ auth()->guest() ? old('address') : auth()->user()->address }}"
                                                                       required
                                                                       placeholder="{{ trans('general.address') }}">
                                                            </div>
                                                        </div>
                                                        @if(getClientCountry())
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="address_country">{{ trans('general.country') }}
                                                                        <sup>*</sup></label>
                                                                    <select name="country_id" class="form-control"
                                                                            required id="country_id">
                                                                        {{-- No Auth required as it's prevesiously done--}}
                                                                        @foreach($countries as $country)
                                                                            <option
                                                                                data-currency="{{ strtolower($country->currency_symbol_en) }}"
                                                                                value="{{ $country->id }}" {{ session()->get('country')->id === $country->id ? 'selected' : null }}
                                                                            >{{ $country->slug }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            @if(session()->get('country')->is_local)
                                                                @if(session()->has('area'))
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="address_country">{{ trans('general.area') }}
                                                                                <sup>*</sup></label>
                                                                            <select name="area" class="form-control"
                                                                                    required>
                                                                                {{-- No Auth required as it's prevesiously done--}}
                                                                                <option
                                                                                    value="{{ session()->get('area')->slug }}"
                                                                                    selected>{{ session()->get('area')->slug }}</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        @endif
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="notes">{{ trans('general.notes') }}</label>
                                                                <textarea name="notes" class="form-control"
                                                                          style="height: 150px;" rows="1"
                                                                          placeholder="{{ trans('general.notes') }}">{{ old('notes') }}</textarea>
                                                            </div>
                                                        </div>
                                                        @if(session()->get('country')->is_local && $settings->cash_on_delivery)
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="cash_on_delivery">{{ trans('general.cash_on_delivery') }}
                                                                        <sup>*</sup></label>
                                                                    <div class="form-check">
                                                                        <input type="radio"
                                                                               value="1"
                                                                               class="form-check-input form-check-input form-control-lg"
                                                                               style="width : 20px; height: 20px;"
                                                                               name="cash_on_delivery">
                                                                        <label class="form-check-label"
                                                                               for="cash_on_delivery"
                                                                               style="padding-right: 25px; padding-top: 10px;">
                                                                            {{ trans('message.cash_on_delivery_instruction') }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                </br>
                                                            </div>
                                                        @endif
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="cash_on_delivery">{{ trans('general.payment_method') }}
                                                                    <sup>*</sup></label>
                                                                <div class="form-check">
                                                                    <input type="radio"
                                                                           value="0"
                                                                           checked
                                                                           class="form-check-input form-check-input form-control-lg"
                                                                           style="width : 20px; height: 20px; padding-top: 20px;"
                                                                           name="cash_on_delivery">
                                                                    <label class="form-check-label"
                                                                           for="cash_on_delivery"
                                                                           style="padding-right: 25px;">
                                                                        <img
                                                                            src="{{ asset('images/knet-visa.png') }}"
                                                                            style="width : 100px;">
                                                                        {{ trans('general.by') }} -
                                                                        ({{ strtoupper($settings->payment_method) }})
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if(session()->get('country')->is_local && $settings->cash_on_delivery)
                                                            <div class="col-12">
                                                                <div class="alert alert-secondary">
                                                                    <ul style="list-style: none">
                                                                        <li>
                                                                            <h6>
                                                                                <i class="fa fa-fw fa-info-circle fa-lg"></i>
                                                                                {{ trans('message.order_cash_on_delivery') }}
                                                                            </h6>
                                                                        </li>
                                                                        @if($settings->pickup_from_branch && !$settings->multi_cart_merchant)
                                                                            <li>
                                                                                <h6>
                                                                                    <i class="fa fa-fw fa-info-circle fa-lg"></i>
                                                                                    {{ trans('message.shipment_fees_shall_be_removed_in_confirmation_page_in_case_you_choosed_to_receive_from_branch') }}
                                                                                </h6>
                                                                            </li>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        @endif

                                                    </div>
                                                    @include('frontend.wokiee.four.partials._cart_prices')
                                                </form>
                                            </div>
                                        </div>
                                        <div class="skltbs-panel skltbs-leave-done mb-5" id="skeletabsPanel71"
                                             role="tabpanel" tabindex="0" aria-labelledby="skeletabsTab80"
                                             style="display: none;">
                                            @if($settings->pickup_from_branch && !$settings->multi_cart_merchant)
                                                <div class="form-default">
                                                    <form method="post"
                                                          action="{{ route('frontend.order.store') }}">
                                                        @csrf
                                                        <input type="hidden" name="payment_method"
                                                               value="Web - {{ $settings->payment_method }}">
                                                        {{--                            @if(Cart::content()->where('options.type', 'country')->first())--}}
                                                        {{--                                <input type="hidden" name="shipment_fees"--}}
                                                        {{--                                       value="{{ Cart::content()->where('options.type', 'country')->first()->price }}">--}}
                                                        {{--                            @else--}}
                                                        {{--                                <input type="hidden" name="shipment_fees" value="0">--}}
                                                        {{--                            @endif--}}
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="loginFirstName">{{ trans('general.name') }}
                                                                        *</label>
                                                                    <input type="text" name="name" class="form-control"
                                                                           id="loginFirstName"
                                                                           pattern=".{3,}" required
                                                                           title="3 characters minimum"
                                                                           value="{{ auth()->guest() ? old('name') : auth()->user()->name }}"
                                                                           required
                                                                           placeholder="{{ trans('general.name') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="loginInputEmail">{{ trans('general.email') }}
                                                                        *</label>
                                                                    <input type="text" name="email" class="form-control"
                                                                           id="loginInputEmail"
                                                                           pattern=".{3,}" required
                                                                           title="3 characters minimum"
                                                                           value="{{ auth()->guest() ? old('email') : auth()->user()->email }}"
                                                                           required
                                                                           placeholder="{{ trans('general.email') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="loginLast">{{ trans('general.mobile') }}
                                                                        *</label>
                                                                    <input type="number" pattern=".{5,}" name="mobile"
                                                                           class="form-control"
                                                                           id="loginLast" title="5 numbers minimum"
                                                                           value="{{ auth()->guest() ? old('mobile') : auth()->user()->mobile }}"
                                                                           required
                                                                           placeholder="{{ trans('general.mobile') }}">
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="address" value="N/A">
                                                            <input type="hidden" name="country_id"
                                                                   value="{{ $countries->where('is_local')->first()->id }}">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="notes">{{ trans('general.notes') }}</label>
                                                                    <textarea name="notes" class="form-control"
                                                                              style="height: 150px;" rows="1"
                                                                              placeholder="{{ trans('general.notes') }}">{{ old('notes') }}</textarea>
                                                                </div>
                                                            </div>
                                                            @if(session()->get('country')->is_local && $settings->cash_on_delivery)
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="cash_on_delivery">{{ trans('general.cash_on_delivery') }}
                                                                            <sup>*</sup></label>
                                                                        <div class="form-check">
                                                                            <input type="radio"
                                                                                   value="1"
                                                                                   class="form-check-input form-check-input form-control-lg"
                                                                                   style="width : 20px; height: 20px;"
                                                                                   name="cash_on_delivery">
                                                                            <label class="form-check-label"
                                                                                   for="exampleCheck1"
                                                                                   style="padding-right: 25px; padding-top: 10px;">
                                                                    <span
                                                                        class="alert alert-info"><small>{{ trans('message.cash_on_delivery_instruction') }}</small></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    </br>
                                                                </div>
                                                            @endif
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="cash_on_delivery">{{ trans('general.payment_method') }}
                                                                        <sup>*</sup></label>
                                                                    <div class="form-check">
                                                                        <input type="radio"
                                                                               value="0"
                                                                               checked
                                                                               class="form-check-input form-check-input form-control-lg"
                                                                               style="width : 20px; height: 20px; padding-top: 20px;"
                                                                               name="cash_on_delivery">
                                                                        <label class="form-check-label"
                                                                               for="exampleCheck1"
                                                                               style="padding-right: 25px;">
                                                                            <img
                                                                                src="{{ asset('images/knet-visa.png') }}"
                                                                                style="width : 100px;">
                                                                            {{ trans('general.by') }} -
                                                                            ({{ strtoupper($settings->payment_method) }}
                                                                            )
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if(session()->get('country')->is_local && $settings->cash_on_delivery)
                                                                <div class="col-12">
                                                                    <div class="alert alert-danger">
                                                                        <i class="fa fa-fw fa-info-circle fa-lg"></i>
                                                                        {{ trans('message.order_cash_on_delivery') }}
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                            @endif
                                                            @if($settings->pickup_from_branch && !$settings->multi_cart_merchant && session()->get('country')->is_local)
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="pickup_from_branch">{{ trans('general.pickup_from_branch') }}
                                                                            <sup>*</sup></label>
                                                                        <div class="form-check">
                                                                            <input type="checkbox"
                                                                                   value="1"
                                                                                   checked
                                                                                   class="selectBranch form-check-input form-check-input form-control-lg"
                                                                                   style="width : 20px; height: 20px; padding-top: 20px;"
                                                                                   name="pickup_from_branch">
                                                                            <label class="form-check-label"
                                                                                   for="pickup_from_branch"
                                                                                   style="padding-right: 25px;">
                                                                                {{ trans('general.pickup_from_branch') }}
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    </br>
                                                                </div>

                                                                <div class="col-6 branchElements"
                                                                     style="display: inline;">
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="address_country">{{ trans('general.choose_branch') }}
                                                                            <sup>*</sup></label>
                                                                        <select name="branch_id" class="form-control"
                                                                                id="branchId" required>
                                                                            <option
                                                                                value="null"
                                                                            >{{ trans('general.choose_branch') }}</option>
                                                                            @foreach($countries->where('is_local')->first()->branches as $b)
                                                                                <option
                                                                                    value="{{ $b->id }}"
                                                                                >{{ $b->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 branchElements"
                                                                     style="display : none">
                                                                    <div class="alert alert-danger">
                                                                        <i class="fa fa-fw fa-info-circle fa-lg"></i>
                                                                        {{ trans('message.chooose_branch') }}
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <input type="hidden" name="branch_id" value="null"/>
                                                            @endif
                                                        </div>
                                                        @include('frontend.wokiee.four.partials._cart_prices')
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="skltbs-panel" id="skeletabsPanel02" role="tabpanel" tabindex="-1"
                                 aria-labelledby="skeletabsTab02" style="display: none;">
                                <div class="tt-login-form">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="tt-item">
                                                <h2 class="tt-title">{{ trans('general.login') }}</h2>
                                                {{ trans('general.already_have_account') }}
                                                <div class="form-default form-top">
                                                    <form id="customer_login" method="post" novalidate="novalidate"
                                                          action="{{ route('login') }}">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="loginName">{{ trans('general.email') }}
                                                                *</label>
                                                            <div class="tt-required">
                                                                * {{ trans('general.required_fields') }}</div>
                                                            <input type="text" name="email"
                                                                   class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                                   id="loginName"
                                                                   value="{{ old('email') }}"
                                                                   placeholder="{{ trans('general.enter_your_email') }}"
                                                                   required
                                                                   autofocus>
                                                            @if ($errors->has('email'))
                                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="password">{{ trans('general.password') }}
                                                                *</label>
                                                            <input type="password" name="password" class="form-control"
                                                                   id="password"
                                                                   placeholder="{{ trans('general.enter_your_password') }}">
                                                            @if ($errors->has('password'))
                                                                <span class="invalid-feedback"
                                                                      role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="form-check-input" type="checkbox"
                                                                   name="remember"
                                                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                            <label class="" for="remember"
                                                                   style="padding-left : 20px; padding-right: 20px;">
                                                                {{ trans('general.remember_me')}}
                                                            </label>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-auto mr-auto">
                                                                <div class="form-group">
                                                                    <button class="btn btn-border"
                                                                            type="submit">{{ trans('general.login') }}</button>
                                                                    {{--                                                <a class="btn btn-border"--}}
                                                                    {{--                                                   href="auth/google">{{ trans('general.login_with_google') }}</a>--}}
                                                                </div>
                                                            </div>
                                                            <div class="col-auto align-self-end">
                                                                <div class="form-group">
                                                                    <ul class="additional-links">
                                                                        <li>
                                                                            <a href="{{ route('password.request') }}">{{ trans('general.forgot_your_password') }}</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script>
        $("input[name=cash_on_delivery]").on('click', function(e) {
            // if (e.target.value == 1) {
            //     $('.selectBranch').prop("disabled", false);

            // } else {
            //     $('.selectBranch').prop("disabled", true);
            //     $('.branchElements').css({display: 'none'})
            //     $('.selectBranch').prop("checked", false);
            // }
            $("#branchId")[0].selectedIndex = 0;
        });
        $('.selectBranch').on('change', function(e) {
            if ($(".selectBranch").is(':checked')) {
                $('.branchElements').css({display: 'inline'})
            } else {
                $('.branchElements').css({display: 'none'})
                $("#branchId")[0].selectedIndex = 0;
            }
        });
        $("#country_id").on('change', function(e) {
            let currency = $('#country_id').find(":selected").data('currency')
            window.location.href = `${window.location.origin}/currency/${currency}`
        })
    </script>
@endsection
