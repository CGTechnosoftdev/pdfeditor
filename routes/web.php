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
	Route::get('/profile-update', 'ProfileController@update')->name('profileupdate');
	Route::post('/profile-update-save/{id}', 'ProfileController@updatesave')->name('profileupdatesave');
	Route::get('/delete-profile-image', 'ProfileController@deleteprofileimage')->name('deleteprofileimage');
	Route::post('/profile-password-change', 'ProfileController@profilepasschange')->name('profilepasswordchange');
	//
	
});

// Route::get('/home', 'HomeController@index')->name('home');
