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

	Route::get("/", 'Front\HomeController@index')->name('home');
	Route::get("/#login", 'Front\HomeController@index')->name('home.login');
	Route::get('/login', 'Front\LoginController@showLoginForm')->name('login');
	Route::get('/forgot-password', 'Front\ForgotPasswordController@forgotpassword')->name('forgot.password');
	Route::post('reset-password-with-token', 'Front\ForgotPasswordController@resetPassword')->name('resetpassword.email');
	Route::get('/user-reset-password/{token}', 'Front\ResetPasswordController@resetPasswordFrm')->name('reset.password.frm');
	Route::post('reset-password-save', 'Front\ResetPasswordController@resetPasswordSave')->name('resetpassword.save');

	Route::get('/front-user-registration', 'Front\UserRegistrationController@registerUserFrm')->name('user.registration');
	Route::post('/front-user-registration-save', 'Front\UserRegistrationController@registerUserSave')->name('user.registration.save');

	Route::get('/front-user-email-verification/{token}', 'Front\UserRegistrationController@newUserVerification')->name('user.verification.save');
	Route::get('login/{provider}', 'SocialController@redirect');
	Route::get('login/{provider}/callback', 'SocialController@Callback');
	Route::get('/resend-verification-account', 'Front\ForgotPasswordController@reSendVerificationAccount')->name('resend.verification.account');
	Route::post('/resend-verification-account-submit', 'Front\ForgotPasswordController@reSendVerificaitonAccountSubmit')->name('resend.verification.account.submit');



	Route::post('/login', 'Front\LoginController@login')->name('login');
	Route::post('/logout', 'Front\LoginController@logout')->name('logout');
	Route::get('/pricing', 'Front\PricingController@index')->name('pricing');
	Route::get('/promo-pricing/{id}', 'Front\PricingController@promoPricing')->name('promo-pricing');




	Route::group(['namespace' => 'Front', 'middleware' => ['auth:front_web', 'preventBackHistory']], function () {

		Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
		Route::get('/payment-form/{subscription_plan}', 'PricingController@showPaymentForm')->name('payment-form');
		Route::post('/checkout/{subscription_plan}', 'PricingController@checkout')->name('checkout');

		Route::get('/account/subscription-payment', 'SubscriptionPaymentController@index')->name('subscription-payment');
		Route::get('/subscription-payment-view/{user_subscription}', 'SubscriptionPaymentController@view')->name('subscription-payment.view');
		Route::delete('/cancel-subscription', 'SubscriptionPaymentController@cancelSubscription')->name('cancel-subscription');
		Route::post('/update-card', 'SubscriptionPaymentController@updateCard')->name('update-card');


		Route::post('/document/upload-new', 'UserDocumentController@uploadNew')->name('upload-new-document');
		Route::post('/document/get-from-url', 'UserDocumentController@getFromUrl')->name('get-url-document');
		Route::post('/document/add-new-folder', 'UserDocumentController@addNewFolder')->name('add-new-folder');
		Route::post('/document/add-new-folder', 'UserDocumentController@addNewFolder')->name('add-new-folder');
		Route::post('/document-info', 'UserDocumentController@getDocumentInfo')->name('document-info');
		Route::get('/document/template-form', 'UserDocumentController@templateForm')->name('user-document.template-form');
		Route::post('/document/template-form-save', 'UserDocumentController@templateFormSave')->name('user-document.template-form-save');

		Route::get('/document/list', 'UserDocumentController@index')->name('document-list');
		Route::post('/document/list-data', 'UserDocumentController@getDocumentListData')->name('document-list-data');
		Route::get('/document/encrypted-list', 'UserDocumentController@encryptedDocumentList')->name('encrypted-document-list');
		Route::post('/document/encrypted-list', 'UserDocumentController@encryptedDocumentList')->name('encrypted-document-list');
		Route::post('/document/encrypted-list-data', 'UserDocumentController@getEncryptedDocumentListData')->name('encrypted-document-list-data');

		Route::post('/document/{unique_code}', 'UserDocumentController@viewDocument')->name('document-link');

		Route::post('/link-to-fill/publish', 'LinkToFillController@publishLink')->name('publish-link-to-fill');
		Route::get('/link-to-fill/advance-setting-/{user_document}', 'LinkToFillController@advanceSetting')->name('advance-link-to-fill');



		Route::get('/user-document-share-get/{user_document}', 'SharedDocumentController@getDocumentDetail')->name('user-document.user-document-detail');
		Route::post('/user-document-email-share-save', 'SharedDocumentController@userDocumentEmailShareSave')->name('user-document.user-document-email-share-save');
		Route::post('/user-document-link-share-save', 'SharedDocumentController@userDocumentLinkShareSave')->name('user-document.user-document-link-share-save');
		Route::get('/user-document-advance-settings/{user_document}', 'SharedDocumentController@getAdvanceSettings')->name('user-document.user-document-advance-settings');
		Route::get('/check-user-email-form', 'SharedDocumentController@checkUserEmailForm')->name('check-user-email-form-route');
		Route::post('/user-document-advance-settings-save', 'SharedDocumentController@saveAdvanceSettings')->name('user-document.user-document-advance-settings-save');

		Route::get('/trash-list', 'TrashController@getTrashList')->name('trash-list');
		Route::post('/trash-list', 'TrashController@getTrashList')->name('trash-list');

		Route::post('/trash-update', 'TrashController@trashUpdate')->name('trash-update-save');
		Route::post('/trash-empty', 'TrashController@trashEmpty')->name('trash-empty-save');
		Route::post('/move-to-trash', 'TrashController@moveToTrash')->name('move-to-trash-save');
		Route::get('/user-document-download/{user_document}', 'SharedDocumentController@documentDownload')->name('user-document.download');
	});
});

//Cron Jobs
Route::get("renew-subscriptions", 'Front\HomeController@renewSubscriptions')->name('renew-subscriptions');

// Route::get('/home', 'HomeController@index')->name('home');
