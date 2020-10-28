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