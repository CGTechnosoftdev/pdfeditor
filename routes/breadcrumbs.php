<?php

// Home
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard'));
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



// Home > top-100-form
Breadcrumbs::for('top-100-form.index', function ($trail) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Top 100 Form', route('top-100-form.index'));
});

// Home > roles > add
Breadcrumbs::for('top-100-form.create', function ($trail) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Top 100 Form', route('top-100-form.index'));
	$trail->push('Add Top 100 Form', route('top-100-form.create'));
});

// Home > roles > updated
Breadcrumbs::for('top-100-form.edit', function ($trail,$id) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Top 100 Form', route('top-100-form.index'));
	$trail->push('Edit Top 100 Form', route('top-100-form.edit',$id));
});



// Home > top-100-form
Breadcrumbs::for('top100form.form.list', function ($trail) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Form', route('top100form.form.list'));
});

// Home > roles > add
Breadcrumbs::for('top100form.form.create', function ($trail) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Form', route('top100form.form.list'));
	$trail->push('Add Form', route('top100form.form.create'));
});

// Home > roles > updated
Breadcrumbs::for('top100form.form.edit', function ($trail,$id) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Form', route('top100form.form.list'));
	$trail->push('Edit Form', route('top100form.form.edit',$id));
});


// Home > top-100-form
Breadcrumbs::for('top100form.faq.list', function ($trail) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Faq', route('top100form.faq.list'));
});

// Home > roles > add
Breadcrumbs::for('top100form.faq.create', function ($trail) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Faq', route('top100form.faq.list'));
	$trail->push('Add Faq', route('top100form.faq.create'));
});

// Home > roles > updated
Breadcrumbs::for('top100form.faq.edit', function ($trail,$id) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Faq', route('top100form.faq.list'));
	$trail->push('Edit Faq', route('top100form.faq.edit',$id));
});