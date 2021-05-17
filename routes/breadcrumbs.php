<?php

// frontend
Breadcrumbs::for('frontend.home', function ($trail) {
    $trail->push(trans('general.home'), route('frontend.home'));
});

Breadcrumbs::for('login', function ($trail) {
    $trail->parent('frontend.home');
    $trail->push(trans('general.login'), route('login'));
});

Breadcrumbs::for('register', function ($trail) {
    $trail->parent('frontend.home');
    $trail->push(trans('general.register'), route('register'));
});

Breadcrumbs::for('frontend.product.index', function ($trail) {
    $trail->parent('frontend.home');
    $trail->push(trans('general.products'), route('frontend.product.search'));
});
Breadcrumbs::for('frontend.product.show', function ($trail, $element) {
    $trail->parent('frontend.product.index');
    $trail->push($element->name, route('frontend.product.show', $element->id));
});

Breadcrumbs::for('frontend.product.compare', function ($trail) {
    $trail->parent('frontend.product.index');
    $trail->push(trans('general.compare'), route('frontend.product.compare'));
});

Breadcrumbs::for('frontend.collection.index', function ($trail) {
    $trail->parent('frontend.home');
    $trail->push(trans('general.collections'), route('frontend.collection.index'));
});
Breadcrumbs::for('frontend.collection.show', function ($trail, $element) {
    $trail->parent('frontend.collection.index');
    $trail->push($element->name, route('frontend.collection.show', $element->id));
});

Breadcrumbs::for('frontend.service.index', function ($trail) {
    $trail->parent('frontend.home');
    $trail->push(trans('general.services'), route('frontend.service.search'));
});

Breadcrumbs::for('frontend.service.show', function ($trail, $element) {
    $trail->parent('frontend.home');
    $trail->push($element->name, route('frontend.service.show', $element->id));
});

Breadcrumbs::for('frontend.classified.index', function ($trail) {
    $trail->parent('frontend.home');
    $trail->push(trans('general.classifieds'), route('frontend.classified.search'));
});
Breadcrumbs::for('frontend.classified.show', function ($trail, $element) {
    $trail->parent('frontend.classified.index');
    $trail->push($element->name, route('frontend.classified.show', $element->id));
});

Breadcrumbs::for('frontend.classified.create', function ($trail) {
    $trail->parent('frontend.classified.index');
    $trail->push(trans('general.create_classified'), route('frontend.classified.create'));
});

Breadcrumbs::for('frontend.brand.index', function ($trail) {
    $trail->parent('frontend.home');
    $trail->push(trans('general.brands'), route('frontend.brand.index'));
});

Breadcrumbs::for('frontend.category.index', function ($trail) {
    $trail->parent('frontend.home');
    $trail->push(trans('general.categories'), route('frontend.category.index'));
});

Breadcrumbs::for('frontend.category.show', function ($trail, $element) {
    $trail->parent('frontend.category.index');
    $trail->push($element->name, route('frontend.category.show', $element->id));
});


Breadcrumbs::for('frontend.cart.index', function ($trail) {
    $trail->parent('frontend.home');
    $trail->push(trans('general.cart'), route('frontend.cart.index'));
});

Breadcrumbs::for('frontend.cart.show', function ($trail) {
    $trail->parent('frontend.cart.index');
    $trail->push(trans('general.cart_confirmation'), route('frontend.cart.show'));
});

Breadcrumbs::for('frontend.user.index', function ($trail) {
    $trail->parent('frontend.home');
    $trail->push(trans('general.companies'), route('frontend.user.index'));
});

Breadcrumbs::for('frontend.user.show', function ($trail, $element) {
    $trail->parent('frontend.home');
    $trail->push($element->name, route('frontend.user.show', $element->id));
});

Breadcrumbs::for('frontend.user.edit', function ($trail, $element) {
    $trail->parent('frontend.order.index');
    $trail->push($element->name, route('frontend.user.show', $element->id));
});


Breadcrumbs::for('frontend.page.show', function ($trail, $element) {
    $trail->parent('frontend.home');
    $trail->push($element->title, route('frontend.page.show', $element->id));
});

Breadcrumbs::for('frontend.post.index', function ($trail) {
    $trail->parent('frontend.home');
    $trail->push(trans('general.posts'), route('frontend.post.index'));
});

Breadcrumbs::for('frontend.post.show', function ($trail, $element) {
    $trail->parent('frontend.post.index');
    $trail->push($element->title_en, route('frontend.post.show', $element->id));
});

