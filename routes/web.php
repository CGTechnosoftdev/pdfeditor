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
	Route::patch('/update-password', 'ProfileController@updatePassword')->name('update-password');

	//Change Status Universal
    Route::post('/change-status','DashboardController@changeStatus')->name('change-status');

	//roles
    Route::resource('roles', 'RolesController');
	
});

// Route::get('/home', 'HomeController@index')->name('home');
