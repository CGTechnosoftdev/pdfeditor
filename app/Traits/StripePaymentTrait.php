<?php
namespace App\Traits;

use Auth;
use Stripe\StripeClient;
use Stripe\Stripe;
trait StripePaymentTrait {

	/**
	 * [createCardToken description]
	 * @author Akash Sharma
	 * @date   2020-11-12
	 * @return [type]     [description]
	 */
	public function createCardToken(){
		try{
			$card_data = [
				'number' => '4242424242424242',
				'exp_month' => 11,
				'exp_year' => 2021,
				'cvc' => '314',
			];
			$stripe = new StripeClient(config('custom_config.stripe_config.secret_key'));
			$response_data =  $stripe->tokens->create([
				'card' => $card_data,
			]);		
			$response_status = true;	
			// tok_1HmdgRDCwgb6dlp7nvXkwWsJ
		}
		catch(\Stripe\Exception\CardException $e) {
			$response_status = false;
			$response_message = $e->getError()->message;
		} catch (\Stripe\Exception\RateLimitException $e) {
			// Too many requests made to the API too quickly
			$response_status = false;
			$response_message = $e->getError()->message;
		} catch (\Stripe\Exception\InvalidRequestException $e) {
			// Invalid parameters were supplied to Stripe's API
			$response_status = false;
			$response_message = $e->getError()->message;
		} catch (\Stripe\Exception\AuthenticationException $e) {
			// Authentication with Stripe's API failed
			// (maybe you changed API keys recently)
			$response_status = false;
			$response_message = $e->getError()->message;
		} catch (\Stripe\Exception\ApiConnectionException $e) {
			// Network communication with Stripe failed
			$response_status = false;
			$response_message = $e->getError()->message;
		} catch (\Stripe\Exception\ApiErrorException $e) {
			// Display a very generic error to the user, and maybe send
			// yourself an email
			$response_status = false;
			$response_message = $e->getError()->message;
		} catch (Exception $e) {
			// Something else happened, completely unrelated to Stripe
			$response_status = false;
			$response_message = $e->getError()->message;
		}
		return [
			'success' => $response_status ?? false,
			'data' => $response_data ?? '',
			'message' => $response_message ?? '',
		];
	}

	/**
	 * [createCustomer description]
	 * @author Akash Sharma
	 * @date   2020-11-12
	 * @return [type]     [description]
	 */
	public function createCustomer(){
		try{
			$token = "tok_1HmdgRDCwgb6dlp7nvXkwWsJ";
			$email = "tepuhefa@mailinator.com";
			$name = "Nora Pope";
			$stripe = new StripeClient(config('custom_config.stripe_config.secret_key'));
			$response_data =  $stripe->customers->create([
				'source' => $token,
				'email' => $email,
				'name' => $name,
			]);		
			$response_status = true;	
			// cus_INOpEXll9JTJtR
		}
		catch(\Stripe\Exception\CardException $e) {
			$response_status = false;
			$response_message = $e->getError()->message;
		} catch (\Stripe\Exception\RateLimitException $e) {
			// Too many requests made to the API too quickly
			$response_status = false;
			$response_message = $e->getError()->message;
		} catch (\Stripe\Exception\InvalidRequestException $e) {
			// Invalid parameters were supplied to Stripe's API
			$response_status = false;
			$response_message = $e->getError()->message;
		} catch (\Stripe\Exception\AuthenticationException $e) {
			// Authentication with Stripe's API failed
			// (maybe you changed API keys recently)
			$response_status = false;
			$response_message = $e->getError()->message;
		} catch (\Stripe\Exception\ApiConnectionException $e) {
			// Network communication with Stripe failed
			$response_status = false;
			$response_message = $e->getError()->message;
		} catch (\Stripe\Exception\ApiErrorException $e) {
			// Display a very generic error to the user, and maybe send
			// yourself an email
			$response_status = false;
			$response_message = $e->getError()->message;
		} catch (Exception $e) {
			// Something else happened, completely unrelated to Stripe
			$response_status = false;
			$response_message = $e->getError()->message;
		}
		return [
			'success' => $response_status ?? false,
			'data' => $response_data ?? '',
			'message' => $response_message ?? '',
		];
	}

	/**
	 * [chargePayment description]
	 * @author Akash Sharma
	 * @date   2020-11-12
	 * @return [type]     [description]
	 */
	public function chargePayment(){
		try{
			$amount = "200.00";
			$currency = "inr";
			$customer_id = "cus_INOpEXll9JTJtR";
			$description = "Test payment";
			$stripe = new StripeClient(config('custom_config.stripe_config.secret_key'));
			$response_data =  $stripe->charges->create([
				'amount' => (integer) ($amount * 100),
				'currency' => $currency,
				'customer' => $customer_id,
				'description' => $description,
			]);		
			$response_status = true;	
			// cus_INOpEXll9JTJtR
		}
		catch(\Stripe\Exception\CardException $e) {
			$response_status = false;
			$response_message = $e->getError()->message;
		} catch (\Stripe\Exception\RateLimitException $e) {
			// Too many requests made to the API too quickly
			$response_status = false;
			$response_message = $e->getError()->message;
		} catch (\Stripe\Exception\InvalidRequestException $e) {
			// Invalid parameters were supplied to Stripe's API
			$response_status = false;
			$response_message = $e->getError()->message;
		} catch (\Stripe\Exception\AuthenticationException $e) {
			// Authentication with Stripe's API failed
			// (maybe you changed API keys recently)
			$response_status = false;
			$response_message = $e->getError()->message;
		} catch (\Stripe\Exception\ApiConnectionException $e) {
			// Network communication with Stripe failed
			$response_status = false;
			$response_message = $e->getError()->message;
		} catch (\Stripe\Exception\ApiErrorException $e) {
			// Display a very generic error to the user, and maybe send
			// yourself an email
			$response_status = false;
			$response_message = $e->getError()->message;
		} catch (Exception $e) {
			// Something else happened, completely unrelated to Stripe
			$response_status = false;
			$response_message = $e->getError()->message;
		}
		return [
			'success' => $response_status ?? false,
			'data' => $response_data ?? '',
			'message' => $response_message ?? '',
		];
	}
}