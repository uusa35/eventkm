<li class="disabled">
    <a href="#" disabled="true" class="tooltips disabled" data-container="body"
       data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
       data-original-title="{{ trans('message.create_your_new_items_list') }}">
        <i class="icon-note"></i> {{ trans('general.create_your_new_items_list') }}</a>
</li>
@can('user.create')
    <li>
        <a href="{{ route('backend.admin.user.create') }}" class="tooltips" data-container="body"
           data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
           data-original-title="{{ trans('message.new_user') }}">
            <i class="icon-plus"></i> {{ trans('general.new_user') }}</a>
    </li>
@endcan
@can('country.create')
    <li>
        <a href="{{ route('backend.admin.country.create') }}" class="tooltips" data-container="body"
           data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
           data-original-title="{{ trans('message.new_country') }}">
            <i class="icon-plus"></i> {{ trans('general.new_country') }}</a>
    </li>
    <li>
        <a href="{{ route('backend.admin.governate.create') }}" class="tooltips" data-container="body"
           data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
           data-original-title="{{ trans('message.new_governate') }}">
            <i class="icon-plus"></i> {{ trans('general.new_governate') }}</a>
    </li>
@endcan
@can('currency.create')
    <li>
        <a href="{{ route('backend.admin.currency.create') }}" class="tooltips" data-container="body"
           data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
           data-original-title="{{ trans('message.new_currency') }}">
            <i class="icon-plus"></i> {{ trans('general.new_currency') }}</a>
    </li>
@endcan
@can('category.create')
    <li>
        <a href="{{ route('backend.admin.category.create') }}" class="tooltips" data-container="body"
           data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
           data-original-title="{{ trans('message.new_category') }}">
            <i class="icon-plus"></i> {{ trans('general.new_category') }}</a>
    </li>
@endcan
@can('coupon.create')
    <li>
        <a href="{{ route('backend.admin.coupon.create') }}" class="tooltips" data-container="body"
           data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
           data-original-title="{{ trans('message.new_coupon') }}">
            <i class="icon-plus"></i> {{ trans('general.new_coupon') }}</a>
    </li>
@endcan
@can('superOne')
    @can('device.create')
        <li>
            <a href="{{ route('backend.admin.device.create') }}" class="tooltips" data-container="body"
               data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
               data-original-title="{{ trans('message.new_device') }}">
                <i class="icon-plus"></i> {{ trans('general.new_device') }}</a>
        </li>
    @endcan
@endcan
@can('tag.create')
    <li>
        <a href="{{ route('backend.admin.tag.create') }}" class="tooltips" data-container="body"
           data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
           data-original-title="{{ trans('message.new_tag') }}">
            <i class="icon-plus"></i> {{ trans('general.new_tag') }}</a>
    </li>
@endcan
@can('brand.create')
    <li>
        <a href="{{ route('backend.admin.brand.create') }}" class="tooltips" data-container="body"
           data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
           data-original-title="{{ trans('message.new_brand') }}">
            <i class="icon-plus"></i> {{ trans('general.new_brand') }}</a>
    </li>
@endcan
@can('color.create')
    <li>
        <a href="{{ route('backend.admin.color.create') }}" class="tooltips" data-container="body"
           data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
           data-original-title="{{ trans('message.new_color') }}">
            <i class="icon-plus"></i> {{ trans('general.new_color') }}</a>
    </li>
@endcan
@can('size.create')
    <li>
        <a href="{{ route('backend.admin.size.create') }}" class="tooltips" data-container="body"
           data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
           data-original-title="{{ trans('message.new_size') }}">
            <i class="icon-plus"></i> {{ trans('general.new_size') }}</a>
    </li>
@endcan
@can('newsletter.create')
    <li>
        <a href="{{ route('backend.admin.newsletter.create') }}" class="tooltips" data-container="body"
           data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
           data-original-title="{{ trans('message.new_newsletter') }}">
            <i class="icon-plus"></i> {{ trans('general.new_newsletter') }}</a>
    </li>
@endcan
@can('faq.create')
    <li>
        <a href="{{ route('backend.admin.faq.create') }}" class="tooltips" data-container="body"
           data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
           data-original-title="{{ trans('message.new_faq') }}">
            <i class="icon-plus"></i> {{ trans('general.new_faq') }}</a>
    </li>
