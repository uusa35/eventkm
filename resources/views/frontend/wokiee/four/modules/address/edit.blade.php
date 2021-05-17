@extends('frontend.wokiee.four.layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('frontend.address.edit', $element) }}
@endsection
@section('body')
    <div class="container-indent">
        <div class="container">
            <h1 class="tt-title-subpages noborder">{{ trans('general.update') }} {{ trans('general.edit_address') }}</h1>
            <div class="tt-login-form">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="tt-item">
                            <h2 class="tt-title">{{ trans('general.edit_address') }}</h2>
                            <div class="form-default">
                                <form method="post" novalidate="novalidate"
                                      action="{{ route('frontend.address.update', $element->id) }}">
                                    @csrf
                                    @method('put')
                                    @if($element->name === 'address_one')
                                        <input type="hidden" name="name" value="{{ $element->name }}"/>
                                    @else
                                        <div class="form-group">
                                            <label for="name">{{ trans('general.name') }}*</label>
                                            {{--<div class="tt-required">* {{ trans('general.required_firleds') }}</div>--}}
                                            <input id="name" type="text"
                                                   value="{{ $element->name }}"
                                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                   name="name" required autofocus>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="country">{{ trans('general.country') }} *</label>
                                        <select name="country_id" id="country" style="width: 100%; height: 40px;"
                                                required>
                                            <option value="">{{ trans('general.select_country') }}</option>
                                            @foreach($countries as $country)
                                                <option
                                                    {{ $element->country_id === $country->id ? 'selected' : '' }}
                                                    value="{{ $country->id }}"
                                                    data-local="{!! $country->is_local ? 1 : 0 !!}"
                                                >{{ $country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group {{ !$element->country->is_local ? 'd-none' : '' }}"
                                         id="areas"
                                    >
                                        <label for="country">{{ trans('general.area') }} *</label>
                                        <select name="area_id" style="width: 100%; height: 40px;" id="areaDropDown"
                                                required>
                                            <option value="">{{ trans('general.select_area') }}</option>
                                            @foreach($countries->where('is_local', true)->first()->areas as $area)
                                                <option
                                                    {{ $element->area_id === $area->id ? 'selected' : '' }} value="{{ $area->id }}">{{ $area->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group {{ $element->country->is_local ? 'd-none' : '' }}"
                                         id="areaTextField">
                                        <label for="name">{{ trans('general.area') }}</label>
                                        {{--<div class="tt-required">* {{ trans('general.required_firleds') }}</div>--}}
                                        <input type="text"
                                               value="{{ $element->area }}"
                                               class="form-control{{ $errors->has('area') ? ' is-invalid' : '' }}"
                                               name="area"  autofocus>
                                        @if ($errors->has('area'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('area') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="name">{{ trans('general.block') }}</label>
                                        {{--<div class="tt-required">* {{ trans('general.required_firleds') }}</div>--}}
                                        <input id="block" type="text"
                                               name="block"
                                               value="{{ $element->block }}"
                                               class="form-control{{ $errors->has('block') ? ' is-invalid' : '' }}"
                                               block="block"  autofocus>
                                        @if ($errors->has('block'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('block') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="name">{{ trans('general.street') }}</label>
                                        {{--<div class="tt-required">* {{ trans('general.required_firleds') }}</div>--}}
                                        <input id="street" type="text"
                                               name="street"
                                               value="{{ $element->street }}"
                                               class="form-control{{ $errors->has('street') ? ' is-invalid' : '' }}"
                                               street="street"  autofocus>
                                        @if ($errors->has('street'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="name">{{ trans('general.building') }}</label>
                                        {{--<div class="tt-required">* {{ trans('general.required_firleds') }}</div>--}}
                                        <input id="building" type="text"
                                               name="building"
                                               value="{{ $element->building }}"
                                               class="form-control{{ $errors->has('building') ? ' is-invalid' : '' }}"
                                               building="building"  autofocus>
                                        @if ($errors->has('building'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('building') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="name">{{ trans('general.floor') }}</label>
                                        {{--<div class="tt-required">* {{ trans('general.required_firleds') }}</div>--}}
                                        <input id="floor" type="text"
                                               name="floor"
                                               value="{{ $element->floor }}"
                                               class="form-control{{ $errors->has('floor') ? ' is-invalid' : '' }}"
                                               floor="floor" autofocus>
                                        @if ($errors->has('floor'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('floor') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="name">{{ trans('general.apartment') }}</label>
                                        {{--<div class="tt-required">* {{ trans('general.required_firleds') }}</div>--}}
                                        <input id="apartment" type="text"
                                               name="apartment"
                                               value="{{ $element->apartment }}"
                                               class="form-control{{ $errors->has('apartment') ? ' is-invalid' : '' }}"
                                               apartment="apartment"  autofocus>
                                        @if ($errors->has('apartment'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('apartment') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="name">{{ trans('general.notes') }}*</label>
                                        {{--<div class="tt-required">* {{ trans('general.required_firleds') }}</div>--}}
                                        <input id="notes" type="text"
                                               name="content"
                                               value="{{ $element->content }}"
                                               class="form-control{{ $errors->has('notes') ? ' is-invalid' : '' }}"
                                                 autofocus>
                                        @if ($errors->has('content'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="form-group">
                                                <button class="btn btn-border"
                                                        type="submit">{{ trans('general.update') }}</button>
                                                {{--                                                <a class="btn btn-border"--}}
                                                {{--                                                   href="auth/google">{{ trans('general.register_with_google') }}</a>--}}
                                            </div>
                                        </div>
                                        <div class="col-auto align-self-center">
                                            <div class="form-group">
                                                <ul class="additional-links">
                                                    <li>
                                                        <a class=""
                                                           href="{{ route('frontend.address.index') }}">{{ trans('general.back') }}</a>
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

@section('scripts')
    @parent
    <script>
        $("#country").on('change', function(e) {
            let country_id = e.target.value;
            let local = $('#country').find(":selected").data('local');
            if (local) {
                $('#areas').removeClass('d-none');
                $('#areaTextField').addClass('d-none');
            } else {
                $('#areas').addClass('d-none');
                $('#areaTextField').removeClass('d-none');
                $('#areaDropDown').prop('selectedIndex', 0);
            }
        })
    </script>

@endsection
