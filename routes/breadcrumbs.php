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