@endcan
@can('commercial.create')
    <li>
        <a href="{{ route('backend.admin.commercial.create') }}" class="tooltips" data-container="body"
           data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
           data-original-title="{{ trans('message.new_commercial') }}">
            <i class="icon-plus"></i> {{ trans('general.new_commercial') }}</a>
    </li>
@endcan
@can('notification.create')
    <li>
        <a href="{{ route('backend.admin.notification.create') }}" class="tooltips" data-container="body"
           data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
           data-original-title="{{ trans('message.new_notification') }}">
            <i class="icon-plus"></i> {{ trans('general.new_notification') }}</a>
    </li>
@endcan
@can('policy.create')
    <li>
        <a href="{{ route('backend.admin.policy.create') }}" class="tooltips" data-container="body"
           data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
           data-original-title="{{ trans('message.new_policy') }}">
            <i class="icon-plus"></i> {{ trans('general.new_policy') }}</a>
    </li>
@endcan
@can('superOne')
    @can('role.create')
        <li>
            <a href="{{ route('backend.admin.role.create') }}" class="tooltips" data-container="body"
               data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
               data-original-title="{{ trans('message.new_role') }}">
                <i class="icon-plus"></i> {{ trans('general.new_role') }}</a>
        </li>
    @endcan
    @can('privilege.create')
        <li>
            <a href="{{ route('backend.admin.privilege.create') }}" class="tooltips" data-container="body"
               data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
               data-original-title="{{ trans('message.new_privilege') }}">
                <i class="icon-plus"></i> {{ trans('general.new_privilege') }}</a>
        </li>
    @endcan
@endcan
@can('term.create')
    <li>
        <a href="{{ route('backend.admin.term.create') }}" class="tooltips" data-container="body"
           data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
           data-original-title="{{ trans('message.new_term') }}">
            <i class="icon-plus"></i> {{ trans('general.new_term') }}</a>
    </li>
@endcan
@can('shipment.create')
    <li>
        <a href="{{ route('backend.package.create') }}" class="tooltips" data-container="body"
           data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
           data-original-title="{{ trans('message.new_package') }}">
            <i class="icon-plus"></i> {{ trans('general.new_package') }}</a>
    </li>
@endcan
@can('page.create')
    <li>
        <a href="{{ route('backend.admin.page.create') }}" class="tooltips" data-container="body"
           data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
           data-original-title="{{ trans('message.new_page') }}">
            <i class="icon-plus"></i> {{ trans('general.new_page') }}</a>
    </li>
@endcan
@can('slide.create')
    <li>
        <a href="{{ route('backend.slide.create',['slidable_id' => auth()->id(), 'slidable_type' => 'user']) }}"
           class="tooltips"
           data-container="body" data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
           data-original-title="{{ trans('message.new_slider') }}">
            <i class="icon-plus"></i> {{ trans('general.new_slide_for_home_page') }}</a>
    </li>
@endcan
@can('video.create')
    <li>
        <a href="{{ route('backend.video.create') }}" class="tooltips"
           data-container="body" data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
           data-original-title="{{ trans('message.new_video') }}">
            <i class="icon-plus"></i> {{ trans('general.new_video') }}</a>
    </li>
@endcan
@can('post.create')
    <li>
        <a href="{{ route('backend.post.create') }}" class="tooltips"
           data-container="body" data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
           data-original-title="{{ trans('message.new_post') }}">
            <i class="icon-plus"></i> {{ trans('general.new_post') }}</a>
    </li>
@endcan
@can('branch.create')
    <li>
        <a href="{{ route('backend.branch.create') }}" class="tooltips" data-container="body"
           data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"
           data-original-title="{{ trans('message.new_branch') }}">
            <i class="icon-plus"></i> {{ trans('general.new_branch') }}</a>
    </li>
@endcan
{{--@can('day.create')--}}
{{--    <li>--}}
{{--        <a href="{{ route('backend.admin.day.create') }}" class="tooltips" data-container="body"--}}
{{--           data-placement="{{ app()->isLocale('ar') ? 'left' : 'right' }}"--}}
{{--           data-original-title="{{ trans('message.new_day') }}">--}}
{{--            <i class="icon-plus"></i> {{ trans('general.new_day') }}</a>--}}
{{--    </li>--}}
{{--@endcan--}}