Breadcrumbs::for('frontend.order.index', function ($trail) {
    $trail->parent('frontend.home');
    $trail->push(trans('general.my_account'), route('frontend.order.index'));
});

Breadcrumbs::for('frontend.address.create', function ($trail) {
    $trail->parent('frontend.address.index');
    $trail->push(trans('general.create'), route('frontend.address.create'));
});

Breadcrumbs::for('frontend.address.index', function ($trail) {
    $trail->parent('frontend.order.index');
    $trail->push(trans('general.addresses'), route('frontend.address.index'));
});

Breadcrumbs::for('backend.address.create', function ($trail) {
    $trail->parent('backend.address.index');
    $trail->push(trans('general.new_address'), route('backend.address.create'));
});

Breadcrumbs::for('frontend.address.edit', function ($trail, $element) {
    $trail->parent('frontend.address.index');
    $trail->push(trans('general.edit'), route('backend.address.edit', $element->id));
});

Breadcrumbs::for('frontend.favorite.index', function ($trail) {
    $trail->parent('frontend.home');
    $trail->push(trans('general.wish_list'), route('frontend.favorite.index'));
});

Breadcrumbs::for('frontend.fan.index', function ($trail) {
    $trail->parent('frontend.home');
    $trail->push(trans('general.fans'), route('frontend.fan.index'));
});

Breadcrumbs::for('frontend.survey.show', function ($trail, $element) {
    $trail->parent('frontend.home');
    $trail->push(trans('general.survey'), route('frontend.survey.show', $element->id));
});

Breadcrumbs::for('password.email', function ($trail) {
    $trail->parent('frontend.home');
    $trail->push(trans('general.forget_password'), route('password.email'));
});


// backend

// Admin
Breadcrumbs::for('backend.home', function ($trail) {
    $trail->push(trans('general.home'), route('backend.home'));
});

Breadcrumbs::for('backend.index', function ($trail) {
    $trail->push('Home', route('backend.home'));
});

// Home > About
Breadcrumbs::for('backend.admin.user.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.users'), route('backend.admin.user.index'));
});


// Home > Blog
Breadcrumbs::for('backend.product.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.products'), route('backend.product.index'));
});

Breadcrumbs::for('backend.product.trashed', function ($trail) {
    $trail->parent('backend.product.index');
    $trail->push('trashed', route('backend.product.trashed'));
});

Breadcrumbs::for('backend.admin.comment.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.comments'), route('backend.admin.comment.index'));
});


Breadcrumbs::for('backend.product.restore', function ($trail) {
    $trail->parent('backend.product.index');
    $trail->push('restore product', route('backend.product.restore'));
});

Breadcrumbs::for('backend.attribute.index', function ($trail) {
    $trail->parent('backend.product.index');
    //    $trail->push('products', route('backend.product.index'));
});

Breadcrumbs::for('backend.category.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.categories'), route('backend.category.index'));
});


Breadcrumbs::for('backend.collection.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.collections'), route('backend.collection.index'));
});

Breadcrumbs::for('backend.collection.create', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.new_collection'), route('backend.collection.create'));
});

Breadcrumbs::for('backend.collection.edit', function ($trail, $element) {
    $trail->parent('backend.collection.index');
    $trail->push(trans('general.edit_collection'), route('backend.collection.edit', $element->id));
});

Breadcrumbs::for('backend.survey.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push('surveys', route('backend.survey.index'));
});

Breadcrumbs::for('backend.question.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push('questions', route('backend.question.index'));
});

Breadcrumbs::for('backend.answer.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push('answers', route('backend.answer.index'));
});

Breadcrumbs::for('backend.questionnaire.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push('questionnaires', route('backend.questionnaire.index'));
});

Breadcrumbs::for('backend.tag.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push('tags', route('backend.tag.index'));
});

Breadcrumbs::for('backend.brand.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push('brands', route('backend.brand.index'));
});

Breadcrumbs::for('backend.admin.color.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_color'), route('backend.admin.color.index'));
});

Breadcrumbs::for('backend.admin.color.create', function ($trail) {
    $trail->parent('backend.admin.color.index');
    $trail->push(trans('general.new_color'), route('backend.admin.color.create'));
});

Breadcrumbs::for('backend.admin.color.edit', function ($trail, $element) {
    $trail->parent('backend.admin.color.index');
    $trail->push(trans('general.edit_color'), route('backend.admin.color.edit', $element->id));
});

