<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

Route::group(['as' => 'api.', 'middleware' => []], function () {
	Route::post('/front-user-registration-api-save', 'Front\UserRegistrationController@registerUserSaveApi')->name('user.registration.api.save');
	Route::post('/reset-password-api-save', 'Front\ResetPasswordController@resetPasswordSaveApi')->name('resetpassword.api.save');
	Route::post('/reset-password-with-token-api', 'Front\ForgotPasswordController@resetPasswordNewApi')->name('resetpassword.api.email');
	Route::post('login/{provider}', 'Front\LoginController@socialLoginApi');



	Route::group([/*'namespace'=>'API',*/'middleware' => ['auth:api']], function () {
		Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout');
		Route::post('/subscription-payment-cancel-api', 'Api\SubscriptionApiController@cancelSubscriptionApi')->name('subscription-payment-api-cancel');
		Route::get('/subscription-history-api', 'Api\SubscriptionApiController@subscriptionHistoryApi')->name('subscription-payment-api-history');
		Route::post('/subscription-payment-method-post', 'Api\SubscriptionApiController@subscriptionPaymentMethodPostApi')->name('subscription-payment-api-method');
	});
});
