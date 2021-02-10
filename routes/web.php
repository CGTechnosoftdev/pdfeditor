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

	Route::get('/login-as-user/{user}', 'Front\LoginController@loginAsUser')->name('login-as-user');


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
		Route::post('/document/rename-document', 'UserDocumentController@renameDocumentSave')->name('rename-document-save');
		Route::post('/document-info', 'UserDocumentController@getDocumentInfo')->name('document-info');

		Route::get('/document/list', 'UserDocumentController@index')->name('document-list');
		Route::post('/document/list-data', 'UserDocumentController@getDocumentListData')->name('document-list-data');
		Route::get('/document/encrypted-list', 'UserDocumentController@encryptedDocumentList')->name('encrypted-document-list');
		Route::post('/document/encrypted-list', 'UserDocumentController@encryptedDocumentList')->name('encrypted-document-list');
		Route::post('/document/encrypted-list-data', 'UserDocumentController@getEncryptedDocumentListData')->name('encrypted-document-list-data');
		Route::post('/document/save-tags', 'UserDocumentController@saveTags')->name('save-tags');

		Route::get('/document/smart-folder-list', 'UserDocumentController@smartFolderList')->name('smart-folder-list');
		Route::post('/document/smart-folder-list-data', 'UserDocumentController@getSmartFolderListData')->name('smart-folder-list-data');
		Route::post('/document/save-smart-folder', 'UserDocumentController@saveSmartFolder')->name('add-smart-folder');
		Route::put('/document/save-smart-folder/{user_smart_folder}', 'UserDocumentController@saveSmartFolder')->name('update-smart-folder');
		Route::post('/document/delete-smart-folder', 'UserDocumentController@deleteSmartFolder')->name('delete-smart-folder');
		Route::get('/document/smart-folder/{user_smart_folder}', 'UserDocumentController@smartFolderDocuments')->name('smart-folder-documents');
		Route::post('/document/smart-folder/{user_smart_folder}', 'UserDocumentController@smartFolderDocumentsList')->name('smart-folder-documents-list');
		Route::get('/document/smart-folder-detail/{user_smart_folder}', 'UserDocumentController@smartFolderDetail')->name('smart-folder-detail');

		Route::post('/document/{unique_code}', 'UserDocumentController@viewDocument')->name('document-link');

		Route::post('/link-to-fill/publish', 'LinkToFillController@publishLink')->name('publish-link-to-fill');
		Route::get('/link-to-fill/advance-setting/{user_document}', 'LinkToFillController@advanceSetting')->name('advance-link-to-fill');
		Route::get('/send-via-usps/{user_document}', 'UserDocumentController@sendViaUsps')->name('send-via-usps');
		Route::post('/send-via-usps/{user_document}', 'UserDocumentController@sendViaUsps')->name('send-via-usps');

		Route::get('/send-for-review/generate-unique-link', 'SendForReviewController@generateUniqueLink')->name('send-for-review-generate-link');
		Route::post('/send-for-review/add-recipient', 'SendForReviewController@addRecipient')->name('send-for-review-add-recipient');
		Route::get('/send-for-review/{user_document}', 'SendForReviewController@index')->name('send-for-review');
		Route::post('/send-for-review/{user_document}', 'SendForReviewController@saveSendForReview')->name('send-for-review-save');

		Route::get('/user-document-share-get/{user_document_encripted}', 'SharedDocumentController@getDocumentDetail')->name('user-document.user-document-detail');
		Route::post('/user-document-email-share-save', 'SharedDocumentController@userDocumentEmailShareSave')->name('user-document.user-document-email-share-save');
		Route::post('/user-document-check-business-card', 'SharedDocumentController@checkBusinessCard')->name('user-document.user-document-link-share-check-business-card');
		Route::post('/user-document-link-share-save', 'SharedDocumentController@userDocumentLinkShareSave')->name('user-document.user-document-link-share-save');

		//Route::get('/user-document-advance-settings/{user_document_encripted}', 'SharedDocumentController@getAdvanceSettings')->name('user-document.user-document-advance-settings');
		//Route::get('/check-user-email-form', 'SharedDocumentController@checkUserEmailForm')->name('check-user-email-form-route');
		//Route::post('/user-document-advance-settings-save', 'SharedDocumentController@saveAdvanceSettings')->name('user-document.user-document-advance-settings-save');


		Route::get('/send-for-share/generate-unique-link', 'SharedDocumentController@generateUniqueLink')->name('send-for-share-generate-link');
		Route::post('/send-for-share/add-recipient', 'SharedDocumentController@addRecipient')->name('send-for-share-add-recipient');
		Route::get('/send-for-share/{user_document}', 'SharedDocumentController@index')->name('send-for-share');
		Route::post('/send-for-share/{user_document}', 'SharedDocumentController@saveSendForShare')->name('send-for-share-save');


		Route::get('/trash-list', 'TrashController@getTrashList')->name('trash-list');
		Route::post('/trash-list', 'TrashController@getTrashList')->name('trash-list');
		Route::post('/trash-list-short-by', 'TrashController@getTrashList')->name('trash-list-short-by');
		Route::post('/trash-update', 'TrashController@trashUpdate')->name('trash-update-save');
		Route::post('/trash-single-restore', 'TrashController@trashSingleRestore')->name('trash-single-restore-save');
		Route::post('/trash-empty', 'TrashController@trashEmpty')->name('trash-empty-save');
		Route::post('/move-to-trash', 'TrashController@moveToTrash')->name('move-to-trash-save');

		Route::get('/user-document-download/{user_document_encripted}', 'UserDocumentController@documentDownload')->name('user-document.download');
		Route::get('/user-document-print/{user_document_encripted}', 'UserDocumentController@documentPrint')->name('user-document.print');

		Route::get('/address-book', 'AddressBookController@addressBookList')->name('address-book-list');
		Route::post('/address-book/list-data', 'AddressBookController@getAddressListData')->name('address-list-data');
		Route::post('/address-book-delete', 'AddressBookController@addressBookDelete')->name('address-book-delete-operation');
		Route::post('/address-book-item-delete', 'AddressBookController@addressBookItemDelete')->name('address-book-item-delete');
		Route::post('/address-book-item-add', 'AddressBookController@addressBookItemAdd')->name('address-book-item-add');
		Route::get('/get-address-book-item-edit/{address_book}', 'AddressBookController@getaddressBookItemEdit')->name('get-address-book-item-edit');
		Route::post('/address-book-item-edit/{address_book}', 'AddressBookController@addressBookItemEdit')->name('address-book-item-edit');
		Route::get('/google-contacts', 'AddressBookController@getGoogleContacts')->name('get-google-contacts');
		Route::post('/google-contacts', 'AddressBookController@getGoogleContacts')->name('get-google-contacts');
		Route::post('/yahoo-contacts', 'AddressBookController@getYahooContacts')->name('get-yahoo-contacts');

		Route::get('/outbox/usps-mail-list', 'OutboxController@uspsMailList')->name('out-usps-mail-list');
		Route::post('/outbox/usps-mail-list-data', 'OutboxController@uspsMailListData')->name('out-usps-mail-list-data');
		Route::post('/outbox/usps-mail-delete', 'OutboxController@uspsMailDelete')->name('out-usps-mail-delete');

		Route::get('/outbox/share-list', 'OutboxController@shareList')->name('out-share-list');
		Route::post('/outbox/share-list-data', 'OutboxController@shareListData')->name('out-share-list-data');
		Route::post('/outbox/share-delete', 'OutboxController@shareDelete')->name('out-share-delete');
		Route::post('/outbox/share-stop-', 'OutboxController@shareStopSharing')->name('out-share-stop-sharing');

		Route::get('/outbox/send-for-review-list', 'OutboxController@sendForReviewList')->name('out-send-for-review-list');
		Route::post('/outbox/send-for-review-list-data', 'OutboxController@sendForReviewListData')->name('out-send-for-review-list-data');
		Route::post('/outbox/send-for-review-delete', 'OutboxController@sendForReviewDelete')->name('out-send-for-review-delete');
		Route::post('/outbox/send-for-review-stop-', 'OutboxController@sendForReviewStopSharing')->name('out-send-for-review-stop-sharing');

		Route::get('/outbox/link-to-fill-list', 'OutboxController@linkToFillList')->name('out-link-to-fill-list');
		Route::post('/outbox/link-to-fill-list-data', 'OutboxController@linkToFillListData')->name('out-link-to-fill-list-data');
		Route::post('/outbox/link-to-fill-delete', 'OutboxController@linkToFillDelete')->name('out-link-to-fill-delete');

		Route::get('/account/information', 'UserAccountController@accountInformation')->name('account-information');
		Route::get('/account/additional-account-list', 'AdditionalAccountController@list')->name('additional-account-list');
		Route::post('/account/additional-account-data', 'AdditionalAccountController@listData')->name('additional-account-list-data');
		Route::post('/account/additional-account-delete', 'AdditionalAccountController@delete')->name('additional-account-delete');
		Route::post('/account/additional-account-change-status', 'AdditionalAccountController@changeStatus')->name('additional-account-change-status');
		Route::post('/account/additional-account-add', 'AdditionalAccountController@createAdditionalUser')->name('additional-account-add');
		Route::post('/account/additional-account-update/{additional_user}', 'AdditionalAccountController@updateAdditionalUser')->name('additional-account-update');
		Route::get('/account/additional-account-detail/{additional_user}', 'AdditionalAccountController@additionalAccountDetail')->name('additional-account-detail');


		Route::get('/account/personal-information', 'PersonalInformationController@getPersonalInformation')->name('get-personal-information');
		Route::post('/account/personal-information-save/{user}', 'PersonalInformationController@savePersonalInformation')->name('personal-information-save');
		Route::get('/account/custom-branding', 'CustomBrandingController@getCustomBranding')->name('get-custom-branding');
		Route::post('/account/custom-branding-save', 'CustomBrandingController@customBrandingSave')->name('custom-branding-save');
		Route::post('/account/custom-branding-test-email', 'CustomBrandingController@customBrandingTestEmail')->name('custom-branding-test-email');

		Route::get('/account/get-general-settings', 'GeneralSettingsController@getGeneralSettings')->name('get-general-settings');
		Route::post('/account/general-settings-email-reset-request/{user}', 'GeneralSettingsController@emailResetRequest')->name('general-settings-email-reset-request');
		Route::post('/account/general-settings-phone-reset-request/{user}', 'GeneralSettingsController@phoneResetRequest')->name('general-settings-phone-reset-request');

		Route::get('/account/general-settings-email-reset-update-request/{token}', 'GeneralSettingsController@emailResetUpdateRequest')->name('general-settings-email-reset-update-request');
		Route::get('/account/general-settings-phone-reset-update-request/{token}', 'GeneralSettingsController@phoneResetUpdateRequest')->name('general-settings-phone-reset-update-request');

		Route::post('/account/general-settings-email-update', 'GeneralSettingsController@emailUpdate')->name('general-settings-email-update');
		Route::post('/account/general-settings-phone-update', 'GeneralSettingsController@phoneUpdate')->name('general-settings-phone-update');
		Route::post('/account/general-settings-password-update', 'GeneralSettingsController@passwordUpdate')->name('general-settings-password-update');

		Route::post('/account/general-settings-date_time-update', 'GeneralSettingsController@dateTimeUpdate')->name('general-settings-date_time-update');
		Route::post('/account/general-settings-grant_access-update', 'GeneralSettingsController@grantAccessUpdate')->name('general-settings-grant_access-update');
		Route::post('/account/general-settings-notification_preference-update', 'GeneralSettingsController@notificationPreferenceUpdate')->name('general-settings_notification_preference-update');
		Route::post('/account/general-settings-hipaa_compliance-update', 'GeneralSettingsController@hipaaComplianceUpdate')->name('general-settings_hipaa_compliance-update');
		Route::post('/account/general-settings-is_receive_encript_folder_password-update', 'GeneralSettingsController@encriptFolderPasswordUpdate')->name('general-settings-encript-folder-password-update');

		Route::get('/audit-trail', 'AuditTrailController@auditTrailList')->name('audit-trail-list');
		Route::post('/audit-trail/list-data', 'AuditTrailController@getAuditTrailData')->name('audit-trail-data');

		//Route::post('/account/general-settings-save', 'GeneralSettingsController@saveGeneralSettings')->name('general-settings-save');
	});
});

//Cron Jobs
Route::get("renew-subscriptions", 'Front\HomeController@renewSubscriptions')->name('renew-subscriptions');

// Route::get('/home', 'HomeController@index')->name('home');