Breadcrumbs::for('backend.admin.newsletter.create', function ($trail) {
    $trail->parent('backend.admin.newsletter.index');
    $trail->push(trans('general.new_newsletter'), route('backend.admin.newsletter.create'));
});
Breadcrumbs::for('backend.admin.newsletter.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_newsletter'), route('backend.admin.newsletter.index'));
});

Breadcrumbs::for('backend.admin.role.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_role'), route('backend.admin.role.index'));
});
Breadcrumbs::for('backend.admin.role.create', function ($trail) {
    $trail->parent('backend.admin.role.index');
    $trail->push(trans('general.new_role'), route('backend.admin.role.create'));
});
Breadcrumbs::for('backend.admin.role.edit', function ($trail) {
    $trail->parent('backend.admin.role.index');
    $trail->push(trans('general.edit_role'), route('backend.admin.role.edit'));
});
Breadcrumbs::for('backend.admin.setting.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.settings'), route('backend.admin.setting.index'));
});

Breadcrumbs::for('backend.admin.order.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_order'), route('backend.admin.order.index'));
});

Breadcrumbs::for('backend.admin.order.edit', function ($trail, $element) {
    $trail->parent('backend.admin.order.index');
    $trail->push(trans('general.edit_order'), route('backend.admin.order.edit', $element->id));
});

Breadcrumbs::for('backend.admin.day.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_day'), route('backend.admin.day.index'));
});

Breadcrumbs::for('backend.admin.day.edit', function ($trail, $element) {
    $trail->parent('backend.admin.day.index');
    $trail->push(trans('general.edit_day'), route('backend.admin.day.edit', $element));
});

Breadcrumbs::for('backend.order.show', function ($trail, $element) {
    $trail->parent('backend.order.index');
    $trail->push('order details', route('backend.order.show', $element));
});

Breadcrumbs::for('backend.questionnaire.show', function ($trail, $element) {
    $trail->parent('backend.questionnaire.index');
    $trail->push('questionnaire details', route('backend.questionnaire.show', $element));
});

Breadcrumbs::for('backend.admin.questionnaire.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_questionnaire'), route('backend.admin.questionnaire.index'));
});

Breadcrumbs::for('backend.admin.questionnaire.create', function ($trail) {
    $trail->parent('backend.admin.questionnaire.index');
    $trail->push(trans('general.new_questionnaire'), route('backend.admin.questionnaire.create'));
});

Breadcrumbs::for('backend.admin.commercial.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_commercial'), route('backend.admin.commercial.index'));
});

Breadcrumbs::for('backend.admin.commercial.create', function ($trail) {
    $trail->parent('backend.admin.commercial.index');
    $trail->push(trans('general.new_commercial'), route('backend.admin.commercial.create'));
});

Breadcrumbs::for('backend.admin.commercial.edit', function ($trail, $element) {
    $trail->parent('backend.admin.commercial.index');
    $trail->push(trans('general.edit_commercial'), route('backend.admin.commercial.edit', $element->id));
});

Breadcrumbs::for('backend.admin.term.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_term'), route('backend.admin.term.index'));
});
Breadcrumbs::for('backend.admin.term.create', function ($trail) {
    $trail->parent('backend.admin.term.index');
    $trail->push(trans('general.new_term'), route('backend.admin.term.create'));
});

Breadcrumbs::for('backend.timing.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_timing'), route('backend.timing.index'));
});
Breadcrumbs::for('backend.timing.create', function ($trail) {
    $trail->parent('backend.timing.index');
    $trail->push(trans('general.new_timing'), route('backend.timing.create'));
});

Breadcrumbs::for('backend.timing.edit', function ($trail, $element) {
    $trail->parent('backend.timing.index');
    $trail->push(trans('general.edit_timing'), route('backend.timing.edit', $element->id));
});

Breadcrumbs::for('backend.admin.privilege.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_privilege'), route('backend.admin.privilege.index'));
});
Breadcrumbs::for('backend.admin.privilege.edit', function ($trail, $element) {
    $trail->parent('backend.admin.privilege.index');
    $trail->push($element->name, route('backend.admin.privilege.edit', $element->id));
});

Breadcrumbs::for('backend.admin.privilege.show', function ($trail, $element) {
    $trail->parent('backend.admin.privilege.index');
    $trail->push($element->name . ' - ' . $element->slug, route('backend.admin.privilege.show', $element->id));
});

