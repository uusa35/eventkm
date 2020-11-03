@if(env('ENABLE_LANG_SWITCH'))
    <ul>
        <li>
            <strong class="border-bottom">{{ trans('general.language') }}</strong>
        </li>
        <li class="{{ app()->isLocale('ar') ? 'active' : null }}"><a
                    href="{{ route('frontend.language.change',['locale' => 'ar']) }}">{{ trans('general.arabic') }}</a>
        </li>
        <li class="{{ app()->isLocale('en') ? 'active' : null }}"><a
                    href="{{ route('frontend.language.change',['locale' => 'en']) }}">{{ trans('general.english') }}</a>
        </li>
    </ul>
@endif
