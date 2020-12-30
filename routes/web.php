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

Route::group(['prefix' => 'admin'], function () {
	Auth::routes(['register' => false]);
	Route::group(['namespace' => 'Admin', 'middleware' => ['auth:web', 'preventBackHistory']], function () {
		Route::get('/', 'DashboardController@index');
		Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

		//User Profile
		Route::get('/profile', 'ProfileController@index')->name('profile');
		Route::put('/update-profile', 'ProfileController@update')->name('update-profile');
		Route::get('/delete-profile-picture', 'ProfileController@deleteProfilePicture')->name('delete-profile-picture');

		//Change Status Universal
		Route::post('/change-status', 'DashboardController@changeStatus')->name('change-status');

		//roles	
		Route::resource('roles', 'RolesController', ['except' => ['show']]);
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
		Route::resource('business-category', 'BusinessCategoryController', ['except' => ['show']]);

		//document-type
		Route::resource('document-type', 'DocumentTypeController', ['except' => ['show']]);

		//document-template
		Route::resource('document-template', 'DocumentTemplateController', ['except' => ['show']]);

		//subadmin
		Route::resource('sub-admin', 'SubAdminController');

		//general-setting
		Route::resource('general-setting', 'GeneralSettingsController', ['only' => ['index']]);
		Route::put('general-setting/update-setting', 'GeneralSettingsController@updateSetting')->name('general-setting.update');

		//subscription-plan
		Route::resource('subscription-plan', 'SubscriptionPlanController');

		//promo-url
		Route::resource('promo-url', 'PromoUrlController');

		//email-template
		Route::resource('email-template', 'EmailTemplateController');

		//user
		Route::resource('user', 'UserController');
		Route::post('user/save-note/{user}', 'UserController@saveNote')->name('user.save-note');
		Route::post('user/update-plan/{user}', 'UserController@updatePlan')->name('user.update-plan');
		Route::get('user/billing-history/{user}', 'UserController@billingHistory')->name('user.billing-history');

		//email-template
		Route::resource('legal-form', 'LegalFormController');
		//Catalog
		Route::resource('catalog-category', 'CatalogFormCategoryController');
		Route::resource('catalog-form', 'CatalogFormController');
		Route::post('/get/catalog-parent-categories', 'CatalogFormCategoryController@getParentCategories')->name('load-catalog-parent-categories');
		//Tax Form
		Route::resource('tax-type', 'TaxFormTypeController');
		Route::resource('tax-category', 'TaxFormCategoryController');
		Route::resource('tax-form', 'TaxFormController');
		Route::post('/get/tax-parent-categories', 'TaxFormCategoryController@getParentCategories')->name('load-tax-parent-categories');

		Route::get('/tax-form/version/{tax_form}', 'TaxFormController@listVersion')->name('tax-form.version.list');
		Route::get('/tax-form/version/create/{tax_form}', 'TaxFormController@createVersion')->name('tax-form.version.create');
		Route::post('/tax-form/version/store/{tax_form}', 'TaxFormController@storeVersion')->name('tax-form.version.store');
		Route::get('/tax-form/version/edit/{tax_form}/{tax_form_version}', 'TaxFormController@editVersion')->name('tax-form.version.edit');
		Route::put('/tax-form/version/update/{tax_form}/{tax_form_version}', 'TaxFormController@updateVersion')->name('tax-form.version.update');
		Route::delete('/tax-form/version/destroy/{tax_form}/{tax_form_version}', 'TaxFormController@destroyVersion')->name('tax-form.version.destroy');

		Route::resource('tax-calendar', 'TaxCalendarController');
	});
});

Route::group(['as' => 'front.', 'middleware' => []], function () {

	Route::get("/", 'Front\FrontHomeController@index')->name('home');
	Route::get("/#login", 'Front\FrontHomeController@index')->name('home.login');
	Route::get('/login', 'Auth\FrontLoginController@showLoginForm')->name('login');
	Route::get('/forgot-password', 'Auth\FrontForgotPasswordController@forgotpassword')->name('forgot.password');
	Route::post('reset-password-with-token', 'Auth\FrontForgotPasswordController@resetPassword')->name('resetpassword.email');
	Route::get('/user-reset-password/{token}', 'Auth\FrontResetPasswordController@resetPasswordFrm')->name('reset.password.frm');
	Route::post('reset-password-save', 'Auth\FrontResetPasswordController@resetPasswordSave')->name('resetpassword.save');

	Route::get('/front-user-registration', 'Auth\FrontUserRegistrationController@registerUserFrm')->name('user.registration');
	Route::post('/front-user-registration-save', 'Auth\FrontUserRegistrationController@registerUserSave')->name('user.registration.save');

	Route::get('/front-user-email-verification/{token}', 'Auth\FrontUserRegistrationController@newUserVerification')->name('user.verification.save');
	Route::get('login/{provider}', 'SocialController@redirect');
	Route::get('login/{provider}/callback', 'SocialController@Callback');
	Route::get('/resend-verification-account', 'Auth\FrontForgotPasswordController@reSendVerificationAccount')->name('resend.verification.account');
	Route::post('/resend-verification-account-submit', 'Auth\FrontForgotPasswordController@reSendVerificaitonAccountSubmit')->name('resend.verification.account.submit');



	Route::post('/login', 'Auth\FrontLoginController@login')->name('login');
	Route::post('/logout', 'Auth\FrontLoginController@logout')->name('logout');
	Route::get('/pricing', 'Front\PricingController@index')->name('pricing');
	Route::get('/promo-pricing/{id}', 'Front\PricingController@promoPricing')->name('promo-pricing');

	Route::group(['namespace' => 'Front', 'middleware' => ['auth:front_web', 'preventBackHistory']], function () {

		// Route::get('/', 'DashboardController@index')->name('dashboard');
		Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
		Route::get('/payment-form/{subscription_plan}', 'PricingController@showPaymentForm')->name('payment-form');
		Route::post('/checkout/{subscription_plan}', 'PricingController@checkout')->name('checkout');

		Route::get('/subscription-payment', 'SubscriptionPaymentController@index')->name('subscription-payment');
		Route::get('/subscription-payment-view/{user_subscription}', 'SubscriptionPaymentController@view')->name('subscription-payment.view');
		Route::delete('/cancel-subscription', 'SubscriptionPaymentController@cancelSubscription')->name('cancel-subscription');
		Route::post('/update-card', 'SubscriptionPaymentController@updateCard')->name('update-card');

		Route::get('/user-document-template-form', 'Front\UserDocumentController@templateForm')->name('user-document.template-form');
		Route::post('/user-document-template-form-save', 'Front\UserdocumentController@templateFormSave')->name('user-document.template-form-save');
	});
});

//Cron Jobs
Route::get("renew-subscriptions", 'Front\HomeController@renewSubscriptions')->name('renew-subscriptions');

// Route::get('/home', 'HomeController@index')->name('home');
