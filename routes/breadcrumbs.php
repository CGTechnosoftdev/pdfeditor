<?php

// Home
Breadcrumbs::for('dashboard', function ($trail) {
	$trail->push('Dashboard', route('dashboard'));
});

// Update Profile
Breadcrumbs::for('profile', function ($trail) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Profile', route('profile'));
});
// Home > roles
Breadcrumbs::for('roles.index', function ($trail) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Roles and Rights', route('roles.index'));
});

// Home > roles > add
Breadcrumbs::for('roles.create', function ($trail) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Roles and Rights', route('roles.index'));
	$trail->push('Add Role and Rights', route('roles.create'));
});

// Home > roles > updated
Breadcrumbs::for('roles.edit', function ($trail,$id) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Roles and Rights', route('roles.index'));
	$trail->push('Edit Role and Rights', route('roles.edit',$id));
});


// Home > business-category
Breadcrumbs::for('business-category.index', function ($trail) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Business Category', route('business-category.index'));
});

// Home > business-category > add
Breadcrumbs::for('business-category.create', function ($trail) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Business Category', route('business-category.index'));
	$trail->push('Add Business Category', route('business-category.create'));
});

// Home > business-category > updated
Breadcrumbs::for('business-category.edit', function ($trail,$id) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Business Category', route('business-category.index'));
	$trail->push('Edit Business Category', route('business-category.edit',$id));
});

// Home > sub-admin
Breadcrumbs::for('sub-admin.index', function ($trail) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Sub-Admin', route('sub-admin.index'));
});

// Home > sub-admin > add
Breadcrumbs::for('sub-admin.create', function ($trail) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Sub-Admin', route('sub-admin.index'));
	$trail->push('Add Sub-Admin', route('sub-admin.create'));
});

// Home > sub-admin > updated
Breadcrumbs::for('sub-admin.edit', function ($trail,$id) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Sub-Admin', route('sub-admin.index'));
	$trail->push('Edit Sub-Admin', route('sub-admin.edit',$id));
});

// Home > sub-admin > show
Breadcrumbs::for('sub-admin.show', function ($trail,$id,$name) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Sub-Admin', route('sub-admin.index'));
	$trail->push($name.' Detail', route('sub-admin.edit',$id));
});

// Home > top-100-form
Breadcrumbs::for('top-100-form.index', function ($trail) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Top 100 Form', route('top-100-form.index'));
});

// Home > top100form > add
Breadcrumbs::for('top-100-form.create', function ($trail) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Top 100 Form', route('top-100-form.index'));
	$trail->push('Add Top 100 Form', route('top-100-form.create'));
});

// Home > top100form > updated
Breadcrumbs::for('top-100-form.edit', function ($trail,$id) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Top 100 Form', route('top-100-form.index'));
	$trail->push('Edit Top 100 Form', route('top-100-form.edit',$id));
});

// Home > subscription-plan > show
Breadcrumbs::for('top-100-form.show', function ($trail,$id,$name) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Top100Form', route('top-100-form.index'));
	$trail->push($name.' Detail', route('top-100-form.edit',$id));
});



// Home > top-100-form > version
Breadcrumbs::for('top100form.form.list', function ($trail,$id) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Form', route('top100form.form.list',$id));
});

// Home > top-100-form > version > add
Breadcrumbs::for('top100form.form.create', function ($trail,$id) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Form', route('top100form.form.list',$id));
	$trail->push('Add Form', route('top100form.form.create',$id));
});

// Home > top-100-form > version > updated
Breadcrumbs::for('top100form.form.edit', function ($trail,$top_id,$id) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Form', route('top100form.form.list',$id));
	$trail->push('Edit Form', route('top100form.form.edit',[$top_id,$id]));
});


// Home > top-100-form > faq > list
Breadcrumbs::for('top100form.faq.list', function ($trail,$id) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Faq', route('top100form.faq.list',$id));
});

// Home > top-100-form > faq > add
Breadcrumbs::for('top100form.faq.create', function ($trail,$id) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Faq', route('top100form.faq.list',$id));
	$trail->push('Add Faq', route('top100form.faq.create',$id));

});
// Home > top-100-form > faq > edit
Breadcrumbs::for('top100form.faq.edit', function ($trail,$top_id,$id) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Faq', route('top100form.faq.list',$id));
	$trail->push('Edit Faq', route('top100form.faq.edit',[$top_id,$id]));

});

// Home > subscription-plan
Breadcrumbs::for('subscription-plan.index', function ($trail) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Subscription Plan', route('subscription-plan.index'));
});

// Home > subscription-plan > add
Breadcrumbs::for('subscription-plan.create', function ($trail) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Subscription Plan', route('subscription-plan.index'));
	$trail->push('Subscription Category', route('subscription-plan.create'));
});

// Home > subscription-plan > updated
Breadcrumbs::for('subscription-plan.edit', function ($trail,$id) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Subscription Plan', route('subscription-plan.index'));
	$trail->push('Edit Subscription Plan', route('subscription-plan.edit',$id));
});

// Home > subscription-plan > show
Breadcrumbs::for('subscription-plan.show', function ($trail,$id,$name) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Subscription Plan', route('subscription-plan.index'));
	$trail->push($name.' Detail', route('subscription-plan.edit',$id));
});


// Home > promo-url
Breadcrumbs::for('promo-url.index', function ($trail) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Promo URL', route('promo-url.index'));
});

// Home > promo-url > add
Breadcrumbs::for('promo-url.create', function ($trail) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Promo URL', route('promo-url.index'));
	$trail->push('Add Promo URL', route('promo-url.create'));
});

// Home > promo-url > updated
Breadcrumbs::for('promo-url.edit', function ($trail,$id) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Promo URL', route('promo-url.index'));
	$trail->push('Edit Promo URL', route('promo-url.edit',$id));
});

// Home > email-template
Breadcrumbs::for('email-template.index', function ($trail) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Email Template', route('email-template.index'));
});
// Home > email-template > updated
Breadcrumbs::for('email-template.edit', function ($trail,$id) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Email Template', route('email-template.index'));
	$trail->push('Edit Email Template', route('email-template.edit',$id));
});