Breadcrumbs::for('backend.admin.privilege.create', function ($trail) {
    $trail->parent('backend.admin.privilege.index');
    $trail->push(trans('general.new_privilege'), route('backend.admin.privilege.create'));
});
Breadcrumbs::for('backend.admin.faq.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_faq'), route('backend.admin.faq.index'));
});

Breadcrumbs::for('backend.admin.faq.create', function ($trail) {
    $trail->parent('backend.admin.faq.index');
    $trail->push(trans('general.new_faq'), route('backend.admin.faq.index'));
});

Breadcrumbs::for('backend.admin.device.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_device'), route('backend.admin.device.index'));
});

Breadcrumbs::for('backend.admin.device.create', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.create_device'), route('backend.admin.device.create'));
});

Breadcrumbs::for('backend.admin.device.edit', function ($trail, $element) {
    $trail->parent('backend.home');
    $trail->push(trans('general.edit_device'), route('backend.admin.device.edit', $element->id));
});


Breadcrumbs::for('backend.admin.notification.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_notification'), route('backend.admin.notification.index'));
});
Breadcrumbs::for('backend.admin.notification.create', function ($trail) {
    $trail->parent('backend.admin.notification.index');
    $trail->push(trans('general.new_notification'), route('backend.admin.notification.create'));
});

Breadcrumbs::for('backend.admin.policy.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_policy'), route('backend.admin.policy.index'));
});
Breadcrumbs::for('backend.admin.policy.create', function ($trail) {
    $trail->parent('backend.admin.policy.index');
    $trail->push(trans('general.new_policy'), route('backend.admin.policy.create'));
});


Breadcrumbs::for('backend.admin.aboutus.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_aboutus'), route('backend.admin.aboutus.index'));
});

Breadcrumbs::for('backend.admin.currency.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_currency'), route('backend.admin.currency.index'));
});


Breadcrumbs::for('backend.admin.governate.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_governate'), route('backend.admin.governate.index'));
});

Breadcrumbs::for('backend.admin.governate.create', function ($trail) {
    $trail->parent('backend.admin.governate.index');
    $trail->push(trans('general.new_governate'), route('backend.admin.governate.create'));
});

Breadcrumbs::for('backend.admin.governate.edit', function ($trail, $element) {
    $trail->parent('backend.admin.governate.index');
    $trail->push(trans('general.edit_governate'), route('backend.admin.governate.edit', $element->id));
});

Breadcrumbs::for('backend.admin.area.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_area'), route('backend.admin.area.index'));
});

Breadcrumbs::for('backend.admin.area.create', function ($trail) {
    $trail->parent('backend.admin.area.index');
    $trail->push(trans('general.new_area'), route('backend.admin.area.create'));
});

Breadcrumbs::for('backend.admin.area.edit', function ($trail, $element) {
    $trail->parent('backend.admin.area.index');
    $trail->push(trans('general.edit_area'), route('backend.admin.area.edit', $element->id));
});

Breadcrumbs::for('backend.admin.currency.create', function ($trail) {
    $trail->parent('backend.admin.currency.index');
    $trail->push(trans('general.new_currency'), route('backend.admin.currency.create'));
});

Breadcrumbs::for('backend.admin.currency.edit', function ($trail, $element) {
    $trail->parent('backend.admin.currency.index');
    $trail->push(trans('general.new_currency'), route('backend.admin.currency.edit', $element->id));
});

Breadcrumbs::for('backend.admin.coupon.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_coupon'), route('backend.admin.coupon.index'));
});
Breadcrumbs::for('backend.admin.coupon.create', function ($trail) {
    $trail->parent('backend.admin.coupon.index');
    $trail->push(trans('general.new_coupon'), route('backend.admin.coupon.create'));
});

Breadcrumbs::for('backend.service.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_service'), route('backend.service.index'));
});
Breadcrumbs::for('backend.service.create', function ($trail) {
    $trail->parent('backend.service.index');
    $trail->push(trans('general.new_service'), route('backend.service.create'));
});
Breadcrumbs::for('backend.service.edit', function ($trail, $element) {
    $trail->parent('backend.service.index');
    $trail->push(trans('general.edit_service'), route('backend.service.edit', $element));
});


// addon
Breadcrumbs::for('backend.admin.addon.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_addon'), route('backend.admin.addon.index'));
});
Breadcrumbs::for('backend.admin.addon.create', function ($trail) {
    $trail->parent('backend.admin.addon.index');
    $trail->push(trans('general.new_addon'), route('backend.admin.addon.create'));
});
Breadcrumbs::for('backend.admin.addon.edit', function ($trail, $element) {
    $trail->parent('backend.admin.addon.index');
    $trail->push(trans('general.edit_addon'), route('backend.admin.addon.edit', $element));
});

