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