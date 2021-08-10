@extends('frontend.wokiee.four.layouts.app')

@section('body')

    @if($settings->longitude && $settings->latitude)
        <div class="container-indent">
            <div class="container">
                <div class="contact-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1739.2285510470779!2d{{ $settings->longitude }}!3d{{ $settings->latitude }}!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3fcf9b6d07a00cd3%3A0x467f87788beec59b!2z2KfZhNil2KrYrdin2K8g2KfZhNmD2YjZitiq2Yog2YTZg9ix2Kkg2KfZhNmC2K_ZhdiMINi02KfYsdi5INiz2KfZhdmKINin2K3ZhdivINin2YTZhdmG2YrYsw!5e0!3m2!1sar!2skw!4v1628573777436!5m2!1sar!2skw"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    @endif
    <div class="container-indent">
        <div class="container container-fluid-custom-mobile-padding">
            <div class="tt-contact02-col-list">
                <div class="row">
                    <div class="col-sm-12 col-md-4 ml-sm-auto mr-sm-auto">
                        <div class="tt-contact-info">
                            <i class="tt-icon icon-f-93"></i>
                            <h6 class="tt-title">@lang('general.contactus')</h6>
                            <address>
                                {{ $settings->whatsapp }}<br>
                                {{ $settings->mobile }}
                            </address>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="tt-contact-info">
                            <i class="tt-icon icon-f-24"></i>
                            <h6 class="tt-title">@lang('general.address')</h6>
                            <address>
                                {{ $settings->address }} <br> {{ $settings->country }}
                            </address>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="tt-contact-info">
                            <i class="tt-icon icon-f-92"></i>
                            <h6 class="tt-title">@lang('general.duty_time')</h6>
                            <address>
                                @lang('message.duty_time_message')
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-indent">
        <div class="container container-fluid-custom-mobile-padding">
            <form class="contact-form form-default" method="post" novalidate="novalidate"
                  action="{{ route('frontend.contactus') }}">
                @csrf
                <input type="hidden" name="inquiry_type" value="contactus">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" id="inputName"
                                   placeholder="@lang('general.name')"
                                   required
                            >
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" id="inputEmail"
                                   placeholder="@lang('general.email')"
                                   required
                            >
                        </div>
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" id="inputSubject"
                                   placeholder="@lang('general.title')"
                                   required
                            >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea name="body" class="form-control" rows="7" placeholder="@lang('general.message')"
                                      required
                                      id="textareaMessage"></textarea>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn">@lang('general.send')</button>
                </div>
            </form>
        </div>
    </div>
@endsection