//item
Breadcrumbs::for('backend.admin.item.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_item'), route('backend.admin.item.index'));
});
Breadcrumbs::for('backend.admin.item.create', function ($trail) {
    $trail->parent('backend.admin.item.index');
    $trail->push(trans('general.new_item'), route('backend.admin.item.create'));
});
Breadcrumbs::for('backend.admin.item.edit', function ($trail, $element) {
    $trail->parent('backend.admin.item.index');
    $trail->push(trans('general.edit_item'), route('backend.admin.item.edit', $element));
});


Breadcrumbs::for('backend.classified.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_classified'), route('backend.classified.index'));
});
Breadcrumbs::for('backend.classified.create', function ($trail) {
    $trail->parent('backend.classified.index');
    $trail->push(trans('general.new_classified'), route('backend.classified.create'));
});
Breadcrumbs::for('backend.classified.edit', function ($trail, $element) {
    $trail->parent('backend.classified.index');
    $trail->push(trans('general.edit_classified'), route('backend.classified.edit', $element));
});

Breadcrumbs::for('backend.property.attach', function ($trail, $element) {
    $trail->parent('backend.classified.index');
    $trail->push(trans('general.attach_properties'), route('backend.property.attach', $element));
});

Breadcrumbs::for('backend.admin.property.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_property'), route('backend.admin.property.index'));
});
Breadcrumbs::for('backend.admin.property.create', function ($trail) {
    $trail->parent('backend.admin.property.index');
    $trail->push(trans('general.new_property'), route('backend.admin.property.create'));
});
Breadcrumbs::for('backend.admin.property.edit', function ($trail, $element) {
    $trail->parent('backend.admin.property.index');
    $trail->push(trans('general.edit_property'), route('backend.admin.property.edit', $element));
});

Breadcrumbs::for('backend.admin.group.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_group'), route('backend.admin.group.index'));
});
Breadcrumbs::for('backend.admin.group.create', function ($trail) {
    $trail->parent('backend.admin.group.index');
    $trail->push(trans('general.new_group'), route('backend.admin.group.create'));
});
Breadcrumbs::for('backend.admin.group.edit', function ($trail, $element) {
    $trail->parent('backend.admin.group.index');
    $trail->push(trans('general.edit_group'), route('backend.admin.group.edit', $element));
});


Breadcrumbs::for('backend.slide.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_slide'), route('backend.slide.index', ['slidable_id' => request('slidable_id'), 'slidable_type' => request('slidable_type')]));
});

Breadcrumbs::for('backend.slide.create', function ($trail) {
    $trail->parent('backend.slide.index');
    $trail->push(trans("general.new_slide"), route('backend.slide.create'));
});

Breadcrumbs::for('backend.slide.edit', function ($trail, $element) {
    $trail->parent('backend.slide.index');
    $trail->push(trans("general.edit_slide"), route('backend.slide.edit', $element->id));
});

Breadcrumbs::for('backend.video.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_video'), route('backend.video.index', ['videoable_id' => request('videoable_id'), 'videoable_type' => request('videoable_type')]));
});

Breadcrumbs::for('backend.video.create', function ($trail) {
    $trail->parent('backend.video.index');
    $trail->push(trans("general.new_video"), route('backend.video.create'));
});

Breadcrumbs::for('backend.video.edit', function ($trail, $element) {
    $trail->parent('backend.video.index');
    $trail->push(trans("general.edit_video"), route('backend.video.edit', $element->id));
});

Breadcrumbs::for('backend.excel.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_excel'), route('backend.excel.index'));
});

Breadcrumbs::for('backend.admin.survey.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans("general.index_survey"), route('backend.admin.survey.index'));
});

Breadcrumbs::for('backend.admin.survey.create', function ($trail) {
    $trail->parent('backend.admin.survey.index');
    $trail->push(trans("general.new_survey"), route('backend.admin.survey.create'));
});


Breadcrumbs::for('backend.admin.survey.edit', function ($trail, $element) {
    $trail->parent('backend.admin.survey.index');
    $trail->push(trans('general.edit'), route('backend.admin.survey.edit', $element->id));
});

