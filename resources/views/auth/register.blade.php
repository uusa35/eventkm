@extends('frontend.wokiee.four.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('register') }}
@endsection
@section('body')
    <div class="container-indent">
        <div class="container">
            <h1 class="tt-title-subpages noborder">{{ trans('general.create_an_account') }}</h1>
            <div class="tt-login-form">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="tt-item">
                            <h2 class="tt-title">{{ trans('general.information') }}</h2>
                            <div class="form-default">
                                <form method="post" novalidate="novalidate"
                                      action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">{{ trans('general.name') }}*</label>
                                        {{--<div class="tt-required">* {{ trans('general.required_firleds') }}</div>--}}
                                        <input id="name" type="text"
                                               class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                               name="name" value="{{ old('name') }}" required autofocus>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ trans('general.email') }}*</label>
                                        <input id="email" type="email"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="email" value="{{ old('email') }}" required>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="password">{{ trans('general.password') }} *</label>
                                        <input id="password" type="password"
                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               name="password" required>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="password">{{ trans('general.password') }} *</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="country">{{ trans('general.country') }} *</label>
                                        <select name="country_id" id="country" style="width: 100%; height: 40px;"
                                                required>
                                            <option value="">{{ trans('general.select_country') }}</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">{{ trans('general.mobile') }}*</label>
                                        {{--<div class="tt-required">* {{ trans('general.required_firleds') }}</div>--}}
                                        <input id="mobile" type="text"
                                               class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}"
                                               name="mobile" value="{{ old('mobile') }}" autofocus>
                                        @if ($errors->has('mobile'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    @if(env('EVENTKM'))
                                        <input type="hidden" name="role_id" value="{{ $roles->first()->id }}">
                                    @else
                                        <div class="form-group">
                                            <label for="role">{{ trans('general.register_type') }} *</label>
                                            <select name="role_id" id="role" style="width: 100%; height: 40px;"
                                                    required>
                                                <option value="">{{ trans('general.choose_register_type') }}</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}" {{ $role->is_client ? 'selected' : '' }}>{{ $role->slug}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="role">{{ trans('general.captcha') }} *</label>
                                        <div class="col-12 text-center mb-3">
                                            {!! captcha_img('test') !!} </p>
                                        </div>
                                        <input type="text" name="captcha" class="form-control {{ $errors->has('captcha') ? ' is-invalid' : '' }}" required autofocus>
                                        @if ($errors->has('captcha'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="form-group">
                                                <button class="btn btn-border"
                                                        type="submit">{{ trans('general.register') }}</button>
                                                {{--                                                <a class="btn btn-border"--}}
                                                {{--                                                   href="auth/google">{{ trans('general.register_with_google') }}</a>--}}
                                            </div>
                                        </div>
                                        <div class="col-auto align-self-center">
                                            <div class="form-group">
                                                <ul class="additional-links">
                                                    <li>
                                                        <a class=""
                                                           href="{{ route('frontend.home') }}">{{ trans('general.return_home') }}</a>
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
@endsection
