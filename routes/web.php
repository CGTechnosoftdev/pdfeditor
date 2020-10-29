<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
	Auth::routes();	
});

Route::group(['prefix' => 'admin','name'=>'admin.','namespace'=>'Admin','middleware'=>['auth']], function () {
	Route::get('/', 'DashboardController@index');
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

	//User Profile
	Route::get('/profile', 'ProfileController@index')->name('profile');
	Route::put('/update-profile', 'ProfileController@update')->name('update-profile');
	Route::get('/delete-profile-picture', 'ProfileController@deleteProfilePicture')->name('delete-profile-picture');

	//Change Status Universal
    Route::post('/change-status','DashboardController@changeStatus')->name('change-status');

	//roles
	Route::resource('roles', 'RolesController');

	//business-categories
	Route::resource('business-category', 'BusinessCategoryController');

    //subadmin
    Route::resource('sub-admin', 'SubAdminController');
	
});

// Route::get('/home', 'HomeController@index')->name('home');