Breadcrumbs::for('backend.question.create', function ($trail) {
    $trail->parent('backend.question.index');
    $trail->push('create question', route('backend.question.create'));
});

Breadcrumbs::for('backend.question.edit', function ($trail, $element) {
    $trail->parent('backend.question.index');
    $trail->push('edit question', route('backend.question.edit', $element->id));
});

Breadcrumbs::for('backend.admin.answer.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans("general.index_answer"), route('backend.admin.answer.index'));
});
Breadcrumbs::for('backend.admin.answer.create', function ($trail) {
    $trail->parent('backend.admin.answer.index');
    $trail->push(trans("general.new_answer"), route('backend.admin.answer.create'));
});

Breadcrumbs::for('backend.answer.edit', function ($trail, $element) {
    $trail->parent('backend.answer.index');
    $trail->push('edit answer', route('backend.answer.edit', $element->id));
});

Breadcrumbs::for('backend.attribute.create', function ($trail, $element) {
    $trail->parent('backend.product.index');
    $trail->push(trans('general.new_product_attribute'), route('backend.attribute.create', ['id' => $element->id]));
});

Breadcrumbs::for('backend.attribute.edit', function ($trail, $element) {
    $trail->parent('backend.attribute.index');
    $trail->push(trans('general.edit_product_attribute'), route('backend.attribute.edit', $element->id));
});


Breadcrumbs::for('backend.coupon.create', function ($trail) {
    $trail->parent('backend.coupon.index');
    $trail->push('create coupon', route('backend.coupon.create'));
});

Breadcrumbs::for('backend.coupon.edit', function ($trail, $element) {
    $trail->parent('backend.coupon.index');
    $trail->push('edit coupon', route('backend.coupon.edit', $element->id));
});

Breadcrumbs::for('backend.product.create', function ($trail) {
    $trail->parent('backend.product.index');
    $trail->push(trans("general.new_product"), route('backend.product.create'));
});

Breadcrumbs::for('backend.product.edit', function ($trail, $element) {
    $trail->parent('backend.product.index');
    $trail->push(trans('general.edit_product'), route('backend.product.edit', $element->id));
});

Breadcrumbs::for('backend.admin.setting.edit', function ($trail, $element) {
    $trail->parent('backend.admin.setting.index');
    $trail->push(trans('general.edit'), route('backend.admin.setting.edit', $element->id));
});

Breadcrumbs::for('backend.color.create', function ($trail) {
    $trail->parent('backend.color.index');
    $trail->push('create color', route('backend.color.create'));
});

Breadcrumbs::for('backend.color.edit', function ($trail, $element) {
    $trail->parent('backend.color.index');
    $trail->push('edit color', route('backend.color.edit', $element->id));
});

Breadcrumbs::for('backend.admin.size.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_size'), route('backend.admin.size.index'));
});
Breadcrumbs::for('backend.admin.size.create', function ($trail) {
    $trail->parent('backend.admin.size.index');
    $trail->push(trans('general.new_size'), route('backend.admin.size.create'));
});

Breadcrumbs::for('backend.admin.size.edit', function ($trail, $element) {
    $trail->parent('backend.admin.size.index');
    $trail->push('edit size', route('backend.admin.size.edit', $element->id));
});

Breadcrumbs::for('backend.admin.country.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.countries'), route('backend.admin.country.index'));
});
Breadcrumbs::for('backend.admin.country.create', function ($trail) {
    $trail->parent('backend.admin.country.index');
    $trail->push(trans('general.new_country'), route('backend.admin.country.create'));
});

Breadcrumbs::for('backend.admin.country.edit', function ($trail, $element) {
    $trail->parent('backend.admin.country.index');
    $trail->push('edit country', route('backend.admin.country.edit', $element->id));
});

Breadcrumbs::for('backend.admin.address.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.countries'), route('backend.admin.address.index'));
});
Breadcrumbs::for('backend.admin.address.create', function ($trail) {
    $trail->parent('backend.admin.address.index');
    $trail->push(trans('general.new_address'), route('backend.admin.address.create'));
});

Breadcrumbs::for('backend.admin.address.edit', function ($trail, $element) {
    $trail->parent('backend.admin.address.index');
    $trail->push('edit address', route('backend.admin.address.edit', $element->id));
});

Breadcrumbs::for('backend.admin.tag.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_tag'), route('backend.admin.tag.index'));
});
Breadcrumbs::for('backend.admin.tag.create', function ($trail) {
    $trail->parent('backend.admin.tag.index');
    $trail->push(trans('general.new_tag'), route('backend.admin.tag.create'));
});

