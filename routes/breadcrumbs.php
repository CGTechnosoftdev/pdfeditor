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



// Home > Business Category
Breadcrumbs::for('business_category.index', function ($trail) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Business Category', route('business-category.index'));
});

// Home > roles > add
Breadcrumbs::for('business_category.create', function ($trail) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Business Category', route('business-category.index'));
	$trail->push('Add Business Category', route('business-category.create'));
});

// Home > roles > updated
Breadcrumbs::for('business_category.edit', function ($trail,$id) {
	$trail->push('Dashboard', route('dashboard'));
	$trail->push('Business Category', route('business-category.index'));
	$trail->push('Edit Business Category', route('business-category.edit',$id));
});