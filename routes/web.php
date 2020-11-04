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

Route::group(['prefix' => 'admin','name'=>'admin.','namespace'=>'Admin','middleware'=>['auth','preventBackHistory']], function () {
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
	//top-100-form

	Route::get('/top-100-form/form/{top_100_form}', 'Top100FormController@listForm')->name('top100form.form.list');
	Route::get('/top-100-form/create-form/{top_100_form}', 'Top100FormController@createForm')->name('top100form.form.create');
	Route::post('/top-100-form/store-form/{top_100_form}', 'Top100FormController@storeForm')->name('top100form.form.store');
	Route::get('/top-100-form/edit-form/{top_100_form}/{form}', 'Top100FormController@editForm')->name('top100form.form.edit');
	Route::put('/top-100-form/update-form/{top_100_form}/{form}', 'Top100FormController@updateForm')->name('top100form.form.update');
	Route::delete('/top-100-form/destroy-form/{top_100_form}/{form}', 'Top100FormController@destroyForm')->name('top100form.form.destroy');
	


	Route::get('/top-100-form/faq/{top_100_form}', 'Top100FormController@listFaq')->name('top100form.faq.list');
	Route::get('/top-100-form/create-faq/{top_100_form}', 'Top100FormController@createFaq')->name('top100form.faq.create');
	Route::post('/top-100-form/store-faq/{top_100_form}', 'Top100FormController@storeFaq')->name('top100form.faq.store');
	Route::get('/top-100-form/edit-faq/{top_100_form}/{faq}', 'Top100FormController@editFaq')->name('top100form.faq.edit');
	Route::put('/top-100-form/update-faq/{top_100_form}/{faq}', 'Top100FormController@updateFaq')->name('top100form.faq.update');
	Route::delete('/top-100-form/destroy-faq/{top_100_form}/{faq}', 'Top100FormController@destroyFaq')->name('top100form.faq.destroy');

	Route::resource('top-100-form', 'Top100FormController');

	//business-categories
	Route::resource('business-category', 'BusinessCategoryController');

    //subadmin
    Route::resource('sub-admin', 'SubAdminController');
	
});

// Route::get('/home', 'HomeController@index')->name('home');