Breadcrumbs::for('backend.tag.edit', function ($trail, $element) {
    $trail->parent('backend.tag.index');
    $trail->push('edit tag', route('backend.tag.edit', $element->id));
});

Breadcrumbs::for('backend.admin.brand.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_brand'), route('backend.admin.brand.index'));
});
Breadcrumbs::for('backend.admin.brand.create', function ($trail) {
    $trail->parent('backend.admin.brand.index');
    $trail->push(trans('general.new_brand'), route('backend.admin.brand.create'));
});

Breadcrumbs::for('backend.admin.brand.edit', function ($trail, $element) {
    $trail->parent('backend.admin.brand.index');
    $trail->push('edit brand', route('backend.admin.brand.edit', $element->id));
});

Breadcrumbs::for('backend.reset.password', function ($trail) {
    $trail->parent('backend.user.index');
});

Breadcrumbs::for('backend.admin.user.create', function ($trail) {
    $trail->parent('backend.admin.user.index');
    $trail->push(trans('general.new_user'), route('backend.admin.user.create'));
});
Breadcrumbs::for('backend.admin.user.edit', function ($trail, $element) {
    $trail->parent('backend.admin.user.index');
    $trail->push(trans('general.edit_user'), route('backend.admin.user.edit', $element->id));
});


Breadcrumbs::for('backend.user.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_user'), route('backend.home'));
});
Breadcrumbs::for('backend.user.edit', function ($trail, $element) {
    $trail->parent('backend.user.index');
    $trail->push(trans('general.edit_user'), route('backend.user.edit', $element->id));
});

Breadcrumbs::for('backend.user.show', function ($trail, $element) {
    $trail->parent('backend.user.index');
    $trail->push(trans('general.profile'), route('backend.user.show', $element->id));
});

Breadcrumbs::for('backend.slider.create', function ($trail) {
    $trail->parent('backend.slider.index');
    $trail->push('create slider', route('backend.slider.create'));
});

Breadcrumbs::for('backend.slider.edit', function ($trail, $element) {
    $trail->parent('backend.slider.index');
    $trail->push('edit slider', route('backend.slider.edit', $element->id));
});


Breadcrumbs::for('backend.gallery.create', function ($trail) {
    $trail->parent('backend.gallery.index');
    $trail->push(request()->type, route('backend.' . request()->type . '.index'));
    return $trail->push('create gallery', route('backend.gallery.create', ['type' => request()->type, 'element_id' => request()->element_id]));
});

Breadcrumbs::for('backend.gallery.edit', function ($trail, $element) {
    $trail->parent('backend.gallery.index');
    $className = strtolower(class_basename($element->galleryable));
    $trail->push($className, route('backend.' . $className . '.index'));
    return $trail->push('edit gallery', route('backend.gallery.edit', ['id' => $element->id, 'type' => $className, 'element_id' => $element->galleryable->id]));
});

Breadcrumbs::for('backend.admin.category.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.categories'), route('backend.admin.category.index'));
});


Breadcrumbs::for('backend.admin.category.create', function ($trail) {
    $trail->parent('backend.admin.category.index');
    $trail->push(trans('general.new_category'), route('backend.admin.category.create'));
});

Breadcrumbs::for('backend.admin.category.edit', function ($trail, $element) {
    $trail->parent('backend.admin.category.index');
    $trail->push(trans('general.edit_category'), route('backend.admin.category.edit', $element->id));
});


Breadcrumbs::for('backend.admin.collection.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.collections'), route('backend.admin.collection.index'));
});

Breadcrumbs::for('backend.admin.collection.create', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.new_collection'), route('backend.admin.collection.create'));
});

Breadcrumbs::for('backend.admin.collection.edit', function ($trail, $element) {
    $trail->parent('backend.admin.collection.index');
    $trail->push(trans('general.edit_collection'), route('backend.admin.collection.edit', $element->id));
});

Breadcrumbs::for('backend.admin.aboutus.create', function ($trail) {
    $trail->parent('backend.admin.aboutus.index');
    $trail->push(trans('general.new_aboutus'), route('backend.admin.aboutus.create'));
});

Breadcrumbs::for('backend.aboutus.edit', function ($trail, $element) {
    $trail->parent('backend.aboutus.index');
    $trail->push('edit aboutus', route('backend.aboutus.edit', $element->id));
});
Breadcrumbs::for('backend.admin.page.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_page'), route('backend.admin.page.index'));
});

Breadcrumbs::for('backend.admin.page.create', function ($trail) {
    $trail->parent('backend.admin.page.index');
    $trail->push(trans('general.new_page'), route('backend.admin.page.create'));
});

Breadcrumbs::for('backend.admin.page.edit', function ($trail, $element) {
    $trail->parent('backend.admin.page.index');
    $trail->push(trans('general.edit_page'), route('backend.admin.page.edit', $element->id));
});

Breadcrumbs::for('backend.page.edit', function ($trail, $element) {
    $trail->parent('backend.page.index');
    $trail->push('edit page', route('backend.page.edit', $element->id));
});


Breadcrumbs::for('backend.post.index', function ($trail) {
    $trail->parent('backend.home');
    $trail->push(trans('general.index_post'), route('backend.post.index'));
});

Breadcrumbs::for('backend.post.create', function ($trail) {
    $trail->parent('backend.post.index');
    $trail->push(trans('general.new_post'), route('backend.post.create'));
});

Breadcrumbs::for('backend.post.edit', function ($trail, $element) {
    $trail->parent('backend.post.index');
    $trail->push(trans('general.edit_post'), route('backend.post.edit', $element->id));
});

Breadcrumbs::for('backend.term.create', function ($trail) {
    $trail->parent('backend.term.index');
    $trail->push('create term', route('backend.term.create'));
});

Breadcrumbs::for('backend.term.edit', function ($trail, $element) {
    $trail->parent('backend.term.index');
    $trail->push('edit term', route('backend.term.edit', $element->id));
});

Breadcrumbs::for('backend.faq.create', function ($trail) {
    $trail->parent('backend.faq.index');
    $trail->push('create faq', route('backend.faq.create'));
});

Breadcrumbs::for('backend.faq.edit', function ($trail, $element) {
    $trail->parent('backend.faq.index');
    $trail->push('edit faq', route('backend.faq.edit', $element->id));
});

Breadcrumbs::for('backend.notification.create', function ($trail) {
    $trail->parent('backend.notification.index');
    $trail->push('create Notification', route('backend.notification.create'));
});

Breadcrumbs::for('backend.notification.edit', function ($trail, $element) {
    $trail->parent('backend.notification.index');
    $trail->push('edit notification', route('backend.notification.edit', $element->id));
});


Breadcrumbs::for('backend.policy.create', function ($trail) {
    $trail->parent('backend.policy.index');
    $trail->push('create policy', route('backend.policy.create'));
});

Breadcrumbs::for('backend.policy.edit', function ($trail, $element) {
    $trail->parent('backend.policy.index');
    $trail->push('edit policy', route('backend.policy.edit', $element->id));
});


Breadcrumbs::for('backend.currency.create', function ($trail) {
    $trail->parent('backend.currency.index');
    $trail->push('create currency', route('backend.currency.create'));
});

Breadcrumbs::for('backend.currency.edit', function ($trail, $element) {
    $trail->parent('backend.currency.index');
    return $trail->push('edit currency', route('backend.currency.edit', $element->id));
});


Breadcrumbs::for('backend.image.edit', function ($trail, $element) {
    $trail->parent('backend.gallery.edit', $element->gallery);
    return $trail->push('edit image', route('backend.image.edit', $element->id));
});

Breadcrumbs::for('backend.package.index', function ($trail) {
    $trail->parent('backend.home');
    return $trail->push(trans('general.index_package'), route('backend.package.index'));
});

Breadcrumbs::for('backend.package.create', function ($trail) {
    $trail->parent('backend.package.index');
    return $trail->push(trans('general.new_package'), route('backend.package.create'));
});

Breadcrumbs::for('backend.package.edit', function ($trail, $element) {
    $trail->parent('backend.package.index');
    return $trail->push('edit package', route('backend.package.edit', $element->id));
});

Breadcrumbs::for('backend.branch.index', function ($trail) {
    $trail->parent('backend.home');
    return $trail->push(trans('general.index_branch'), route('backend.branch.index'));
});

Breadcrumbs::for('backend.branch.create', function ($trail) {
    $trail->parent('backend.branch.index');
    return $trail->push(trans('general.new_branch'), route('backend.branch.create'));
});

Breadcrumbs::for('backend.branch.edit', function ($trail, $element) {
    $trail->parent('backend.branch.index');
    return $trail->push('edit branch', route('backend.branch.edit', $element->id));
});
